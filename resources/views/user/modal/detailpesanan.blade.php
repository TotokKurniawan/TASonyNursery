<div class="modal fade" id="detailPesananModal{{ $pesanan->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailPesananLabel{{ $pesanan->id }}">Detail Pesanan
                    #{{ $pesanan->id }} {{ $pesanan->pelanggan->nama }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <td>{{ $pesanan->id }}</td>
                    </tr>
                    <tr>
                        <th>Nama Pelanggan</th>
                        <td>{{ $pesanan->pelanggan->nama }}</td>
                    </tr>
                    <tr>
                        <th>No telepon</th>
                        <td>{{ $pesanan->pelanggan->telepon }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $pesanan->status }}</td>
                    </tr>
                    <tr>
                        <th>Budget</th>
                        <td>Rp.{{ number_format($pesanan->budget, 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <th>Tgl survei</th>
                        <td>{{ $pesanan->tanggal_survei }}</td>
                    </tr>
                    <tr>
                        <th>Tenggat Pengerjaan</th>
                        <td>{{ $pesanan->tanggal_selesai }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
