<?php
require_once __DIR__ . '/../../includes/config/config.php';
require_once __DIR__ . '/../../includes/helpers/session.php';
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
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Reports</h2>
                        <p class="text-gray-600 dark:text-gray-400">View summaries of task activity and performance.</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button disabled class="inline-flex items-center justify-center rounded-lg text-sm font-medium bg-gradient-to-r from-indigo-600 to-purple-600 text-white h-10 px-4 py-2 opacity-50 cursor-not-allowed">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="7 10 12 15 17 10"></polyline>
                                <line x1="12" y1="15" x2="12" y2="3"></line>
                            </svg>
                            Export to PDF
                        </button>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="space-y-4">
                    <div class="flex space-x-1 rounded-lg bg-gray-100 dark:bg-gray-800 p-1">
                        <button onclick="switchTab('daily')" id="tab-daily" class="tab-btn flex-1 rounded-md px-3 py-1.5 text-sm font-medium transition-all bg-white dark:bg-gray-700 shadow-sm text-indigo-600 dark:text-indigo-400">Daily</button>
                        <button onclick="switchTab('weekly')" id="tab-weekly" class="tab-btn flex-1 rounded-md px-3 py-1.5 text-sm font-medium transition-all text-gray-600 dark:text-gray-400 hover:bg-white/50 dark:hover:bg-gray-700/50 hover:text-gray-900 dark:hover:text-white">Weekly</button>
                        <button onclick="switchTab('monthly')" id="tab-monthly" class="tab-btn flex-1 rounded-md px-3 py-1.5 text-sm font-medium transition-all text-gray-600 dark:text-gray-400 hover:bg-white/50 dark:hover:bg-gray-700/50 hover:text-gray-900 dark:hover:text-white">Monthly</button>
                    </div>

                    <!-- Daily Tab -->
                    <div id="content-daily" class="tab-content">
                        <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-lg">
                            <div class="flex flex-col space-y-1.5 p-6 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 rounded-t-xl">
                                <h3 class="text-2xl font-semibold leading-none tracking-tight text-gray-900 dark:text-white">Daily Summary</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Task summary for the last 24 hours.</p>
                            </div>
                            <div class="p-6 pt-0">
                                <?php include __DIR__ . '/../../components/reports/task-summary-chart.php';
                                renderTaskSummaryChart($dailyTasks, 'daily'); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Weekly Tab -->
                    <div id="content-weekly" class="tab-content hidden">
                        <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-lg">
                            <div class="flex flex-col space-y-1.5 p-6 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 rounded-t-xl">
                                <h3 class="text-2xl font-semibold leading-none tracking-tight text-gray-900 dark:text-white">Weekly Summary</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Task summary for the last 7 days.</p>
                            </div>
                            <div class="p-6 pt-0">
                                <?php renderTaskSummaryChart($weeklyTasks, 'weekly'); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Tab -->
                    <div id="content-monthly" class="tab-content hidden">
                        <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-lg">
                            <div class="flex flex-col space-y-1.5 p-6 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 rounded-t-xl">
                                <h3 class="text-2xl font-semibold leading-none tracking-tight text-gray-900 dark:text-white">Monthly Summary</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Task summary for the last 30 days.</p>
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
            btn.classList.remove('bg-white', 'dark:bg-gray-700', 'shadow-sm', 'text-indigo-600', 'dark:text-indigo-400');
            btn.classList.add('text-gray-600', 'dark:text-gray-400', 'hover:bg-white/50', 'dark:hover:bg-gray-700/50', 'hover:text-gray-900', 'dark:hover:text-white');
        });

        // Show selected tab content
        document.getElementById('content-' + tabName).classList.remove('hidden');

        // Add active state to selected tab
        const activeTab = document.getElementById('tab-' + tabName);
        activeTab.classList.add('bg-white', 'dark:bg-gray-700', 'shadow-sm', 'text-indigo-600', 'dark:text-indigo-400');
        activeTab.classList.remove('text-gray-600', 'dark:text-gray-400', 'hover:bg-white/50', 'dark:hover:bg-gray-700/50', 'hover:text-gray-900', 'dark:hover:text-white');
    }
</script>

<?php
$additionalScripts = '<script src="' . APP_URL . '/public/js/reports.js"></script>';
include __DIR__ . '/../../components/layout/footer.php';
?>