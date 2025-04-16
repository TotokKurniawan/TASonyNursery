<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pendapatan</title>
    <style>
        /* Menambahkan margin dan padding untuk body agar lebih rapi */
        body {
            font-family: 'Arial', sans-serif;
            margin: 40px;
            padding: 0;
            color: #333;
        }

        /* Header yang lebih menarik dengan logo dan teks */
        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header img {
            width: 100px;
            /* Sesuaikan dengan ukuran logo */
            margin-bottom: 10px;
        }

        .header h3 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        .header p {
            margin: 5px 0;
            font-size: 16px;
        }

        /* Tabel yang lebih menarik dengan border dan desain lebih modern */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        /* Styling untuk total pengeluaran */
        .total {
            margin-top: 20px;
            text-align: right;
            font-size: 18px;
            font-weight: bold;
        }

        /* Styling untuk tanggal periode */
        .periode {
            font-size: 16px;
            margin-top: 10px;
            text-align: center;
        }

        /* Agar logo tetap berada di bagian atas, beri padding pada body */
        .container {
            padding-top: 30px;
        }
    </style>
</head>

<body>
    <div class="header">
        <!-- Gantilah dengan path logo yang sesuai -->
        <img src="{{ asset('assetsuser/logo.png') }}" alt="Logo">
        <h3>Laporan Pendapatan Sony Nursery</h3>
        <p>Periode: {{ $request->tglawal }} s/d {{ $request->tglakhir }}</p>
    </div>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Pelanggan</th>
                    <th>Budget</th>
                    <th>Metode Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesanan as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                        <td>{{ $item->pelanggan->nama }}</td>
                        <td>{{ number_format($item->budget, 0, ',', '.') }}</td>
                        <td>{{ $item->metode_pembayaran }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="total">Total Pendapatan: Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
    </div>
</body>

</html>
