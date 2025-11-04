'use client';
import StatCard from './stat-card';
import { ClipboardCheck, Users, AlertTriangle, Clock } from 'lucide-react';
import TasksTable from '../tasks/tasks-table';
import { useAuth } from '@/hooks/use-auth';
import { TASKS } from '@/lib/data';
import { useMemo } from 'react';

export default function AdminDashboard() {
  const { user } = useAuth();
  
  const stats = useMemo(() => {
    const totalTasks = TASKS.length;
    const completedTasks = TASKS.filter(t => t.status === 'Done').length;
    const urgentTasks = TASKS.filter(t => t.priority === 'Urgent').length;
    const inProgressTasks = TASKS.filter(t => t.status === 'In Progress').length;
    return { totalTasks, completedTasks, urgentTasks, inProgressTasks };
  }, []);

  if (!user) return null;

  return (
    <div className="space-y-6">
      <div className='space-y-2'>
        <h2 className="text-3xl font-bold tracking-tight font-headline">
          Welcome, Admin {user.name.split(' ')[0]}!
        </h2>
        <p className="text-muted-foreground">Here's the full overview of your organization's activities.</p>
      </div>

      <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
        <StatCard title="Total Tasks" value={stats.totalTasks} icon={ClipboardCheck} description={`${stats.completedTasks} completed`} />
        <StatCard title="Active Users" value={5} icon={Users} description="Across 3 departments" />
        <StatCard title="Urgent Tasks" value={stats.urgentTasks} icon={AlertTriangle} description="Require immediate attention" />
        <StatCard title="In Progress" value={stats.inProgressTasks} icon={Clock} description="Currently being worked on" />
      </div>

      <div>
        <TasksTable tasks={TASKS} title="All Tasks" />
      </div>
    </div>
  );
}
