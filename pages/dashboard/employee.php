<?php
require_once __DIR__ . '/../../includes/config/config.php';
require_once __DIR__ . '/../../includes/helpers/session.php';
require_once __DIR__ . '/../../includes/database/db.php';

requireAuth();
$currentUser = getCurrentUser();
$pageTitle = 'Employee Dashboard';

// Get all tasks with user details
$allTasks = getTasksWithUsers();

// Filter tasks assigned to this user
$assignedTasks = array_filter($allTasks, function ($task) use ($currentUser) {
    return $task['assignee']['id'] === $currentUser['id'];
});

// Calculate stats
$totalTasks = count($assignedTasks);
$completedTasks = count(array_filter($assignedTasks, fn($t) => $t['status'] === 'Done'));
$overdueTasks = count(array_filter($assignedTasks, fn($t) => strtotime($t['deadline']) < time() && $t['status'] !== 'Done'));
$inProgressTasks = count(array_filter($assignedTasks, fn($t) => $t['status'] === 'In Progress'));

// Include header and layout
include __DIR__ . '/../../layout/header.php';
?>

<div class="flex min-h-screen">
    <?php include __DIR__ . '/../../layout/sidebar.php'; ?>

    <div class="flex-1 md:ml-64">
        <?php include __DIR__ . '/../../layout/navigation.php'; ?>

        <main class="p-4 lg:p-6">
            <div class="space-y-6">
                <div class="space-y-2">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                        Welcome back, <?php echo explode(' ', $currentUser['name'])[0]; ?>!
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400">Here are your assigned tasks and current workload.</p>
                </div>

                <!-- Stats Grid -->
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                    <?php
                    require_once 'stat-card.php';
                    renderStatCard('My Total Tasks', $totalTasks, 'list-checks', 'All tasks assigned to you', 'blue');
                    renderStatCard('Completed', $completedTasks, 'check-circle', "Tasks you've finished", 'purple');
                    renderStatCard('Overdue', $overdueTasks, 'alert-circle', 'Require your urgent attention', 'pink');
                    renderStatCard('In Progress', $inProgressTasks, 'clock', 'What you are working on', 'indigo');
                    ?>
                </div>

                <!-- Tasks Table -->
                <div>
                    <?php
                    require_once '../tasks/tasks-table.php';
                    renderTasksTable(array_values($assignedTasks), 'My Tasks');
                    ?>
                </div>
            </div>
        </main>
    </div>
</div>

<?php
$additionalScripts = '<script src="' . APP_URL . '/public/js/dashboard.js"></script>';
include __DIR__ . '/../../layout/footer.php';
?>