<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk Transaksi</title>
    <style>
        @media print {
            @page {
                size: 58mm auto;
                margin: 0;
            }

            body {
                font-family: monospace;
                font-size: 12px;
                width: 58mm;
                margin: 0;
                padding: 0;
            }
        }

        body {
            font-family: monospace;
            width: 58mm;
            margin: 0 auto;
            padding: 5px;
        }

        .line {
            border-top: 1px dashed #000;
            margin: 5px 0;
        }

        .center {
            text-align: center;
        }
    </style>
</head>
<body onload="window.print(); window.close();">
    <div>
        <div class="center">
            <strong>AL LAUNDRY</strong><br>
            Jl. Kebersihan No. 123<br>
            Telp: 0812-3456-7890
        </div>

        <div class="line"></div>
        Tanggal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $transaksi['tanggal']; ?><br>
        No. Transaksi : <?= $transaksi['id_transaksi']; ?><br>
        Pelanggan&nbsp;&nbsp;&nbsp;&nbsp;: <?= $transaksi['nama_pelanggan']; ?><br>
        Berat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $transaksi['berat']; ?> Kg<br>
        Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Rp<?= number_format($transaksi['total'], 0, ',', '.'); ?><br>
        Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $transaksi['status']; ?><br>
        <div class="line"></div>
        <div class="center">
            Terima kasih telah mencuci!<br>
            ~ Semoga Harimu Bersih ~
        </div>
    </div>
</body>
</html>
