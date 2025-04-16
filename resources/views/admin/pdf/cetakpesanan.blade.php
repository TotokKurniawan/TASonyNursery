<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan #{{ $pesanan->id }}</title>
    <style>
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
            margin-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            color: black;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            font-size: 16px;
        }

        th {
            background-color: #f1f3f5;
            color: #495057;
        }

        td {
            background-color: #fafafa;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 30px;
            color: #343a40;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
        }

        img {
            max-height: 200px;
            margin-top: 15px;
            display: block;
            margin-left: auto;
            margin-right: auto;
            border-radius: 8px;
        }

        .no-image {
            color: #888;
            font-style: italic;
            text-align: center;
        }

        .status {
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: bold;
            text-transform: capitalize;
            display: inline-block;
        }

        .status.paid {
            background-color: #28a745;
            color: #fff;
        }

        .status.pending {
            background-color: #ffc107;
            color: #fff;
        }

        .status.canceled {
            background-color: #dc3545;
            color: #fff;
        }

        .section-title+.section-title {
            margin-top: 40px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
                margin: 10px;
            }

            h1 {
                font-size: 1.8em;
            }

            .section-title {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ asset('assetsuser/logo.png') }}" alt="Logo">
        <h1>Pesanan {{ $pesanan->id }}</h1>
        <h3>Atas Nama {{ $pesanan->pelanggan->nama }}</h3>
        <p>Tanggal: {{ $pesanan->created_at }}</p>
    </div>

    <div class="container">

        <!-- Tabel untuk informasi pesanan -->
        <table>
            <tr>
                <th>Nama Pelanggan</th>
                <td>{{ $pesanan->pelanggan->nama }}</td>
            </tr>
            <tr>
                <th>Budget</th>
                <td>{{ number_format($pesanan->budget, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Bunga</th>
                <td>{{ $pesanan->request_bunga }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $pesanan->status }}</td>
            </tr>
            <tr>
                <th>Metode Pembayaran</th>
                <td>{{ $pesanan->metode_pembayaran }}</td>
            </tr>
        </table>

        <!-- Foto Lokasi -->
        <div class="section-title">Foto Lokasi</div>
        @if (!empty($pesanan->foto_lokasi))
            <img src="{{ public_path('storage/' . $pesanan->foto_lokasi) }}" alt="Foto Lokasi">
        @else
            <div class="no-image">Foto lokasi belum tersedia</div>
        @endif

        <!-- Foto Desain -->
        <div class="section-title">Foto Desain</div>
        @if (!empty($pesanan->foto_desain))
            <img src="{{ public_path('storage/' . $pesanan->foto_desain) }}" alt="Foto Desain">
        @else
            <div class="no-image">Foto desain belum tersedia</div>
        @endif


    </div>
</body>

</html>
