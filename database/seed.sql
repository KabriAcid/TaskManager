-- Seed data for TaskManager

-- Insert Users
INSERT INTO `users` (`id`, `name`, `email`, `password`, `avatar`, `role`) VALUES
(1, 'Admin User', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'https://picsum.photos/seed/1/100/100', 'Admin'),
(2, 'Manager Mike', 'manager@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'https://picsum.photos/seed/2/100/100', 'Manager'),
(3, 'Employee Emma', 'employee@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'https://picsum.photos/seed/3/100/100', 'Employee'),
(4, 'Developer Dave', 'dave@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'https://picsum.photos/seed/4/100/100', 'Employee'),
(5, 'Designer Diana', 'diana@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'https://picsum.photos/seed/5/100/100', 'Employee');

-- Note: All passwords are hashed version of "password"

-- Insert Tasks
INSERT INTO `tasks` (`id`, `title`, `description`, `status`, `priority`, `assignee_id`, `assigner_id`, `deadline`, `tags`, `recurrence`, `created_at`) VALUES
('TASK-1', 'Design the new dashboard layout', 'Create mockups and prototypes for the new dashboard design, focusing on user experience.', 'In Progress', 'High', 5, 2, DATE_ADD(CURDATE(), INTERVAL 7 DAY), 'design,ui,ux', 'None', DATE_SUB(NOW(), INTERVAL 2 DAY)),
('TASK-2', 'Develop the authentication feature', 'Implement JWT-based authentication for the application.', 'To Do', 'Urgent', 4, 2, DATE_ADD(CURDATE(), INTERVAL 5 DAY), 'development,backend,security', 'None', DATE_SUB(NOW(), INTERVAL 1 DAY)),
('TASK-3', 'Write API documentation', 'Document all the public API endpoints using Swagger/OpenAPI.', 'To Do', 'Medium', 3, 2, DATE_ADD(CURDATE(), INTERVAL 14 DAY), 'documentation,api', 'None', NOW()),
('TASK-4', 'Review quarterly budget', 'Analyze the quarterly spending and prepare a report for the board meeting.', 'Done', 'High', 2, 1, DATE_SUB(CURDATE(), INTERVAL 3 DAY), 'finance,report', 'None', DATE_SUB(NOW(), INTERVAL 10 DAY)),
('TASK-5', 'Fix login page CSS bug', 'The login button is misaligned on mobile devices. This needs to be fixed.', 'In Progress', 'Medium', 4, 2, DATE_ADD(CURDATE(), INTERVAL 1 DAY), 'bug,css,frontend', 'None', DATE_SUB(NOW(), INTERVAL 1 DAY)),
('TASK-6', 'Plan the next marketing campaign', 'Brainstorm ideas for the upcoming Q3 marketing campaign.', 'To Do', 'Low', 3, 2, DATE_ADD(CURDATE(), INTERVAL 30 DAY), 'marketing,planning', 'None', NOW()),
('TASK-7', 'User testing for the new feature', 'Conduct user testing sessions with a focus group to get feedback on the new reporting feature.', 'To Do', 'High', 5, 2, DATE_ADD(CURDATE(), INTERVAL 10 DAY), 'testing,ux', 'None', DATE_SUB(NOW(), INTERVAL 3 DAY)),
('TASK-8', 'Deploy server updates', 'Deploy the latest security patches and updates to the production server.', 'Cancelled', 'Urgent', 4, 1, DATE_SUB(CURDATE(), INTERVAL 1 DAY), 'deployment,server', 'None', DATE_SUB(NOW(), INTERVAL 2 DAY)),
('TASK-9', 'Weekly team sync meeting', 'Regular weekly sync to discuss progress and blockers.', 'Done', 'Medium', 2, 2, DATE_SUB(CURDATE(), INTERVAL 4 DAY), NULL, 'Weekly', DATE_SUB(NOW(), INTERVAL 4 DAY)),
('TASK-10', 'Onboard new employee', 'Prepare onboarding materials and schedule introduction meetings for the new hire.', 'To Do', 'High', 2, 2, DATE_ADD(CURDATE(), INTERVAL 3 DAY), 'hr,onboarding', 'None', NOW());

