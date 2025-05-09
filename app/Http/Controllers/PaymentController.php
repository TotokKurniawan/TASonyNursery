<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Log; // Tambahkan ini di atas
class PaymentController extends Controller
{
    public function initiatePayment(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');

        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $pesanan->id,
                'gross_amount' => $pesanan->budget, // Harga total dari pesanan
            ],
            'customer_details' => [
                'first_name' => $pesanan->pelanggan->nama,
                // 'email' => $pesanan->pelanggan->user->email,
            ]
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            // $pesanan->midtrans_token = $snapToken;

            return response()->json(['token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function updatePaymentStatus(Request $request, $id)
    {
        try {
            $pesanan = Pesanan::findOrFail($id);

            Log::info("Menerima update status pesanan: ", [
                'id' => $id,
                'status' => $request->status,
                'status_pembayaran' => $request->status_pembayaran,
                'transaction_id' => $request->transaction_id
            ]);

            if (!$request->status) {
                Log::error("Gagal memperbarui status: status kosong.");
                return response()->json(['error' => 'Status tidak valid'], 400);
            }

            $pesanan->status = $request->status;

            // Tambahkan ini untuk menyimpan status pembayaran
            if ($request->has('status_pembayaran')) {
                $pesanan->status_pembayaran = $request->status_pembayaran;
            }

            $pesanan->save();

            return response()->json(['message' => 'Status pembayaran berhasil diperbarui.']);
        } catch (\Exception $e) {
            Log::error("Error saat update status pesanan: " . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function uploadBukti(Request $request, $pesananId)
    {
        // Validasi file
        $request->validate([
            'bukti_pembayaran' => 'required|file|mimes:jpg,png,jpeg,pdf|max:2048',
        ]);

        // Mencari pesanan berdasarkan ID
        $pesanan = Pesanan::findOrFail($pesananId);

        // Menyimpan file bukti pembayaran
        $buktiPath = $request->file('bukti_pembayaran')->store('uploads/bukti_pembayaran', 'public');

        // Memperbarui status pembayaran dan menyimpan path bukti pembayaran
        $pesanan->status_pembayaran = 'konfirmasi dp';
        $pesanan->bukti_dp = $buktiPath;
        $pesanan->save();

        // Mengembalikan response setelah sukses
        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload dan status pembayaran diperbarui.');
    }
}
