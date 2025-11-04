<?php
require_once __DIR__ . '/../config/database.php';

function getDB()
{
    return Database::getInstance()->getConnection();
}

// Sample data functions (will be replaced with actual DB queries)
function getAllUsers()
{
    return [
        ['id' => '1', 'name' => 'Admin User', 'email' => 'admin@example.com', 'avatar' => 'https://picsum.photos/seed/1/100/100', 'role' => 'Admin'],
        ['id' => '2', 'name' => 'Manager Mike', 'email' => 'manager@example.com', 'avatar' => 'https://picsum.photos/seed/2/100/100', 'role' => 'Manager'],
        ['id' => '3', 'name' => 'Employee Emma', 'email' => 'employee@example.com', 'avatar' => 'https://picsum.photos/seed/3/100/100', 'role' => 'Employee'],
        ['id' => '4', 'name' => 'Developer Dave', 'email' => 'dave@example.com', 'avatar' => 'https://picsum.photos/seed/4/100/100', 'role' => 'Employee'],
        ['id' => '5', 'name' => 'Designer Diana', 'email' => 'diana@example.com', 'avatar' => 'https://picsum.photos/seed/5/100/100', 'role' => 'Employee'],
    ];
}

function getAllTasks()
{
    return [
        [
            'id' => 'TASK-1',
            'title' => 'Design the new dashboard layout',
            'description' => 'Create mockups and prototypes for the new dashboard design, focusing on user experience.',
            'status' => 'In Progress',
            'priority' => 'High',
            'deadline' => date('Y-m-d', strtotime('+7 days')),
            'created_at' => date('Y-m-d', strtotime('-2 days')),
            'assigner_id' => '2',
            'assignee_id' => '5',
            'tags' => 'design,ui,ux',
            'recurrence' => 'None'
        ],
        [
            'id' => 'TASK-2',
            'title' => 'Develop the authentication feature',
            'description' => 'Implement JWT-based authentication for the application.',
            'status' => 'To Do',
            'priority' => 'Urgent',
            'deadline' => date('Y-m-d', strtotime('+5 days')),
            'created_at' => date('Y-m-d', strtotime('-1 days')),
            'assigner_id' => '2',
            'assignee_id' => '4',
            'tags' => 'development,backend,security',
            'recurrence' => 'None'
        ],
        [
            'id' => 'TASK-3',
            'title' => 'Write API documentation',
            'description' => 'Document all the public API endpoints using Swagger/OpenAPI.',
            'status' => 'To Do',
            'priority' => 'Medium',
            'deadline' => date('Y-m-d', strtotime('+14 days')),
            'created_at' => date('Y-m-d'),
            'assigner_id' => '2',
            'assignee_id' => '3',
            'tags' => 'documentation,api',
            'recurrence' => 'None'
        ],
        [
            'id' => 'TASK-4',
            'title' => 'Review quarterly budget',
            'description' => 'Analyze the quarterly spending and prepare a report for the board meeting.',
            'status' => 'Done',
            'priority' => 'High',
            'deadline' => date('Y-m-d', strtotime('-3 days')),
            'created_at' => date('Y-m-d', strtotime('-10 days')),
            'assigner_id' => '1',
            'assignee_id' => '2',
            'tags' => 'finance,report',
            'recurrence' => 'None'
        ],
        [
            'id' => 'TASK-5',
            'title' => 'Fix login page CSS bug',
            'description' => 'The login button is misaligned on mobile devices. This needs to be fixed.',
            'status' => 'In Progress',
            'priority' => 'Medium',
            'deadline' => date('Y-m-d', strtotime('+1 days')),
            'created_at' => date('Y-m-d', strtotime('-1 days')),
            'assigner_id' => '2',
            'assignee_id' => '4',
            'tags' => 'bug,css,frontend',
            'recurrence' => 'None'
        ],
        [
            'id' => 'TASK-6',
            'title' => 'Plan the next marketing campaign',
            'description' => 'Brainstorm ideas for the upcoming Q3 marketing campaign.',
            'status' => 'To Do',
            'priority' => 'Low',
            'deadline' => date('Y-m-d', strtotime('+30 days')),
            'created_at' => date('Y-m-d'),
            'assigner_id' => '2',
            'assignee_id' => '3',
            'tags' => 'marketing,planning',
            'recurrence' => 'None'
        ],
        [
            'id' => 'TASK-7',
            'title' => 'User testing for the new feature',
            'description' => 'Conduct user testing sessions with a focus group to get feedback on the new reporting feature.',
            'status' => 'To Do',
            'priority' => 'High',
            'deadline' => date('Y-m-d', strtotime('+10 days')),
            'created_at' => date('Y-m-d', strtotime('-3 days')),
            'assigner_id' => '2',
            'assignee_id' => '5',
            'tags' => 'testing,ux',
            'recurrence' => 'None'
        ],
        [
            'id' => 'TASK-8',
            'title' => 'Deploy server updates',
            'description' => 'Deploy the latest security patches and updates to the production server.',
            'status' => 'Cancelled',
            'priority' => 'Urgent',
            'deadline' => date('Y-m-d', strtotime('-1 days')),
            'created_at' => date('Y-m-d', strtotime('-2 days')),
            'assigner_id' => '1',
            'assignee_id' => '4',
            'tags' => 'deployment,server',
            'recurrence' => 'None'
        ],
        [
            'id' => 'TASK-9',
            'title' => 'Weekly team sync meeting',
            'description' => 'Regular weekly sync to discuss progress and blockers.',
            'status' => 'Done',
            'priority' => 'Medium',
            'deadline' => date('Y-m-d', strtotime('-4 days')),
            'created_at' => date('Y-m-d', strtotime('-4 days')),
            'assigner_id' => '2',
            'assignee_id' => '2',
            'tags' => '',
            'recurrence' => 'Weekly'
        ],
        [
            'id' => 'TASK-10',
            'title' => 'Onboard new employee',
            'description' => 'Prepare onboarding materials and schedule introduction meetings for the new hire.',
            'status' => 'To Do',
            'priority' => 'High',
            'deadline' => date('Y-m-d', strtotime('+3 days')),
            'created_at' => date('Y-m-d'),
            'assigner_id' => '2',
            'assignee_id' => '2',
            'tags' => 'hr,onboarding',
            'recurrence' => 'None'
        ],
    ];
}

function getTasksWithUsers()
{
    $tasks = getAllTasks();
    $users = getAllUsers();
    $usersById = array_column($users, null, 'id');

    foreach ($tasks as &$task) {
        $task['assigner'] = $usersById[$task['assigner_id']] ?? null;
        $task['assignee'] = $usersById[$task['assignee_id']] ?? null;
    }

    return $tasks;
}

function getUserById($userId)
{
    $users = getAllUsers();
    foreach ($users as $user) {
        if ($user['id'] === $userId) {
            return $user;
        }
    }
    return null;
}
