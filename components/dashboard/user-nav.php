<?php
require_once __DIR__ . '/../../includes/database/db.php';

if (!$currentUser) return;
$allUsers = getAllUsers();
?>

<!-- User Navigation Dropdown -->
<div class="relative">
    <button id="user-nav-trigger" class="relative h-10 w-10 rounded-full hover:opacity-80 transition-opacity">
        <img src="<?php echo htmlspecialchars($currentUser['avatar']); ?>"
            alt="<?php echo htmlspecialchars($currentUser['name']); ?>"
            class="h-10 w-10 rounded-full border-2 border-primary/50 object-cover">
    </button>

    <!-- Dropdown Menu -->
    <div id="user-nav-menu" class="hidden absolute right-0 mt-2 w-56 rounded-md border border-border bg-popover shadow-lg">
        <!-- User Info -->
        <div class="px-4 py-3 border-b border-border">
            <p class="text-sm font-medium leading-none"><?php echo htmlspecialchars($currentUser['name']); ?></p>
            <p class="text-xs leading-none text-muted-foreground mt-1"><?php echo htmlspecialchars($currentUser['email']); ?></p>
        </div>

        <!-- Switch Account Section -->
        <div class="p-2">
            <div class="px-2 py-1.5 text-xs font-semibold text-muted-foreground flex items-center gap-2">
                <i data-lucide="users" class="h-4 w-4"></i>
                <span>Switch Account</span>
            </div>
            <?php foreach ($allUsers as $user): ?>
                <button onclick="switchUser('<?php echo $user['id']; ?>')"
                    class="flex w-full items-center gap-2 rounded-sm px-2 py-1.5 text-sm hover:bg-accent hover:text-accent-foreground cursor-pointer">
                    <i data-lucide="user" class="h-4 w-4"></i>
                    <span><?php echo htmlspecialchars($user['name']); ?> (<?php echo htmlspecialchars($user['role']); ?>)</span>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Logout -->
        <div class="border-t border-border p-2">
            <a href="<?php echo APP_URL; ?>/pages/auth/logout.php"
                class="flex w-full items-center gap-2 rounded-sm px-2 py-1.5 text-sm text-muted-foreground hover:bg-accent hover:text-accent-foreground">
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