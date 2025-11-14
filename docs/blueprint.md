# Design and Implementation of Employee Task Scheduling and Reporting Information System

**Academic Project** | Computer Science Department | NEU/22/23/CSC/00086

A professional task management and reporting system application built with PHP (PDO), MySQL, Tailwind CSS, and Vanilla JavaScript (AJAX). This system automates the process of assigning, tracking, and reporting employee tasks within an organization, improving efficiency, accountability, and communication between supervisors and staff.

## 📋 Project Overview

### Primary Goal

To automate the process of assigning, tracking, and reporting employee tasks within an organization, improving efficiency, accountability, and communication between supervisors and staff.

### Problem Statement

The manual task assignment and reporting process involves:

- Supervisors assigning tasks through verbal instructions or paper-based records
- Employees recording tasks in personal notebooks
- Manual submission of completion reports on paper
- Supervisors updating log books manually

### Pain Points Addressed

- ❌ Manual assignment and tracking lead to delays and confusion
- ❌ Paper records can be misplaced or damaged
- ❌ Lack of transparency - supervisors cannot monitor progress in real-time
- ❌ Error-prone data entry and reporting reduce accuracy
- ❌ Difficult to generate summaries or performance statistics manually
- ❌ No automatic notifications or reminders for pending tasks

### Solution Features

- ✅ **Role-Based Dashboards**: Separate views for Admin, Manager, and Employee roles
- ✅ **Task Management**: Create, view, filter, and search tasks
- ✅ **Reports**: Daily, weekly, and monthly task summaries with charts
- ✅ **Real-time Tracking**: Live task status updates and progress monitoring
- ✅ **Responsive Design**: Mobile-friendly interface with Tailwind CSS
- ✅ **Digital Records**: Secure database storage replacing paper-based systems

## � Key Stakeholders

| Actor                          | Role                         | Responsibilities                                                                |
| ------------------------------ | ---------------------------- | ------------------------------------------------------------------------------- |
| **Supervisor / Manager**       | Task Assignment & Monitoring | Assigns tasks to employees, monitors progress, and collects reports             |
| **Employee / Staff Member**    | Task Execution               | Receives tasks, performs them, and submits completion reports                   |
| **Human Resources Department** | Compliance & Oversight       | Ensures compliance with organizational policies and tracks overall productivity |
| **Administrator / IT Officer** | System Management            | Maintains the system and manages user accounts and data integrity               |

## 📊 Data Entities

### Employee

**Attributes:**

- Employee ID
- Full Name
- Department
- Designation
- Contact Information
- Email Address
- Role (Admin/Manager/Employee)

**Current Storage:** Physical employee files or Excel spreadsheets  
**Proposed Storage:** MySQL database with secure authentication

### Task

**Attributes:**

- Task ID
- Title
- Description
- Assigned Employee (Foreign Key)
- Assigner/Supervisor (Foreign Key)
- Start Date
- Due Date
- Status (To Do, In Progress, Done, Cancelled)
- Priority (Low, Medium, High, Urgent)
- Completion Report
- Created At
- Updated At

**Current Storage:** Paper task register or manual assignment forms  
**Proposed Storage:** MySQL database with relational integrity

## 🔄 Process Flow

### Manual Process (Before Automation)

1. **Supervisor** writes task details on paper or gives verbal instructions
2. **Employee** records task in personal notebook
3. **Employee** performs the task
4. **Employee** submits completion report on paper
5. **Supervisor** updates log book manually and prepares summary

### Automated Process (After Implementation)

1. **Supervisor** creates task through web interface with all details
2. **System** automatically notifies employee via dashboard
3. **Employee** views task details, updates status in real-time
4. **Employee** submits digital completion report
5. **System** automatically updates records and generates reports

## 🎯 Project Scope

### In Scope

- Web-based task assignment interface
- Role-based access control (Admin, Manager, Employee)
- Real-time task tracking and status updates
- Digital task completion reporting
- Automated report generation (daily, weekly, monthly)
- Dashboard with statistics and visualizations
- Search and filter functionality
- User account management
- Task history and audit trail

### Out of Scope

- Employee recruitment processes
- Payroll management
- Annual performance appraisal systems
- Leave management
- Attendance tracking
- Asset management

## �📁 Project Structure

```
TaskManager/
├── public/              # Public-facing files
│   ├── index.php       # Main entry point
│   ├── css/            # Tailwind CSS files
│   ├── js/             # JavaScript files
│   └── assets/         # Images and static files
├── pages/              # Main application pages
│   ├── auth/           # Login, register, logout
│   ├── dashboard/      # Dashboard pages
│   ├── tasks/          # Task management
│   └── reports/        # Reports
├── components/         # Reusable PHP components
│   ├── layout/         # Header, footer, sidebar, navigation
│   ├── dashboard/      # Dashboard components
│   ├── tasks/          # Task components
│   ├── reports/        # Report components
│   └── ui/             # UI components
├── api/                # AJAX API endpoints
│   ├── auth/           # Authentication
│   ├── tasks/          # Task CRUD
│   ├── projects/       # Projects
│   └── reports/        # Reports
├── includes/           # Backend logic
│   ├── config/         # Configuration
│   ├── auth/           # Session management
│   └── database/       # Database connection
├── database/           # SQL files
└── storage/            # Logs and uploads
```

## 🛠️ Technology Stack

### Backend

- **PHP 7.4+**: Server-side scripting
- **PDO (PHP Data Objects)**: Database abstraction layer
- **MySQL 8.0+**: Relational database management

### Frontend

- **HTML5**: Semantic markup
- **Tailwind CSS 3.4+**: Utility-first CSS framework via CDN
- **Vanilla JavaScript**: Client-side interactivity with AJAX
- **Chart.js 4.x**: Data visualization for reports

### Development Environment

- **XAMPP**: Local development server (Apache + MySQL + PHP)
- **Git**: Version control
- **VS Code**: Code editor

### Design System

- **Color Palette**: Indigo-600 primary, Purple-600 secondary
- **Components**: Custom PHP components with gradient designs
- **Icons**: Inline SVG icons for better performance
- **Responsive**: Mobile-first approach with breakpoints

## 🛠️ Setup Instructions

### Prerequisites

- **XAMPP** (or any PHP 7.4+ environment with Apache and MySQL)
- **MySQL 8.0+** database server
- **Modern Web Browser** (Chrome, Firefox, Edge)
- **Git** for version control

### Installation Steps

1. **Clone the repository**

   ```bash
   cd c:\xampp\htdocs
   git clone <repository-url> TaskManager
   cd TaskManager
   ```

2. **Configure Database**

   - Start XAMPP (Apache and MySQL)
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create a new database named `task_manager`
   - Import `database/schema.sql` to create tables
   - Import `database/seed.sql` for sample data

3. **Configure Environment**

   - Copy `.env.example` to `.env`
   - Update database credentials:
     ```
     DB_HOST=localhost
     DB_NAME=task_manager
     DB_USER=root
     DB_PASS=
     APP_URL=http://localhost/TaskManager
     APP_ENV=development
     ```

4. **Access Application**
   - Navigate to: `http://localhost/TaskManager`
   - Default login credentials:
     - Admin: admin@taskflow.com / password
     - Manager: manager@taskflow.com / password
     - Employee: employee@taskflow.com / password

## 🗄️ Database Schema

### Tables

**users**

- id (PRIMARY KEY)
- name
- email (UNIQUE)
- password_hash
- role (ENUM: 'Admin', 'Manager', 'Employee')
- department
- designation
- avatar
- created_at
- updated_at

**tasks**

- id (PRIMARY KEY)
- title
- description
- assignee_id (FOREIGN KEY → users.id)
- assigner_id (FOREIGN KEY → users.id)
- project_id (FOREIGN KEY → projects.id, nullable)
- status (ENUM: 'To Do', 'In Progress', 'Done', 'Cancelled')
- priority (ENUM: 'Low', 'Medium', 'High', 'Urgent')
- start_date
- deadline
- completed_at (nullable)
- created_at
- updated_at

**projects** (Optional)

- id (PRIMARY KEY)
- name
- description
- created_by (FOREIGN KEY → users.id)
- created_at
- updated_at

**task_reports**

- id (PRIMARY KEY)
- task_id (FOREIGN KEY → tasks.id)
- employee_id (FOREIGN KEY → users.id)
- report_text
- submitted_at
- created_at

## 🎨 Design System

### Color Palette

- **Primary**: Indigo-600 (#4f46e5)
- **Secondary**: Purple-600 (#9333ea)
- **Success**: Green-500 (#10b981)
- **Warning**: Yellow-500 (#f59e0b)
- **Error**: Red-500 (#ef4444)
- **Info**: Blue-500 (#3b82f6)

### Gradients

- Purple to Indigo: `from-purple-500 to-indigo-600`
- Indigo to Purple: `from-indigo-500 to-purple-600`
- Blue to Indigo: `from-blue-500 to-indigo-600`
- Pink to Purple: `from-pink-500 to-purple-600`

### Typography

- **Headings**: Font-bold, tracking-tight
- **Body**: Text-gray-700 dark:text-gray-300
- **Muted**: Text-gray-600 dark:text-gray-400

### Components

- **Cards**: Rounded-xl with shadow-lg
- **Buttons**: Gradient backgrounds with hover effects
- **Inputs**: Rounded-lg with indigo-500 focus ring
- **Badges**: Rounded-full with color-coded backgrounds

## 📋 System Architecture

### Frontend Layer

- **Pages**: PHP files that render complete HTML pages
- **Components**: Reusable PHP functions that generate HTML
- **JavaScript**: AJAX calls for async operations
- **Styles**: Tailwind CSS via CDN with custom configuration

### Backend Layer

- **API Endpoints**: RESTful endpoints for CRUD operations
- **Session Management**: PHP sessions for authentication
- **Database Layer**: PDO for secure database interactions
- **Business Logic**: Procedural PHP functions

### Data Flow

```
User → Browser → PHP Page → Session Check → Database Query → Render HTML → Browser
User → JavaScript → AJAX → API Endpoint → Database → JSON Response → Update UI
```

## 🔐 Security Features

- **Password Hashing**: Using `password_hash()` with bcrypt
- **SQL Injection Prevention**: PDO prepared statements
- **XSS Protection**: `htmlspecialchars()` on all output
- **CSRF Protection**: Token validation for forms
- **Session Security**: Secure session configuration
- **Role-Based Access Control**: Middleware for authorization

## 🎓 Academic Project Information

**Institution**: Computer Science Department  
**Registration**: NEU/22/23/CSC/00086  
**Project Type**: Final Year Project  
**Date**: November 2025

### Project Objectives

1. Understand the limitations of manual task management systems
2. Design a comprehensive database schema for task management
3. Implement a web-based solution using modern technologies
4. Create role-based dashboards for different user types
5. Develop reporting capabilities for performance tracking
6. Demonstrate practical application of software engineering principles

### Learning Outcomes

- Database design and normalization
- PHP backend development with PDO
- Frontend development with Tailwind CSS
- RESTful API design and implementation
- User authentication and authorization
- Project management and documentation

### Application Pages

- Landing Page: `index.php` (Marketing/Hero page)
- Dashboard Router: `pages/dashboard/index.php` (Role-based routing)
- Admin View: `pages/dashboard/admin.php`
- Manager View: `pages/dashboard/manager.php`
- Employee View: `pages/dashboard/employee.php`
- Reports: `pages/reports/index.php`
- Authentication: `pages/auth/login.php`, `register.php`, `logout.php`

### Components

**Layout Components**

- `components/layout/header.php` - HTML head with Tailwind CDN
- `components/layout/footer.php` - Scripts and toast container
- `components/layout/sidebar.php` - Navigation sidebar with gradient header
- `components/layout/navigation.php` - Top navigation bar with user menu

**Dashboard Components**

- `components/dashboard/stat-card.php` - Statistics cards with gradients
- `components/dashboard/user-nav.php` - User dropdown with account switching

**Task Components**

- `components/tasks/tasks-table.php` - Task table with filtering
- `components/tasks/create-task-dialog.php` - Modal for creating tasks
- `components/tasks/task-filters.php` - Filter controls

**Report Components**

- `components/reports/task-summary-chart.php` - Chart.js visualization

**UI Components**

- `components/ui/alert.php` - Alert messages
- `components/ui/badge.php` - Status/priority badges
- `components/ui/button.php` - Reusable button component
- `components/ui/card.php` - Card container
- `components/ui/dialog.php` - Modal dialog
- `components/ui/table.php` - Table component
- `components/ui/toast.php` - Toast notification

### API Endpoints

**Authentication**

- `POST /api/auth/login.php` - User login
- `POST /api/auth/register.php` - User registration
- `POST /api/auth/logout.php` - User logout
- `GET /api/auth/check.php` - Session validation
- `POST /api/auth/switch-user.php` - Switch between accounts (demo)

**Tasks**

- `GET /api/tasks/list.php` - Get all tasks
- `GET /api/tasks/get.php?id={id}` - Get single task
- `POST /api/tasks/create.php` - Create new task
- `PUT /api/tasks/update.php` - Update task
- `DELETE /api/tasks/delete.php?id={id}` - Delete task

**Reports**

- `GET /api/reports/stats.php` - Get statistics
- `POST /api/reports/generate.php` - Generate report

**Projects**

- `GET /api/projects/list.php` - Get all projects
- `POST /api/projects/create.php` - Create new project

### Backend Logic

**Configuration**

- `includes/config/config.php` - Application configuration and constants
- `includes/config/database.php` - Database connection setup

**Authentication**

- `includes/auth/session.php` - Session management functions
- `includes/auth/functions.php` - Login, register, authentication helpers

**Database**

- `includes/database/db.php` - Database query functions and sample data
- `includes/database/queries.php` - Prepared statement helpers

## 📊 Implementation Progress

### ✅ Completed Features

**Core Infrastructure**

- Landing page with hero, features, and testimonials
- Responsive layout with sidebar and navigation
- Session-based authentication system
- Role-based access control
- Indigo/purple design system with gradients

**Dashboard Views**

- Admin dashboard (all organizational tasks)
- Manager dashboard (team-specific tasks)
- Employee dashboard (personal tasks)
- Statistics cards with color-coded gradients
- Real-time filtering and search

**Task Management**

- Task table with priority/status filtering
- Search functionality
- Color-coded badges
- Assignee avatars
- Deadline display

**Reports System**

- Daily, weekly, monthly summaries
- Tabbed interface
- Chart.js visualizations
- Export placeholder

### 🚧 Pending Implementation

- [ ] Connect to MySQL database
- [ ] Implement PDO queries for all CRUD operations
- [ ] Replace sample data with real database queries
- [ ] Add database connection error handling
- [ ] Implement transaction support for complex operations
- [ ] Add database migration system

### Phase 7: Task CRUD Operations (Priority: High)

- [ ] Create Task API endpoint (`/api/tasks/create.php`)
  - Validate input data
  - Insert task into database
  - Send notification to assignee
- [ ] Update Task API endpoint (`/api/tasks/update.php`)
  - Update task status, priority, deadline
  - Track change history
- [ ] Delete Task API endpoint (`/api/tasks/delete.php`)
  - Soft delete with archived status
- [ ] Task Detail View (`/pages/tasks/view.php`)
  - Full task information
  - Edit capability
  - Comments section
  - File attachments

### Phase 8: Real Authentication (Priority: High)

- [ ] Login page with form validation
- [ ] Registration page with password strength checker
- [ ] Password reset functionality
- [ ] Email verification
- [ ] Remember me functionality
- [ ] Session timeout handling
- [ ] Logout confirmation

### Phase 9: User Management (Priority: Medium)

- [ ] Admin user management interface
- [ ] Create/Edit/Delete users
- [ ] Assign roles and departments
- [ ] User profile page
- [ ] Avatar upload
- [ ] Change password functionality
- [ ] Account settings

### Phase 10: Advanced Task Features (Priority: Medium)

- [ ] Create Task Dialog with rich form
  - Title, description fields
  - Assignee selection dropdown
  - Priority and status selection
  - Date pickers for start/deadline
  - Project assignment (optional)
- [ ] Task assignments notifications
- [ ] Task comments/notes system
- [ ] File attachments for tasks
- [ ] Task history/audit trail
- [ ] Task dependencies
      **Advanced Features (Priority: Medium)**
- Create task dialog with rich form
- Task notifications system
- PDF/Excel export functionality
- Calendar and Kanban views

## 🎯 Development Timeline

### Week 1-2: Foundation ✅

Project structure, landing page, layouts, authentication structure, design system

### Week 3-4: Core Features ✅

Dashboard views, task tables, reports, UI components, sample data

### Week 5-6: Backend Integration 🔄

Database schema, API endpoints, authentication, CRUD operations

### Week 7-8: Advanced Features 📅

Task creation, user management, file uploads, notifications

### Week 9-10: Testing & Polish 📅

Unit testing, bug fixes, performance optimization, security audit

### Week 11-12: Documentation & Deployment 📅

User documentation, deployment guide, training materials, final presentation

## 📈 Success Metrics

**Technical**

- Page load < 2s, Query time < 100ms, Zero SQL injection, 100% mobile responsive

**User Impact**

- 80% reduction in task assignment time
- 100% digital records (eliminate paper)
- Real-time task visibility
- 90% reduction in lost records
- Automated report generation

**Business Value**

- Improved task completion rate
- Better accountability and transparency
- Enhanced communication
- Reduced administrative overhead

## 🎯 Manual vs Automated System

| Aspect          | Manual              | Automated           |
| --------------- | ------------------- | ------------------- |
| Task Assignment | Paper/verbal        | Web interface       |
| Records         | Physical files      | MySQL database      |
| Progress        | No visibility       | Live dashboard      |
| Reports         | Manual (hours/days) | Automated (seconds) |
| Search          | Manual filing       | Instant search      |
| Access          | Physical presence   | Remote browser      |
| Security        | Can be lost         | Encrypted database  |

## 🤝 Contributing

This academic project welcomes contributions:

- Database integration with PDO queries
- RESTful API development
- UI/UX enhancements
- Testing and bug fixes
- Documentation improvements

**Guidelines**: Follow existing code structure, procedural PHP (no OOP), test thoroughly, update documentation

---

## � Project Information

**Student**: Computer Science Department  
**Registration**: NEU/22/23/CSC/00086  
**Project**: Final Year (2025)  
**Status**: Active Development (Frontend 95%, Backend 30%)

**Current Focus**: Database integration and API implementation

**Last Updated**: November 5, 2025 | **Version**: 1.0.0-beta
