<?php
require_once __DIR__ . '/../../includes/config/config.php';
require_once __DIR__ . '/../../includes/helpers/session.php';
require_once __DIR__ . '/../../includes/helpers/functions.php';

// If already logged in, redirect to dashboard
if (isLoggedIn()) {
    header('Location: ' . APP_URL . '/pages/dashboard/index.php');
    exit;
}

$pageTitle = 'Login';
include __DIR__ . '/../../layout/header.php';
?>

<div class="min-h-screen bg-gray-50 dark:bg-gray-900 flex items-center justify-center p-4">
    <div class="w-full max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-2xl grid md:grid-cols-2">
        <!-- Brand Panel -->
        <div class="hidden md:flex flex-col justify-center p-12 bg-gradient-to-br from-indigo-600 to-purple-700 text-white rounded-l-2xl">
            <a href="<?php echo APP_URL; ?>" class="flex items-center gap-3 mb-6">
                <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
                <span class="text-3xl font-bold">TaskFlow</span>
            </a>
            <h1 class="text-3xl font-bold mb-4">Welcome Back!</h1>
            <p class="text-indigo-200">
                Sign in to access your dashboard, manage tasks, and stay on top of your projects.
            </p>
        </div>

        <!-- Form Panel -->
        <div class="p-8 md:p-12">
            <div class="text-center md:hidden mb-6">
                 <a href="<?php echo APP_URL; ?>" class="flex items-center justify-center gap-3 mb-4">
                    <svg class="h-8 w-8 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    <span class="text-2xl font-bold text-gray-900 dark:text-white">TaskFlow</span>
                </a>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Sign In</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-6">Enter your credentials to continue.</p>
            
            <form id="login-form" class="space-y-5" method="POST" action="<?php echo APP_URL; ?>/api/auth/login.php">
                <div id="error-message" class="hidden p-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert"></div>
                
                <div class="relative">
                    <label for="email-address" class="sr-only">Email address</label>
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="mail" class="w-5 h-5 text-gray-400"></i>
                    </div>
                    <input id="email-address" name="email" type="email" autocomplete="email" required
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Email address" value="admin@taskflow.com">
                </div>
                
                <div class="relative">
                    <label for="password" class="sr-only">Password</label>
                     <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="lock" class="w-5 h-5 text-gray-400"></i>
                    </div>
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Password" value="Pa$$w0rd!">
                </div>

                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center gap-2">
                        <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remember-me" class="text-gray-600 dark:text-gray-300">Remember me</label>
                    </div>
                    <a href="#" class="font-medium text-indigo-600 hover:underline">Forgot password?</a>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 shadow-lg hover:shadow-indigo-500/50">
                        Sign In
                    </button>
                </div>
                <div class="text-sm text-center">
                    <p class="text-gray-600 dark:text-gray-400">Don't have an account?
                        <a href="register.php" class="font-medium text-indigo-600 hover:underline">Register here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('login-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);
        const errorMessage = document.getElementById('error-message');

        fetch(form.action, {
                method: 'POST',
                body: JSON.stringify(Object.fromEntries(formData)),
                headers: { 'Content-Type': 'application/json' }
            })
            .then(response => response.json().then(data => ({ status: response.status, body: data })))
            .then(({ status, body }) => {
                if (status === 200 && body.success) {
                    window.location.href = '<?php echo APP_URL; ?>/pages/dashboard/index.php';
                } else {
                    errorMessage.textContent = body.message || 'An unknown error occurred.';
                    errorMessage.classList.remove('hidden');
                }
            }).catch(error => {
                errorMessage.textContent = 'A network error occurred. Please try again.';
                errorMessage.classList.remove('hidden');
            });
    });
</script>
<?php include __DIR__ . '/../../layout/footer.php'; ?>
