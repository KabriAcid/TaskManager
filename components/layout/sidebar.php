<?php
$currentPath = $_SERVER['REQUEST_URI'];
$isActive = function ($path) use ($currentPath) {
    if ($path === '/dashboard' || $path === '/') {
        return strpos($currentPath, 'dashboard/index.php') !== false ||
            strpos($currentPath, 'TaskManager/pages/dashboard/') !== false ||
            strpos($currentPath, 'TaskManager/index.php') !== false ||
            $currentPath === APP_URL . '/' ||
            $currentPath === '/TaskManager/';
    }
    return strpos($currentPath, $path) !== false;
};
?>

<!-- Sidebar -->
<aside id="sidebar" class="fixed left-0 top-0 z-40 h-screen w-64 transition-transform -translate-x-full md:translate-x-0 bg-card border-r border-border">
    <!-- Sidebar Header -->
    <div class="flex h-16 items-center gap-2.5 border-b border-border px-6">
        <svg class="h-8 w-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
        </svg>
        <h1 class="text-xl font-bold text-foreground">TaskManager</h1>
    </div>

    <!-- Sidebar Content -->
    <div class="flex flex-col gap-2 p-4">
        <nav class="flex flex-col gap-1">
            <a href="<?php echo APP_URL; ?>/pages/dashboard/index.php"
                class="flex items-center gap-3 rounded-lg px-3 py-2 text-muted-foreground transition-all hover:bg-muted/50 hover:text-foreground <?php echo $isActive('/dashboard') ? 'bg-muted text-foreground font-medium' : ''; ?>">
                <i data-lucide="layout-dashboard" class="h-5 w-5"></i>
                <span>Dashboard</span>
            </a>
            <a href="<?php echo APP_URL; ?>/pages/reports/index.php"
                class="flex items-center gap-3 rounded-lg px-3 py-2 text-muted-foreground transition-all hover:bg-muted/50 hover:text-foreground <?php echo $isActive('/reports') ? 'bg-muted text-foreground font-medium' : ''; ?>">
                <i data-lucide="file-text" class="h-5 w-5"></i>
                <span>Reports</span>
            </a>
        </nav>
    </div>
</aside>

<!-- Sidebar Overlay (Mobile) -->
<div id="sidebar-overlay" class="fixed inset-0 z-30 bg-black/50 hidden md:hidden"></div>