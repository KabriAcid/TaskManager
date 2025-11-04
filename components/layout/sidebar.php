<?php
$currentPath = $_SERVER['REQUEST_URI'];
$isActive = function ($path) use ($currentPath) {
    if ($path === '/dashboard' || $path === '/') {
        return strpos($currentPath, 'dashboard/index.php') !== false ||
            strpos($currentPath, 'TaskManager/pages/dashboard/') !== false ||
            $currentPath === APP_URL . '/';
    }
    return strpos($currentPath, $path) !== false;
};
?>

<!-- Sidebar -->
<aside id="sidebar" class="fixed left-0 top-0 z-40 h-screen w-64 transition-transform -translate-x-full md:translate-x-0 bg-sidebar-background border-r border-sidebar-border">
    <!-- Sidebar Header -->
    <div class="flex h-16 items-center gap-2 border-b border-sidebar-border px-6">
        <i data-lucide="bot" class="w-8 h-8 text-primary"></i>
        <h1 class="text-xl font-bold font-headline text-primary">TaskManager Pro</h1>
    </div>

    <!-- Sidebar Content -->
    <div class="flex flex-col gap-2 p-4">
        <nav class="flex flex-col gap-1">
            <a href="<?php echo APP_URL; ?>/pages/dashboard/index.php"
                class="flex items-center gap-3 rounded-lg px-3 py-2 text-sidebar-foreground transition-all hover:bg-sidebar-accent <?php echo $isActive('/dashboard') ? 'bg-sidebar-accent font-medium' : ''; ?>">
                <i data-lucide="layout-dashboard" class="h-5 w-5"></i>
                <span>Dashboard</span>
            </a>
            <a href="<?php echo APP_URL; ?>/pages/reports/index.php"
                class="flex items-center gap-3 rounded-lg px-3 py-2 text-sidebar-foreground transition-all hover:bg-sidebar-accent <?php echo $isActive('/reports') ? 'bg-sidebar-accent font-medium' : ''; ?>">
                <i data-lucide="file-text" class="h-5 w-5"></i>
                <span>Reports</span>
            </a>
        </nav>
    </div>
</aside>

<!-- Sidebar Overlay (Mobile) -->
<div id="sidebar-overlay" class="fixed inset-0 z-30 bg-black/50 hidden md:hidden"></div>