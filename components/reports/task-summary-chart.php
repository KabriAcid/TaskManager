<?php
function renderTaskSummaryChart($tasks, $chartId)
{
    // Calculate status counts
    $statusCounts = [
        'To Do' => 0,
        'In Progress' => 0,
        'Done' => 0,
        'Cancelled' => 0
    ];

    foreach ($tasks as $task) {
        if (isset($statusCounts[$task['status']])) {
            $statusCounts[$task['status']]++;
        }
    }

    $chartData = json_encode([
        ['status' => 'To Do', 'count' => $statusCounts['To Do']],
        ['status' => 'In Progress', 'count' => $statusCounts['In Progress']],
        ['status' => 'Done', 'count' => $statusCounts['Done']],
        ['status' => 'Cancelled', 'count' => $statusCounts['Cancelled']]
    ]);
?>
    <div class="w-full" style="min-height: 300px;">
        <canvas id="chart-<?php echo $chartId; ?>" class="w-full"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        (function() {
            const ctx = document.getElementById('chart-<?php echo $chartId; ?>').getContext('2d');
            const data = <?php echo $chartData; ?>;

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.map(d => d.status),
                    datasets: [{
                        label: 'Tasks',
                        data: data.map(d => d.count),
                        backgroundColor: 'hsl(var(--primary))',
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Tasks: ' + context.parsed.y;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                precision: 0
                            }
                        }
                    }
                }
            });
        })();
    </script>
<?php
}
?>