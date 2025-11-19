<?php
require_once __DIR__ . '/../config/database.php';

function getDB()
{
    return getDbConnection();
}

function getTasksWithUsers()
{
    $pdo = getDbConnection();
    $stmt = $pdo->query("
        SELECT 
            t.*, 
            assignee.name as assignee_name, assignee.avatar as assignee_avatar,
            assigner.name as assigner_name,
            assigner.id as assigner_id
        FROM tasks t
        JOIN users assignee ON t.assignee_id = assignee.id
        JOIN users assigner ON t.assigner_id = assigner.id
        ORDER BY t.created_at DESC
    ");
    $tasksData = $stmt->fetchAll();

    $tasks = [];
    foreach ($tasksData as $row) {
        $tasks[] = [
            'id' => $row['id'],
            'title' => $row['title'],
            'description' => $row['description'],
            'status' => $row['status'],
            'priority' => $row['priority'],
            'deadline' => $row['deadline'],
            'created_at' => $row['created_at'],
            'assigner' => [
                'id' => $row['assigner_id'],
                'name' => $row['assigner_name']
            ],
            'assignee' => [
                'id' => $row['assignee_id'],
                'name' => $row['assignee_name'],
                'avatar' => $row['assignee_avatar']
            ]
        ];
    }
    return $tasks;
}
