<?php
function renderStatCard($title, $value, $icon, $description = '', $gradient = 'purple')
{
    // Define gradient options matching index.php design
    $gradients = [
        'purple' => 'bg-gradient-to-br from-purple-500 to-indigo-600',
        'indigo' => 'bg-gradient-to-br from-indigo-500 to-purple-600',
        'blue' => 'bg-gradient-to-br from-blue-500 to-indigo-600',
        'pink' => 'bg-gradient-to-br from-pink-500 to-purple-600'
    ];

    $bgGradient = $gradients[$gradient] ?? $gradients['purple'];
?>
    <div class="rounded-xl <?php echo $bgGradient; ?> text-white shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
        <div class="flex flex-row items-center justify-between space-y-0 p-6 pb-2">
            <h3 class="text-sm font-medium tracking-tight opacity-90"><?php echo htmlspecialchars($title); ?></h3>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="opacity-75">
                <?php
                // Simple icon paths for common icons
                switch ($icon) {
                    case 'check-circle':
                        echo '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline>';
                        break;
                    case 'list-checks':
                        echo '<path d="M3 6h18"></path><path d="M3 12h18"></path><path d="M3 18h18"></path>';
                        break;
                    case 'alert-circle':
                        echo '<circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line>';
                        break;
                    case 'clock':
                        echo '<circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline>';
                        break;
                    default:
                        echo '<circle cx="12" cy="12" r="10"></circle>';
                }
                ?>
            </svg>
        </div>
        <div class="p-6 pt-0">
            <div class="text-3xl font-bold"><?php echo htmlspecialchars($value); ?></div>
            <?php if ($description): ?>
                <p class="text-sm opacity-90 mt-1"><?php echo htmlspecialchars($description); ?></p>
            <?php endif; ?>
        </div>
    </div>
<?php
}
?>