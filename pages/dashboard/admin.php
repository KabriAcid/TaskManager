<?php
if (!isset($currentUser)) {
    require_once __DIR__ . '/../../includes/config/config.php';
    require_once __DIR__ . '/../../includes/helpers/session.php';
    require_once __DIR__ . '/../../includes/database/db.php';
    requireAuth();
    $currentUser = getCurrentUser();
    $pageTitle = 'Admin Dashboard';
}

// Get all tasks with user details
$tasks = getTasksWithUsers();

// Calculate stats
$totalTasks = count($tasks);
$completedTasks = count(array_filter($tasks, fn($t) => $t['status'] === 'Done'));
$urgentTasks = count(array_filter($tasks, fn($t) => $t['priority'] === 'Urgent'));
$inProgressTasks = count(array_filter($tasks, fn($t) => $t['status'] === 'In Progress'));

// Include header and layout
include __DIR__ . '/../../components/layout/header.php';
?>

<div class="flex min-h-screen">
    <?php include __DIR__ . '/../../components/layout/sidebar.php'; ?>

    <div class="flex-1 md:ml-64">
        <?php include __DIR__ . '/../../components/layout/navigation.php'; ?>

        <main class="p-4 lg:p-6">
            <div class="space-y-6">
                <div class="space-y-2">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                        Welcome, Admin <?php echo explode(' ', $currentUser['name'])[0]; ?>!
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400">Here's the full overview of your organization's activities.</p>
                </div>

                <!-- Stats Grid -->
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                    <?php
                    require_once __DIR__ . '/../../components/dashboard/stat-card.php';
                    renderStatCard('Total Tasks', $totalTasks, 'list-checks', $completedTasks . ' completed', 'purple');
                    renderStatCard('Active Users', 5, 'users', 'Across 3 departments', 'indigo');
                    renderStatCard('Urgent Tasks', $urgentTasks, 'alert-circle', 'Require immediate attention', 'pink');
                    renderStatCard('In Progress', $inProgressTasks, 'clock', 'Currently being worked on', 'blue');
                    ?>
                </div>

                <!-- Tasks Table -->
                <div>
                    <?php
                    require_once __DIR__ . '/../../components/tasks/tasks-table.php';
                    renderTasksTable($tasks, 'All Tasks');
                    ?>
                </div>
            </div>
        </main>
    </div>
</div>

<?php
$additionalScripts = '<script src="' . APP_URL . '/public/js/dashboard.js"></script>';
include __DIR__ . '/../../components/layout/footer.php';
?>