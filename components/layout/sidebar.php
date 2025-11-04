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
<aside id="sidebar" class="fixed left-0 top-0 z-40 h-screen w-64 transition-transform -translate-x-full md:translate-x-0 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700">
    <!-- Sidebar Header -->
    <div class="flex h-16 items-center gap-2.5 border-b border-gray-200 dark:border-gray-700 px-6 bg-gradient-to-r from-indigo-600 to-purple-600">
        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
        </svg>
        <h1 class="text-xl font-bold text-white">TaskFlow</h1>
    </div>

    <!-- Sidebar Content -->
    <div class="flex flex-col gap-2 p-4">
        <nav class="flex flex-col gap-1">
            <a href="<?php echo APP_URL; ?>/pages/dashboard/index.php"
                class="flex items-center gap-3 rounded-lg px-3 py-2 text-gray-700 dark:text-gray-300 transition-all hover:bg-indigo-50 dark:hover:bg-indigo-900/20 hover:text-indigo-600 dark:hover:text-indigo-400 <?php echo $isActive('/dashboard') ? 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 font-medium' : ''; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"></rect>
                    <rect x="14" y="3" width="7" height="7"></rect>
                    <rect x="14" y="14" width="7" height="7"></rect>
                    <rect x="3" y="14" width="7" height="7"></rect>
                </svg>
                <span>Dashboard</span>
            </a>
            <a href="<?php echo APP_URL; ?>/pages/reports/index.php"
                class="flex items-center gap-3 rounded-lg px-3 py-2 text-gray-700 dark:text-gray-300 transition-all hover:bg-indigo-50 dark:hover:bg-indigo-900/20 hover:text-indigo-600 dark:hover:text-indigo-400 <?php echo $isActive('/reports') ? 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 font-medium' : ''; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
                <span>Reports</span>
            </a>
        </nav>
    </div>
</aside>

<!-- Sidebar Overlay (Mobile) -->
<div id="sidebar-overlay" class="fixed inset-0 z-30 bg-black/50 hidden md:hidden"></div>