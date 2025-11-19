<?php
session_start();
// Allow all domains to avoid CORS
header('Access-Control-Allow-Origin: *');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow - Employee Task Scheduling & Reporting System</title>
    <link href="public/css/output.css" rel="stylesheet">
    <script defer src="public/js/app.js"></script>
</head>

<body class="bg-gray-50 dark:bg-gray-900">
    <!-- Navigation -->
    <nav class="bg-white dark:bg-gray-800 shadow-sm fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                        <span class="ml-2 text-xl font-bold text-gray-900 dark:text-white">TaskFlow</span>
                    </a>
                </div>

                <div class="flex items-center space-x-4">
                    <?php if ($isLoggedIn ?? ''): ?>
                        <a href="pages/dashboard/index.php" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 transition">Dashboard</a>
                        <a href="api/auth/logout.php" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">Logout</a>
                    <?php else: ?>
                        <a href="pages/auth/login.php" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 transition">Login</a>
                        <a href="pages/auth/register.php" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">Sign Up</a>
                    <?php endif; ?>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" class="text-gray-700 dark:text-gray-300">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white dark:bg-gray-800 border-t dark:border-gray-700">
            <div class="px-4 py-2 space-y-2">
                <a href="#problem" class="block py-2 text-gray-700 dark:text-gray-300">The Problem</a>
                <a href="#how-it-works" class="block py-2 text-gray-700 dark:text-gray-300">How It Works</a>
                <a href="#features" class="block py-2 text-gray-700 dark:text-gray-300">Features</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-24 pb-16 bg-gradient-to-br from-indigo-50 to-white dark:from-gray-900 dark:to-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-5xl font-bold text-gray-900 dark:text-white mb-4 ">
                        Automate Employee Task <span class="text-indigo-600">Management</span>
                    </h1>
                    <p class="text-lg text-gray-600 dark:text-gray-300 mb-6">
                        A comprehensive system for assigning, tracking, and reporting employee tasks. Streamline your organization's workflow from manual paper-based processes to a modern, digital solution.
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-8 font-medium">
                        NEU/22/23/CSC/00086 | Final Year Academic Project
                    </p>
                    <div class="flex space-x-4">
                        <a href="pages/auth/register.php" class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition shadow-lg">
                            Sign Up Now
                        </a>
                        <a href="#how-it-works" class="bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 px-8 py-3 rounded-lg font-semibold border border-gray-300 dark:border-gray-700 hover:border-indigo-600 transition">
                            Learn More
                        </a>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="bg-gradient-to-br from-indigo-500 to-purple-600 p-1 rounded-2xl shadow-2xl">
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl">
                            <div class="space-y-4">
                                <div class="flex items-center space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg border-l-4 border-indigo-600">
                                    <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-900 dark:text-white text-sm">Project Proposal</p>
                                        <p class="text-xs text-gray-500">Assigned by Manager</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3 p-3 bg-yellow-50 dark:bg-gray-700 rounded-lg border-l-4 border-yellow-500">
                                    <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-900 dark:text-white text-sm">Report Submission</p>
                                        <p class="text-xs text-gray-500">Due tomorrow</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3 p-3 bg-green-50 dark:bg-gray-700 rounded-lg border-l-4 border-green-500">
                                    <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-900 dark:text-white text-sm">Completed Tasks</p>
                                        <p class="text-xs text-gray-500">5 this week</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Problem Statement Section -->
    <section id="problem" class="py-16 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">The Problem</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">Manual task management creates inefficiencies</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Problem 1 -->
                <div class="bg-red-50 dark:bg-gray-700 p-8 rounded-xl border-l-4 border-red-500">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-red-500 rounded-lg flex items-center justify-center mb-4 flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Paper-Based Records</h3>
                            <p class="text-gray-600 dark:text-gray-300">Tasks assigned verbally or on paper, leading to lost information and confusion.</p>
                        </div>
                    </div>
                </div>

                <!-- Problem 2 -->
                <div class="bg-red-50 dark:bg-gray-700 p-8 rounded-xl border-l-4 border-red-500">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-red-500 rounded-lg flex items-center justify-center mb-4 flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No Real-Time Tracking</h3>
                            <p class="text-gray-600 dark:text-gray-300">Managers cannot monitor progress; updates only available through manual reports.</p>
                        </div>
                    </div>
                </div>

                <!-- Problem 3 -->
                <div class="bg-red-50 dark:bg-gray-700 p-8 rounded-xl border-l-4 border-red-500">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-red-500 rounded-lg flex items-center justify-center mb-4 flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Manual Reporting</h3>
                            <p class="text-gray-600 dark:text-gray-300">Error-prone manual report compilation; difficult to generate performance statistics.</p>
                        </div>
                    </div>
                </div>

                <!-- Problem 4 -->
                <div class="bg-red-50 dark:bg-gray-700 p-8 rounded-xl border-l-4 border-red-500">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-red-500 rounded-lg flex items-center justify-center mb-4 flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Poor Organization</h3>
                            <p class="text-gray-600 dark:text-gray-300">Tasks scattered across notebooks and logbooks; no central repository.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Core Features</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">A minimal yet complete solution for task management</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg hover:shadow-xl transition border-t-4 border-indigo-600">
                    <div class="w-12 h-12 bg-indigo-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Task Assignment</h3>
                    <p class="text-gray-600 dark:text-gray-300">Managers assign tasks with title, description, priority, and deadline. Employees receive instant notifications.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg hover:shadow-xl transition border-t-4 border-green-600">
                    <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Real-Time Tracking</h3>
                    <p class="text-gray-600 dark:text-gray-300">Employees update task status (To Do, In Progress, Done). Managers see changes immediately on dashboard.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg hover:shadow-xl transition border-t-4 border-purple-600">
                    <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Reports & Analytics</h3>
                    <p class="text-gray-600 dark:text-gray-300">Generate daily, weekly, and monthly reports with charts. Track productivity and performance metrics.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-16 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">How It Works</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">From manual to automated task management</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4 text-white text-2xl font-bold shadow-lg">1</div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Sign Up & Login</h3>
                    <p class="text-gray-600 dark:text-gray-300">Register your account or login with demo credentials. Your role determines what you can see and do.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4 text-white text-2xl font-bold shadow-lg">2</div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Assign & Track Tasks</h3>
                    <p class="text-gray-600 dark:text-gray-300">Managers create and assign tasks. Employees receive notifications and update progress in real-time.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4 text-white text-2xl font-bold shadow-lg">3</div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Generate Reports</h3>
                    <p class="text-gray-600 dark:text-gray-300">System automatically generates daily, weekly, and monthly reports with visual analytics and insights.</p>
                </div>
            </div>

            <div class="mt-16 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-700 dark:to-gray-700 p-8 rounded-xl">
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <p class="font-semibold text-gray-900 dark:text-white">Role-Based Access</p>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Admin, Manager, Employee roles with appropriate permissions</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <p class="font-semibold text-gray-900 dark:text-white">Digital Records</p>
                            <p class="text-sm text-gray-600 dark:text-gray-300">All tasks and reports stored securely in database</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <p class="font-semibold text-gray-900 dark:text-white">Instant Visibility</p>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Real-time dashboard showing task status and progress</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Project Information Section -->
    <section class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Project Details</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">Academic implementation of an employee task management system</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg">
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">📚 Academic Context</h3>
                    <ul class="space-y-3 text-gray-600 dark:text-gray-300">
                        <li class="flex items-start">
                            <span class="text-indigo-600 mr-3 font-bold">•</span>
                            <span><strong>Registration:</strong> NEU/22/23/CSC/00086</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-indigo-600 mr-3 font-bold">•</span>
                            <span><strong>Type:</strong> Final Year Project</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-indigo-600 mr-3 font-bold">•</span>
                            <span><strong>Semester:</strong> November 2025</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-indigo-600 mr-3 font-bold">•</span>
                            <span><strong>Department:</strong> Computer Science</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg">
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">🎯 Learning Outcomes</h3>
                    <ul class="space-y-3 text-gray-600 dark:text-gray-300">
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3">✓</span>
                            <span>Database design and normalization</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3">✓</span>
                            <span>PHP backend with PDO and sessions</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3">✓</span>
                            <span>RESTful API design and implementation</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3">✓</span>
                            <span>Role-based access control</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3">✓</span>
                            <span>Frontend development with Tailwind CSS</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-8 bg-gradient-to-r from-indigo-600 to-purple-600 p-8 rounded-xl text-white shadow-lg">
                <div class="grid md:grid-cols-3 gap-6 text-center">
                    <div>
                        <p class="text-4xl font-bold mb-2">3</p>
                        <p class="text-lg">Role Types (Admin, Manager, Employee)</p>
                    </div>
                    <div>
                        <p class="text-4xl font-bold mb-2">5</p>
                        <p class="text-lg">Database Tables with Relations</p>
                    </div>
                    <div>
                        <p class="text-4xl font-bold mb-2">100%</p>
                        <p class="text-lg">Responsive Design (Mobile First)</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-white font-semibold mb-4">TaskFlow</h3>
                    <p class="text-sm">Employee Task Scheduling & Reporting System</p>
                    <p class="text-xs text-gray-500 mt-2">NEU/22/23/CSC/00086</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Navigation</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#problem" class="hover:text-white transition">The Problem</a></li>
                        <li><a href="#features" class="hover:text-white transition">Features</a></li>
                        <li><a href="#how-it-works" class="hover:text-white transition">How It Works</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">System</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="pages/auth/login.php" class="hover:text-white transition">Login</a></li>
                        <li><a href="pages/auth/register.php" class="hover:text-white transition">Register</a></li>
                        <li><a href="pages/dashboard/index.php" class="hover:text-white transition">Dashboard</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Documentation</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="docs/blueprint.md" class="hover:text-white transition">Project Blueprint</a></li>
                        <li><a href="https://github.com/KabriAcid/TaskManager" class="hover:text-white transition">GitHub Repository</a></li>
                        <li><a href="#" class="hover:text-white transition">Technical Specs</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm">
                <p>&copy; <?php echo date('Y'); ?> TaskFlow Academic Project. All rights reserved.</p>
                <p class="text-xs text-gray-500 mt-1">Computer Science Department | Final Year Project</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    // Close mobile menu if open
                    document.getElementById('mobile-menu').classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>