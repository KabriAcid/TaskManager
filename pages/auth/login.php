<?php
require_once __DIR__ . '/../../includes/config/config.php';
require_once __DIR__ . '/../../includes/auth/session.php';
require_once __DIR__ . '/../../includes/database/db.php';

// If already logged in, redirect to dashboard
if (isLoggedIn()) {
    header('Location: ' . APP_URL . '/pages/dashboard/index.php');
    exit;
}

// Demo Login Logic: If no user is logged in, auto-login as Admin for demo purposes.
if (!isLoggedIn()) {
    $users = getAllUsers();
    $adminUser = null;
    foreach ($users as $user) {
        if ($user['role'] === 'Admin') {
            $adminUser = $user;
            break;
        }
    }
    if ($adminUser) {
        setUserSession($adminUser);
        header('Location: ' . APP_URL . '/pages/dashboard/index.php');
        exit;
    }
}


$pageTitle = 'Login';
include __DIR__ . '/../../components/layout/header.php';
?>

<div class="flex items-center justify-center min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="w-full max-w-md p-8 space-y-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="text-center">
            <a href="<?php echo APP_URL; ?>" class="flex items-center justify-center mb-4">
                <svg class="h-10 w-10 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
                <span class="ml-2 text-3xl font-bold text-foreground">TaskManager</span>
            </a>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Sign in to your account</h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Or
                <a href="<?php echo APP_URL; ?>/pages/auth/register.php" class="font-medium text-primary hover:underline">
                    start your 14-day free trial
                </a>
            </p>
        </div>
        <form id="login-form" class="mt-8 space-y-6">
            <div id="error-message" class="hidden p-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
            </div>
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="email-address" class="sr-only">Email address</label>
                    <input id="email-address" name="email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm" placeholder="Email address" value="admin@example.com">
                </div>
                <div>
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm" placeholder="Password" value="password">
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                    <label for="remember-me" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
                        Remember me
                    </label>
                </div>

                <div class="text-sm">
                    <a href="#" class="font-medium text-primary hover:underline">
                        Forgot your password?
                    </a>
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    Sign in
                </button>
            </div>
        </form>
    </div>
</div>
<?php include __DIR__ . '/../../components/layout/footer.php'; ?>