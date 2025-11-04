'use client';
import StatCard from './stat-card';
import { ClipboardCheck, CheckCircle, AlertTriangle, Clock } from 'lucide-react';
import TasksTable from '../tasks/tasks-table';
import { useAuth } from '@/hooks/use-auth';
import { TASKS } from '@/lib/data';
import { useMemo } from 'react';

export default function EmployeeDashboard() {
  const { user } = useAuth();

  const assignedTasks = useMemo(() => {
    if (!user) return [];
    return TASKS.filter(task => task.assignee.id === user.id);
  }, [user]);

  const stats = useMemo(() => {
    const totalTasks = assignedTasks.length;
    const completedTasks = assignedTasks.filter(t => t.status === 'Done').length;
    const overdueTasks = assignedTasks.filter(t => t.deadline < new Date() && t.status !== 'Done').length;
    const inProgressTasks = assignedTasks.filter(t => t.status === 'In Progress').length;
    return { totalTasks, completedTasks, overdueTasks, inProgressTasks };
  }, [assignedTasks]);

  if (!user) return null;

  return (
    <div className="space-y-6">
       <div className='space-y-2'>
        <h2 className="text-3xl font-bold tracking-tight font-headline">
          Welcome back, {user.name.split(' ')[0]}!
        </h2>
        <p className="text-muted-foreground">Here are your assigned tasks and current workload.</p>
      </div>

      <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
        <StatCard title="My Total Tasks" value={stats.totalTasks} icon={ClipboardCheck} description="All tasks assigned to you" />
        <StatCard title="Completed" value={stats.completedTasks} icon={CheckCircle} description="Tasks you've finished" />
        <StatCard title="Overdue" value={stats.overdueTasks} icon={AlertTriangle} description="Require your urgent attention" />
        <StatCard title="In Progress" value={stats.inProgressTasks} icon={Clock} description="What you are working on" />
      </div>

      <div>
        <TasksTable tasks={assignedTasks} title="My Tasks" />
      </div>
    </div>
  );
}
