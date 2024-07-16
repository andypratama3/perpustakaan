<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman Bulan {{ $start }} - {{ $end }}</title>
    <style>
       @media print {
     @page {
        margin-left: 0.5in;
        margin-right: 0.5in;
        margin-top: 0;
        margin-bottom: 0;
      }
}
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border: 2px solid black;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .container {
            display: flex;
            /* width: 100%; */
            height: 100px;
            /* background-color: #f2f2f2; */
        }
        .header {
            width: 100%;
            height: 100px;
            padding: 20px;

            /* border: 1px solid #000; */
        }
        .header h2 {
            /* border: 1px solid #000; */
            /* padding: 5px 10px; */
            text-align: center;
            margin: 0;
        }
        .header h3 {
            /* border: 1px solid #000; */
            margin: 0;
            text-align: center;
        }
        .header p {
            /* border: 1px solid #000; */
            margin: 0;
            text-align: center;
        }
        .header .email {
            float: inline-end;
            font-weight: bold;
        }
        #logo {
            width: 140px;
            height: 120px;
            float: left;

        }
        .hr {
            border: 1px solid #000;
            margin-top: 80px;
            margin-left: 20px;
            margin-right: 20px;
            margin-bottom: 2px;
        }
        .hr2 {
            border: 2px solid #000;
            margin-top: 0;
            margin-left: 20px;
            margin-right: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('image/Logo_Kota_Samarinda.png') }}" alt="" id="logo">
            <h2 style="margin-left: 20px;">Pemerintah Kota Samarinda</h2>
            <h3>DINAS PENDIDIKAN DAN KEBUDAYAAN <br> SMP NEGERI 18 SAMARINDA</h3>
            <p>Jl. Cipto Mangunkusumo Gang 2 RT 04 No.39 Harapan Baru, Loajanan Ilir, Samarinda 75131 Telepon/Faksimile : (0541) 6522830, Telepon Pengaduan : - Laman http://smpn18samarinda.sch.id</p>
            <p class="email">Email : smpn_18_smd@gmail.com</p>
        </div>
    </div>
    <hr class="hr">
    <hr class="hr2">

    <h2 style="text-align: center">Data Peminjaman Bulan {{ $start }} - {{ $end }}</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pinjam</th>
                <th>Nama Peminjam</th>
                <th>Judul Buku</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjaman as $index => $data)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $data->tgl_pinjam }}</td>
                <td>{{ $data->member->name }}</td>
                <td>{{ $data->buku->name }}</td>
                <td>{{ $data->jumlah }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <hr>
    <p style="float:right; font-weight: bold; margin-right: 50px;">Total Peminjaman : {{ $peminjaman->count() }}x</p>
    <button  id="print-btn" style="float: inline-end; margin-top: 50px; background-color: #000; color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none; margin-left: 0 ">Print</button>
    <a  href="{{ route('dashboard.laporan.index') }}" id="back-btn" style="float: inline-end; margin-top: 50px; background-color: #0b2c69; color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none; margin-left: 0 ">Kembali</a>

    <script>
        //dom content loaded event
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('print-btn').addEventListener('click', function() {
                document.getElementById('print-btn').style.display = 'none';
                document.getElementById('back-btn').style.display = 'none';
                window.print();
            });
        });

    </script>
</body>
</html>
