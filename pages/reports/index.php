<?php
require_once __DIR__ . '/../../includes/config/config.php';
require_once __DIR__ . '/../../includes/auth/session.php';
require_once __DIR__ . '/../../includes/database/db.php';

requireAuth();
$currentUser = getCurrentUser();
$pageTitle = 'Reports';

// Get all tasks
$tasks = getTasksWithUsers();

// Filter tasks by time period
$dailyTasks = array_filter($tasks, fn($t) => strtotime($t['created_at']) > strtotime('-1 day'));
$weeklyTasks = array_filter($tasks, fn($t) => strtotime($t['created_at']) > strtotime('-7 days'));
$monthlyTasks = array_filter($tasks, fn($t) => strtotime($t['created_at']) > strtotime('-30 days'));

include __DIR__ . '/../../components/layout/header.php';
?>

<div class="flex min-h-screen">
    <?php include __DIR__ . '/../../components/layout/sidebar.php'; ?>

    <div class="flex-1 md:ml-64">
        <?php include __DIR__ . '/../../components/layout/navigation.php'; ?>

        <main class="p-4 lg:p-6">
            <div class="flex-1 space-y-4">
                <div class="flex items-center justify-between space-y-2">
                    <div>
                        <h2 class="text-3xl font-bold tracking-tight font-headline">Reports</h2>
                        <p class="text-muted-foreground">View summaries of task activity and performance.</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button disabled class="inline-flex items-center justify-center rounded-md text-sm font-medium bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 opacity-50 cursor-not-allowed">
                            <i data-lucide="download" class="mr-2 h-4 w-4"></i>
                            Export to PDF
                        </button>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="space-y-4">
                    <div class="flex space-x-1 rounded-lg bg-muted p-1">
                        <button onclick="switchTab('daily')" id="tab-daily" class="tab-btn flex-1 rounded-md px-3 py-1.5 text-sm font-medium transition-all bg-background shadow">Daily</button>
                        <button onclick="switchTab('weekly')" id="tab-weekly" class="tab-btn flex-1 rounded-md px-3 py-1.5 text-sm font-medium transition-all hover:bg-background/50">Weekly</button>
                        <button onclick="switchTab('monthly')" id="tab-monthly" class="tab-btn flex-1 rounded-md px-3 py-1.5 text-sm font-medium transition-all hover:bg-background/50">Monthly</button>
                    </div>

                    <!-- Daily Tab -->
                    <div id="content-daily" class="tab-content">
                        <div class="rounded-lg border border-border bg-card text-card-foreground shadow-sm">
                            <div class="flex flex-col space-y-1.5 p-6">
                                <h3 class="text-2xl font-semibold leading-none tracking-tight">Daily Summary</h3>
                                <p class="text-sm text-muted-foreground">Task summary for the last 24 hours.</p>
                            </div>
                            <div class="p-6 pt-0">
                                <?php include __DIR__ . '/../../components/reports/task-summary-chart.php';
                                renderTaskSummaryChart($dailyTasks, 'daily'); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Weekly Tab -->
                    <div id="content-weekly" class="tab-content hidden">
                        <div class="rounded-lg border border-border bg-card text-card-foreground shadow-sm">
                            <div class="flex flex-col space-y-1.5 p-6">
                                <h3 class="text-2xl font-semibold leading-none tracking-tight">Weekly Summary</h3>
                                <p class="text-sm text-muted-foreground">Task summary for the last 7 days.</p>
                            </div>
                            <div class="p-6 pt-0">
                                <?php renderTaskSummaryChart($weeklyTasks, 'weekly'); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Tab -->
                    <div id="content-monthly" class="tab-content hidden">
                        <div class="rounded-lg border border-border bg-card text-card-foreground shadow-sm">
                            <div class="flex flex-col space-y-1.5 p-6">
                                <h3 class="text-2xl font-semibold leading-none tracking-tight">Monthly Summary</h3>
                                <p class="text-sm text-muted-foreground">Task summary for the last 30 days.</p>
                            </div>
                            <div class="p-6 pt-0">
                                <?php renderTaskSummaryChart($monthlyTasks, 'monthly'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    function switchTab(tabName) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });

        // Remove active state from all tabs
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('bg-background', 'shadow');
            btn.classList.add('hover:bg-background/50');
        });

        // Show selected tab content
        document.getElementById('content-' + tabName).classList.remove('hidden');

        // Add active state to selected tab
        const activeTab = document.getElementById('tab-' + tabName);
        activeTab.classList.add('bg-background', 'shadow');
        activeTab.classList.remove('hover:bg-background/50');
    }
</script>

<?php
$additionalScripts = '<script src="' . APP_URL . '/public/js/reports.js"></script>';
include __DIR__ . '/../../components/layout/footer.php';
?>