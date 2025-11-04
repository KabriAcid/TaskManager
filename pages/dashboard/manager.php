<?php
if (!isset($currentUser)) {
    require_once __DIR__ . '/../../includes/config/config.php';
    require_once __DIR__ . '/../../includes/auth/session.php';
    require_once __DIR__ . '/../../includes/database/db.php';
    requireAuth();
    $currentUser = getCurrentUser();
    $pageTitle = 'Manager Dashboard';
}

// Get all tasks with user details
$allTasks = getTasksWithUsers();

// Filter tasks managed by this user
$managedTasks = array_filter($allTasks, function ($task) use ($currentUser) {
    return $task['assigner']['id'] === $currentUser['id'] || $task['assignee']['role'] !== 'Admin';
});

// Calculate stats
$totalTasks = count($managedTasks);
$completedTasks = count(array_filter($managedTasks, fn($t) => $t['status'] === 'Done'));
$overdueTasks = count(array_filter($managedTasks, fn($t) => strtotime($t['deadline']) < time() && $t['status'] !== 'Done'));
$inProgressTasks = count(array_filter($managedTasks, fn($t) => $t['status'] === 'In Progress'));

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
                        Hello, <?php echo htmlspecialchars($currentUser['name']); ?>!
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400">Here is an overview of your team's tasks and performance.</p>
                </div>

                <!-- Stats Grid -->
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                    <?php
                    require_once __DIR__ . '/../../components/dashboard/stat-card.php';
                    renderStatCard('Team Tasks', $totalTasks, 'list-checks', $completedTasks . ' completed', 'indigo');
                    renderStatCard('Team Members', 3, 'users', 'Active on projects', 'purple');
                    renderStatCard('Overdue Tasks', $overdueTasks, 'alert-circle', 'Need follow-up', 'pink');
                    renderStatCard('In Progress', $inProgressTasks, 'clock', 'Actively being worked on', 'blue');
                    ?>
                </div>

                <!-- Tasks Table -->
                <div>
                    <?php
                    require_once __DIR__ . '/../../components/tasks/tasks-table.php';
                    renderTasksTable(array_values($managedTasks), "Team's Tasks");
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