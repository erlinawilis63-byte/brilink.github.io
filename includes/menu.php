<?php
$menu_items = [
    'dashboard' => ['label' => 'Dashboard', 'icon' => 'fa-chart-line'],
    'transaksi' => ['label' => 'Input Transaksi', 'icon' => 'fa-cash-register'],
    'laporan' => ['label' => 'Laporan Keuangan', 'icon' => 'fa-book-open'],
];
?>
<nav class="flex-1 p-4 space-y-2 overflow-y-auto">
    <?php foreach ($menu_items as $key => $item): ?>
        <a href="index.php?page=<?= $key; ?>" class="flex items-center gap-3 py-2.5 px-4 rounded transition <?= $page === $key ? 'bg-blue-700 font-semibold' : 'hover:bg-blue-800'; ?>">
            <i class="fa-solid <?= $item['icon']; ?> w-5"></i> <?= $item['label']; ?>
        </a>
    <?php endforeach; ?>
</nav>