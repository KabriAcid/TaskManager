'use client';

import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
import { Button } from '@/components/ui/button';
import { Download } from 'lucide-react';
import TaskSummaryChart from '@/components/reports/task-summary-chart';
import { TASKS } from '@/lib/data';
import { useMemo } from 'react';
import { subDays } from 'date-fns';

export default function ReportsPage() {
    
  const dailyTasks = useMemo(() => TASKS.filter(t => t.createdAt > subDays(new Date(), 1)), []);
  const weeklyTasks = useMemo(() => TASKS.filter(t => t.createdAt > subDays(new Date(), 7)), []);
  const monthlyTasks = useMemo(() => TASKS.filter(t => t.createdAt > subDays(new Date(), 30)), []);

  return (
    <div className="flex-1 space-y-4">
      <div className="flex items-center justify-between space-y-2">
        <div>
            <h2 className="text-3xl font-bold tracking-tight font-headline">Reports</h2>
            <p className="text-muted-foreground">
            View summaries of task activity and performance.
            </p>
        </div>
        <div className="flex items-center space-x-2">
            <Button disabled>
                <Download className="mr-2 h-4 w-4" />
                Export to PDF
            </Button>
        </div>
      </div>
      <Tabs defaultValue="weekly" className="space-y-4">
        <TabsList>
          <TabsTrigger value="daily">Daily</TabsTrigger>
          <TabsTrigger value="weekly">Weekly</TabsTrigger>
          <TabsTrigger value="monthly">Monthly</TabsTrigger>
        </TabsList>
        <TabsContent value="daily" className="space-y-4">
            <Card>
                <CardHeader>
                    <CardTitle>Daily Summary</CardTitle>
                    <CardDescription>Task summary for the last 24 hours.</CardDescription>
                </CardHeader>
                <CardContent>
                    <TaskSummaryChart tasks={dailyTasks} />
                </CardContent>
            </Card>
        </TabsContent>
        <TabsContent value="weekly" className="space-y-4">
            <Card>
                <CardHeader>
                    <CardTitle>Weekly Summary</CardTitle>
                    <CardDescription>Task summary for the last 7 days.</CardDescription>
                </CardHeader>
                <CardContent>
                    <TaskSummaryChart tasks={weeklyTasks} />
                </CardContent>
            </Card>
        </TabsContent>
        <TabsContent value="monthly" className="space-y-4">
            <Card>
                <CardHeader>
                    <CardTitle>Monthly Summary</CardTitle>
                    <CardDescription>Task summary for the last 30 days.</CardDescription>
                </CardHeader>
                <CardContent>
                    <TaskSummaryChart tasks={monthlyTasks} />
                </CardContent>
            </Card>
        </TabsContent>
      </Tabs>
    </div>
  );
}
