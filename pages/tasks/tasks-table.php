<?php
function renderTasksTable($tasks, $title)
{
    $priorityColors = [
        'Urgent' => 'bg-red-500 hover:bg-red-600',
        'High' => 'bg-orange-500 hover:bg-orange-600',
        'Medium' => 'bg-yellow-500 hover:bg-yellow-600',
        'Low' => 'bg-green-500 hover:bg-green-600',
    ];

    $statusColors = [
        'To Do' => 'bg-gray-500',
        'In Progress' => 'bg-blue-500',
        'Done' => 'bg-green-500',
        'Cancelled' => 'bg-red-500',
    ];
?>
    <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-lg">
        <!-- Card Header -->
        <div class="flex flex-col space-y-1.5 p-6 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 rounded-t-xl">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h3 class="text-2xl font-semibold leading-none tracking-tight text-gray-900 dark:text-white"><?php echo htmlspecialchars($title); ?></h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1.5">View, search, and manage tasks.</p>
                </div>
                <button onclick="openCreateTaskDialog()" class="inline-flex items-center justify-center rounded-lg text-sm font-medium bg-gradient-to-r from-indigo-600 to-purple-600 text-white hover:from-indigo-700 hover:to-purple-700 h-10 px-4 py-2 transition-all duration-200 shadow-md hover:shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="16"></line>
                        <line x1="8" y1="12" x2="16" y2="12"></line>
                    </svg>
                    Create Task
                </button>
            </div>

            <!-- Filters -->
            <div class="flex flex-col gap-4 pt-4">
                <div class="flex flex-col md:flex-row gap-2">
                    <div class="relative flex-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-2.5 top-2.5 text-gray-500">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                        <input type="text" id="search-input-<?php echo md5($title); ?>"
                            placeholder="Search tasks..."
                            class="flex h-10 w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 pl-8 text-sm text-gray-900 dark:text-white placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                    <select id="priority-filter-<?php echo md5($title); ?>" onchange="filterTasks('<?php echo md5($title); ?>')"
                        class="flex h-10 w-full md:w-[180px] items-center justify-between rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="all">All Priorities</option>
                        <option value="Urgent">Urgent</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                    <select id="status-filter-<?php echo md5($title); ?>" onchange="filterTasks('<?php echo md5($title); ?>')"
                        class="flex h-10 w-full md:w-[180px] items-center justify-between rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="all">All Statuses</option>
                        <option value="To Do">To Do</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Done">Done</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Card Content -->
        <div class="p-6 pt-0">
            <div class="overflow-x-auto">
                <table class="w-full caption-bottom text-sm" id="tasks-table-<?php echo md5($title); ?>">
                    <thead class="[&_tr]:border-b">
                        <tr class="border-b border-gray-200 dark:border-gray-700 transition-colors hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <th class="h-12 px-4 text-left align-middle font-medium text-gray-600 dark:text-gray-400">Task</th>
                            <th class="h-12 px-4 text-left align-middle font-medium text-gray-600 dark:text-gray-400">Status</th>
                            <th class="h-12 px-4 text-left align-middle font-medium text-gray-600 dark:text-gray-400">Priority</th>
                            <th class="h-12 px-4 text-left align-middle font-medium text-gray-600 dark:text-gray-400">Deadline</th>
                            <th class="h-12 px-4 text-left align-middle font-medium text-gray-600 dark:text-gray-400">Assignee</th>
                        </tr>
                    </thead>
                    <tbody class="[&_tr:last-child]:border-0">
                        <?php if (count($tasks) > 0): ?>
                            <?php foreach ($tasks as $task): ?>
                                <tr class="border-b border-gray-200 dark:border-gray-700 transition-colors hover:bg-gray-50 dark:hover:bg-gray-700/50 task-row"
                                    data-priority="<?php echo htmlspecialchars($task['priority']); ?>"
                                    data-status="<?php echo htmlspecialchars($task['status']); ?>"
                                    data-title="<?php echo htmlspecialchars(strtolower($task['title'])); ?>">
                                    <td class="p-4 align-middle font-medium text-gray-900 dark:text-white"><?php echo htmlspecialchars($task['title']); ?></td>
                                    <td class="p-4 align-middle">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold text-white <?php echo $statusColors[$task['status']]; ?>">
                                            <?php echo htmlspecialchars($task['status']); ?>
                                        </span>
                                    </td>
                                    <td class="p-4 align-middle">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold text-white <?php echo $priorityColors[$task['priority']]; ?>">
                                            <?php echo htmlspecialchars($task['priority']); ?>
                                        </span>
                                    </td>
                                    <td class="p-4 align-middle text-gray-700 dark:text-gray-300"><?php echo date('M j, Y', strtotime($task['deadline'])); ?></td>
                                    <td class="p-4 align-middle">
                                        <div class="flex items-center gap-2">
                                            <img src="<?php echo htmlspecialchars($task['assignee']['avatar']); ?>"
                                                alt="<?php echo htmlspecialchars($task['assignee']['name']); ?>"
                                                class="h-8 w-8 rounded-full object-cover ring-2 ring-indigo-500">
                                            <span class="text-gray-900 dark:text-white"><?php echo htmlspecialchars($task['assignee']['name']); ?></span>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="p-4 text-center text-gray-600 dark:text-gray-400">No tasks found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Filter tasks function
        function filterTasks(tableId) {
            const priorityFilter = document.getElementById('priority-filter-' + tableId).value;
            const statusFilter = document.getElementById('status-filter-' + tableId).value;
            const searchInput = document.getElementById('search-input-' + tableId).value.toLowerCase();
            const table = document.getElementById('tasks-table-' + tableId);
            const rows = table.querySelectorAll('tbody .task-row');

            rows.forEach(row => {
                const priority = row.dataset.priority;
                const status = row.dataset.status;
                const title = row.dataset.title;

                const matchPriority = priorityFilter === 'all' || priority === priorityFilter;
                const matchStatus = statusFilter === 'all' || status === statusFilter;
                const matchSearch = searchInput === '' || title.includes(searchInput);

                if (matchPriority && matchStatus && matchSearch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Search on input
        document.getElementById('search-input-<?php echo md5($title); ?>').addEventListener('input', function() {
            filterTasks('<?php echo md5($title); ?>');
        });
    </script>
<?php
}
?>