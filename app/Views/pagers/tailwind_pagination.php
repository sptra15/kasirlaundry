<?php if ($pager->getPageCount() > 1): ?>
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center mt-4">
        <ul class="inline-flex items-center space-x-px text-xs">

            <!-- Tombol Sebelumnya -->
            <?php if ($pager->hasPrevious()): ?>
                <li>
                    <a href="<?= $pager->getPreviousPage('default') ?>"
                        class="px-2.5 py-1.5 text-gray-600 bg-white border border-gray-300 rounded-l hover:bg-gray-100 hover:text-blue-600 transition">
                        &laquo; Sebelumnya
                    </a>
                </li>
            <?php else: ?>
                <li>
                    <span
                        class="px-2.5 py-1.5 text-gray-400 bg-gray-100 border border-gray-300 rounded-l cursor-not-allowed">
                        &laquo; Sebelumnya
                    </span>
                </li>
            <?php endif ?>

            <!-- Nomor Halaman -->
            <?php foreach ($pager->links('default') as $link): ?>
                <li>
                    <a href="<?= $link['uri'] ?>"
                        class="px-2.5 py-1.5 border text-center min-w-[32px]
                        <?= $link['active']
                            ? 'bg-blue-600 text-white border-blue-600'
                            : 'bg-white text-gray-600 border-gray-300 hover:bg-gray-100 hover:text-blue-600' ?>">
                        <?= $link['title'] ?>
                    </a>
                </li>
            <?php endforeach ?>

            <!-- Tombol Selanjutnya -->
            <?php if ($pager->hasNext()): ?>
                <li>
                    <a href="<?= $pager->getNextPage('default') ?>"
                        class="px-2.5 py-1.5 text-gray-600 bg-white border border-gray-300 rounded-r hover:bg-gray-100 hover:text-blue-600 transition">
                        Selanjutnya &raquo;
                    </a>
                </li>
            <?php else: ?>
                <li>
                    <span
                        class="px-2.5 py-1.5 text-gray-400 bg-gray-100 border border-gray-300 rounded-r cursor-not-allowed">
                        Selanjutnya &raquo;
                    </span>
                </li>
            <?php endif ?>

        </ul>
    </nav>
<?php endif ?>