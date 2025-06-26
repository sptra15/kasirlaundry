<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Status Transaksi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.5s ease-out;
        }

        body {
            background-image: url('<?= base_url('images/tr2.jpg') ?>');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .frame-container {
            background-image: url('<?= base_url('images/tr1.png') ?>');
            background-repeat: no-repeat;
            background-size: 100% 100%;
            padding: 1rem;
            border-radius: 1.5rem;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        .frame-inner {
            background-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 1rem;
            padding: 1.5rem;
        }

        @media (prefers-color-scheme: dark) {
            .frame-inner {
                background-color: rgba(31, 41, 55, 0.4);
            }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">
    <div class="frame-container animate-fade-in w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl">
        <div class="frame-inner text-center text-gray-900 dark:text-white">
            <h1 class="text-2xl sm:text-3xl font-extrabold mb-5">📋 Status Transaksi</h1>

            <?php if ($transaksi): ?>
                <p class="mb-4 text-base sm:text-lg text-gray-800 dark:text-gray-300">
                    Hasil untuk ID Transaksi:
                    <strong class="text-blue-700 dark:text-blue-400"><?= esc($id_transaksi) ?></strong>
                </p>

                <ul class="text-left space-y-2 text-sm sm:text-base text-gray-900 dark:text-gray-200">
                    <li><span class="font-semibold">👤 Nama:</span> <?= esc($transaksi['nama_pelanggan']) ?></li>
                    <li><span class="font-semibold">⚙️ Proses:</span> <?= esc($transaksi['proses']) ?></li>
                    <li><span class="font-semibold">⏱️ Lama Hari:</span> <?= esc($transaksi['lama_proses']) ?> hari</li>
                    <li><span class="font-semibold">⚖️ Berat:</span> <?= esc($transaksi['berat']) ?> kg</li>
                    <li><span class="font-semibold">💰 Total Harga:</span> Rp<?= number_format($transaksi['total'], 0, ',', '.') ?></li>
                    <li><span class="font-semibold">📌 Status:</span>
                        <span class="inline-block px-2 py-1 rounded bg-blue-100 dark:bg-blue-700 text-blue-700 dark:text-white text-sm">
                            <?= esc($transaksi['status']) ?>
                        </span>
                    </li>
                </ul>
            <?php else: ?>
                <p class="text-red-600 text-base sm:text-lg font-medium">❌ Transaksi dengan ID <strong><?= esc($id_transaksi) ?></strong> tidak ditemukan.</p>
            <?php endif; ?>

            <a href="/login" class="mt-6 inline-block bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-semibold shadow hover:shadow-lg transition">
                ⬅️ Kembali ke Beranda
            </a>
        </div>
    </div>
</body>

</html>