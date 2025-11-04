'use client';

import { Bar, BarChart, CartesianGrid, XAxis, YAxis, Tooltip } from 'recharts';
import { ChartContainer, ChartTooltipContent } from '@/components/ui/chart';
import type { Task } from '@/lib/types';
import { useMemo } from 'react';

interface TaskSummaryChartProps {
  tasks: Task[];
}

export default function TaskSummaryChart({ tasks }: TaskSummaryChartProps) {
  const chartData = useMemo(() => {
    const statusCounts = tasks.reduce((acc, task) => {
      acc[task.status] = (acc[task.status] || 0) + 1;
      return acc;
    }, {} as { [key: string]: number });

    return [
      { status: 'To Do', count: statusCounts['To Do'] || 0 },
      { status: 'In Progress', count: statusCounts['In Progress'] || 0 },
      { status: 'Done', count: statusCounts['Done'] || 0 },
      { status: 'Cancelled', count: statusCounts['Cancelled'] || 0 },
    ];
  }, [tasks]);

  const chartConfig = {
    count: {
      label: 'Tasks',
      color: 'hsl(var(--primary))',
    },
  };

  return (
    <ChartContainer config={chartConfig} className="min-h-[200px] w-full">
      <BarChart accessibilityLayer data={chartData}>
        <CartesianGrid vertical={false} />
        <XAxis
          dataKey="status"
          tickLine={false}
          tickMargin={10}
          axisLine={false}
          tickFormatter={(value) => value}
        />
        <YAxis allowDecimals={false} />
        <Tooltip cursor={false} content={<ChartTooltipContent />} />
        <Bar dataKey="count" fill="var(--color-count)" radius={4} />
      </BarChart>
    </ChartContainer>
  );
}
