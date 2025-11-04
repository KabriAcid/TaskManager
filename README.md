# PHP Task Manager

A professional task management application built with PHP (PDO), MySQL, Tailwind CSS, and Vanilla JavaScript (AJAX). This is a conversion of the Next.js TaskManager application to vanilla PHP while maintaining the exact markup and functionality.

## 🚀 Features

- **Role-Based Dashboards**: Separate views for Admin, Manager, and Employee roles
- **Task Management**: Create, view, filter, and search tasks
- **Reports**: Daily, weekly, and monthly task summaries with charts
- **Responsive Design**: Mobile-friendly interface with Tailwind CSS
- **Real-time Filtering**: Client-side task filtering and search
- **User Switching**: Demo feature to switch between user roles

## 📁 Project Structure

```
php-task-manager/
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

## 🛠️ Setup Instructions

### Prerequisites

- XAMPP (or any PHP 7.4+ environment)
- Node.js and npm (for Tailwind CSS compilation)
- MySQL database

### Installation

1. **Install dependencies**

   ```bash
   cd php-task-manager
   npm install
   ```

2. **Compile Tailwind CSS**

   ```bash
   # For development (watch mode)
   npm run dev

   # For production (minified)
   npm run build
   ```

3. **Configure database**

   - Edit `includes/config/config.php`
   - Update database credentials:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_NAME', 'taskmanager');
     define('DB_USER', 'root');
     define('DB_PASS', '');
     ```

4. **Create database** (optional - currently using sample data)

   ```sql
   CREATE DATABASE taskmanager;
   ```

5. **Access the application**
   - Open: `http://localhost/TaskManager/php-task-manager/public/`
   - Auto-login as Admin (demo mode)

## 📝 Component Mapping (Next.js → PHP)

### Pages

- `src/app/page.tsx` → `pages/dashboard/index.php`
- `src/app/layout.tsx` → `components/layout/header.php` + `footer.php`
- `src/app/dashboard/reports/page.tsx` → `pages/reports/index.php`

### Components

- `src/components/layout/app-layout.tsx` → `components/layout/sidebar.php` + `navigation.php`
- `src/components/dashboard/admin-dashboard.tsx` → `pages/dashboard/admin.php`
- `src/components/dashboard/manager-dashboard.tsx` → `pages/dashboard/manager.php`
- `src/components/dashboard/employee-dashboard.tsx` → `pages/dashboard/employee.php`
- `src/components/dashboard/stat-card.tsx` → `components/dashboard/stat-card.php`
- `src/components/tasks/tasks-table.tsx` → `components/tasks/tasks-table.php`
- `src/components/reports/task-summary-chart.tsx` → `components/reports/task-summary-chart.php`

### Data & State

- `src/lib/data.ts` → `includes/database/db.php` (sample data functions)
- `src/contexts/auth-context.tsx` → `includes/auth/session.php` (PHP sessions)
- `src/hooks/use-auth.ts` → `api/auth/check.php` + session management

## 🎨 Styling

The application uses Tailwind CSS with a custom design system that matches the Next.js version:

- CSS Variables for theming (light/dark mode ready)
- Consistent color palette
- Responsive design with mobile-first approach
- Custom components matching shadcn/ui

## 🔐 Authentication

Currently using demo authentication with auto-login. Real authentication will be implemented in API endpoints:

- `api/auth/login.php`
- `api/auth/register.php`
- `api/auth/logout.php`
- `api/auth/check.php`

## 📊 Features Implemented

✅ **Core Layout**

- Responsive sidebar navigation
- Header with user dropdown
- Mobile-friendly design

✅ **Dashboard**

- Role-based dashboards (Admin, Manager, Employee)
- Statistics cards with icons
- Task tables with filtering

✅ **Tasks**

- Task list with filtering (priority, status)
- Search functionality
- Visual badges for priority and status
- Assignee avatars

✅ **Reports**

- Tabbed interface (Daily, Weekly, Monthly)
- Chart.js integration for task summaries
- Export placeholder (to be implemented)

✅ **Utilities**

- Toast notifications
- API helper functions
- Date formatting
- Debounce utility

## 🚧 To Be Implemented

The following features are planned:

- [ ] Database integration (currently using sample data)
- [ ] Real authentication system
- [ ] Task CRUD API endpoints
- [ ] Create task dialog/modal
- [ ] Task detail view
- [ ] User management
- [ ] File uploads
- [ ] PDF export functionality
- [ ] Email notifications

## 🎯 Key Differences from Next.js Version

1. **No Server Components**: All rendering is done server-side with PHP
2. **No React Hooks**: Replaced with vanilla JavaScript and PHP sessions
3. **No TypeScript**: Using standard PHP with type hints where applicable
4. **Chart Library**: Using Chart.js instead of Recharts
5. **Icons**: Using Lucide CDN instead of lucide-react package
6. **State Management**: PHP sessions instead of React Context API

## 📦 Dependencies

- **PHP**: 7.4+
- **Tailwind CSS**: 3.4+
- **Chart.js**: 4.x (CDN)
- **Lucide Icons**: Latest (CDN)

## 🤝 Contributing

This project is a conversion from Next.js to PHP. Feel free to contribute by:

1. Implementing remaining API endpoints
2. Adding database integration
3. Improving UI components
4. Adding new features

## 📄 License

ISC

---

**Note**: This application is currently in development and uses sample data for demonstration purposes. Database integration and full API functionality are being implemented.
