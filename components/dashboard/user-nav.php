<?php
require_once __DIR__ . '/../../includes/auth/functions.php';

if (!$currentUser) return;
$allUsers = getAllUsers();
?>

<!-- User Navigation Dropdown -->
<div class="relative">
    <button id="user-nav-trigger" class="relative h-10 w-10 rounded-full hover:opacity-80 transition-opacity ring-2 ring-indigo-500 hover:ring-indigo-600">
        <img src="<?php echo htmlspecialchars($currentUser['avatar']); ?>"
            alt="<?php echo htmlspecialchars($currentUser['name']); ?>"
            class="h-10 w-10 rounded-full object-cover">
    </button>

    <!-- Dropdown Menu -->
    <div id="user-nav-menu" class="hidden absolute right-0 mt-2 w-56 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-lg">
        <!-- User Info -->
        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20">
            <p class="text-sm font-medium leading-none text-gray-900 dark:text-white"><?php echo htmlspecialchars($currentUser['name']); ?></p>
            <p class="text-xs leading-none text-gray-600 dark:text-gray-400 mt-1"><?php echo htmlspecialchars($currentUser['email']); ?></p>
        </div>

        <!-- Switch Account Section -->
        <div class="p-2">
            <div class="px-2 py-1.5 text-xs font-semibold text-gray-600 dark:text-gray-400 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <span>Switch Account</span>
            </div>
            <?php foreach ($allUsers as $user): ?>
                <button onclick="switchUser('<?php echo $user['id']; ?>')"
                    class="flex w-full items-center gap-2 rounded-md px-2 py-1.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 hover:text-indigo-600 dark:hover:text-indigo-400 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span><?php echo htmlspecialchars($user['name']); ?> (<?php echo htmlspecialchars($user['role']); ?>)</span>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Logout -->
        <div class="border-t border-gray-200 dark:border-gray-700 p-2">
            <a href="<?php echo APP_URL; ?>/pages/auth/logout.php"
                class="flex w-full items-center gap-2 rounded-md px-2 py-1.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                Log out
            </a>
        </div>
    </div>
</div>

<script>
    // Toggle user navigation menu
    document.getElementById('user-nav-trigger').addEventListener('click', function(e) {
        e.stopPropagation();
        const menu = document.getElementById('user-nav-menu');
        menu.classList.toggle('hidden');
    });

    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        const menu = document.getElementById('user-nav-menu');
        const trigger = document.getElementById('user-nav-trigger');
        if (!menu.contains(e.target) && !trigger.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });

    // Switch user function
    function switchUser(userId) {
        fetch('<?php echo APP_URL; ?>/api/auth/switch-user.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    userId: userId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    showToast('Error switching user', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Failed to switch user', 'error');
            });
    }
</script>
