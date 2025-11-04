<?php
require_once __DIR__ . '/../../includes/auth/session.php';
$currentUser = getCurrentUser();
?>

<!-- Top Navigation Bar -->
<header class="sticky top-0 z-10 flex h-16 items-center gap-4 border-b bg-background/80 px-4 backdrop-blur-sm md:px-6 ml-0 md:ml-64">
    <!-- Mobile Menu Trigger -->
    <button id="sidebar-trigger" class="inline-flex items-center justify-center rounded-md p-2 text-foreground hover:bg-accent hover:text-accent-foreground md:hidden">
        <i data-lucide="menu" class="h-6 w-6"></i>
    </button>

    <div class="w-full flex-1">
        <!-- Can add breadcrumbs or page title here -->
    </div>

    <!-- User Navigation -->
    <?php include __DIR__ . '/../dashboard/user-nav.php'; ?>
</header>