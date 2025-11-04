'use client';
import StatCard from './stat-card';
import { ClipboardCheck, Users, AlertTriangle, Clock } from 'lucide-react';
import TasksTable from '../tasks/tasks-table';
import { useAuth } from '@/hooks/use-auth';
import { TASKS } from '@/lib/data';
import { useMemo } from 'react';

export default function ManagerDashboard() {
  const { user } = useAuth();

  const managedTasks = useMemo(() => {
    if (!user) return [];
    return TASKS.filter(task => task.assigner.id === user.id || task.assignee.role !== 'Admin');
  }, [user]);

  const stats = useMemo(() => {
    const totalTasks = managedTasks.length;
    const completedTasks = managedTasks.filter(t => t.status === 'Done').length;
    const overdueTasks = managedTasks.filter(t => t.deadline < new Date() && t.status !== 'Done').length;
    const inProgressTasks = managedTasks.filter(t => t.status === 'In Progress').length;
    return { totalTasks, completedTasks, overdueTasks, inProgressTasks };
  }, [managedTasks]);
  
  if (!user) return null;

  return (
    <div className="space-y-6">
       <div className='space-y-2'>
        <h2 className="text-3xl font-bold tracking-tight font-headline">
          Hello, {user.name}!
        </h2>
        <p className="text-muted-foreground">Here is an overview of your team's tasks and performance.</p>
      </div>

      <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
        <StatCard title="Team Tasks" value={stats.totalTasks} icon={ClipboardCheck} description={`${stats.completedTasks} completed`} />
        <StatCard title="Team Members" value={3} icon={Users} description="Active on projects" />
        <StatCard title="Overdue Tasks" value={stats.overdueTasks} icon={AlertTriangle} description="Need follow-up" />
        <StatCard title="In Progress" value={stats.inProgressTasks} icon={Clock} description="Actively being worked on" />
      </div>

      <div>
        <TasksTable tasks={managedTasks} title="Team's Tasks" />
      </div>
    </div>
  );
}
