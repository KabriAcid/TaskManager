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
    <div class="rounded-lg border border-border bg-card text-card-foreground shadow-sm">
        <!-- Card Header -->
        <div class="flex flex-col space-y-1.5 p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h3 class="text-2xl font-semibold leading-none tracking-tight"><?php echo htmlspecialchars($title); ?></h3>
                    <p class="text-sm text-muted-foreground mt-1.5">View, search, and manage tasks.</p>
                </div>
                <button onclick="openCreateTaskDialog()" class="inline-flex items-center justify-center rounded-md text-sm font-medium bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2">
                    <i data-lucide="plus-circle" class="mr-2 h-4 w-4"></i>
                    Create Task
                </button>
            </div>

            <!-- Filters -->
            <div class="flex flex-col gap-4 pt-4">
                <div class="flex flex-col md:flex-row gap-2">
                    <div class="relative flex-1">
                        <i data-lucide="search" class="absolute left-2.5 top-2.5 h-4 w-4 text-muted-foreground"></i>
                        <input type="text" id="search-input-<?php echo md5($title); ?>"
                            placeholder="Search tasks..."
                            class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 pl-8 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                    </div>
                    <select id="priority-filter-<?php echo md5($title); ?>" onchange="filterTasks('<?php echo md5($title); ?>')"
                        class="flex h-10 w-full md:w-[180px] items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2">
                        <option value="all">All Priorities</option>
                        <option value="Urgent">Urgent</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                    <select id="status-filter-<?php echo md5($title); ?>" onchange="filterTasks('<?php echo md5($title); ?>')"
                        class="flex h-10 w-full md:w-[180px] items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2">
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
                        <tr class="border-b transition-colors hover:bg-muted/50">
                            <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Task</th>
                            <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Status</th>
                            <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Priority</th>
                            <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Deadline</th>
                            <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Assignee</th>
                        </tr>
                    </thead>
                    <tbody class="[&_tr:last-child]:border-0">
                        <?php if (count($tasks) > 0): ?>
                            <?php foreach ($tasks as $task): ?>
                                <tr class="border-b transition-colors hover:bg-muted/50 task-row"
                                    data-priority="<?php echo htmlspecialchars($task['priority']); ?>"
                                    data-status="<?php echo htmlspecialchars($task['status']); ?>"
                                    data-title="<?php echo htmlspecialchars(strtolower($task['title'])); ?>">
                                    <td class="p-4 align-middle font-medium"><?php echo htmlspecialchars($task['title']); ?></td>
                                    <td class="p-4 align-middle">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold text-primary-foreground <?php echo $statusColors[$task['status']]; ?>">
                                            <?php echo htmlspecialchars($task['status']); ?>
                                        </span>
                                    </td>
                                    <td class="p-4 align-middle">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold text-primary-foreground <?php echo $priorityColors[$task['priority']]; ?>">
                                            <?php echo htmlspecialchars($task['priority']); ?>
                                        </span>
                                    </td>
                                    <td class="p-4 align-middle"><?php echo date('M j, Y', strtotime($task['deadline'])); ?></td>
                                    <td class="p-4 align-middle">
                                        <div class="flex items-center gap-2">
                                            <img src="<?php echo htmlspecialchars($task['assignee']['avatar']); ?>"
                                                alt="<?php echo htmlspecialchars($task['assignee']['name']); ?>"
                                                class="h-8 w-8 rounded-full object-cover">
                                            <span><?php echo htmlspecialchars($task['assignee']['name']); ?></span>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="p-4 text-center text-muted-foreground">No tasks found.</td>
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