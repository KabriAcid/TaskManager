<?php
require_once __DIR__ . '/../../includes/auth/session.php';
$currentUser = getCurrentUser();
?>

<!-- Top Navigation Bar -->
<header class="sticky top-0 z-10 flex h-16 items-center gap-4 border-b border-gray-200 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 px-4 backdrop-blur-sm md:px-6 ml-0 md:ml-64">
    <!-- Mobile Menu Trigger -->
    <button id="sidebar-trigger" class="inline-flex items-center justify-center rounded-md p-2 text-gray-700 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 hover:text-indigo-600 dark:hover:text-indigo-400 md:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
        </svg>
    </button>

    <div class="w-full flex-1">
        <!-- Can add breadcrumbs or page title here -->
    </div>

    <!-- User Navigation -->
    <?php include __DIR__ . '/../dashboard/user-nav.php'; ?>
</header>