'use client';

import type { Task, Priority, Status } from '@/lib/types';
import { useState, useMemo, useEffect, useTransition } from 'react';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Badge } from '@/components/ui/badge';
import { format } from 'date-fns';
import { Avatar, AvatarFallback, AvatarImage } from '../ui/avatar';
import { Button } from '../ui/button';
import { Input } from '../ui/input';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '../ui/select';
import { Bot, Loader2, Search, Sparkles } from 'lucide-react';
import { aiPoweredTaskSearch } from '@/ai/flows/ai-powered-task-search';
import { getTaskFilterSuggestions } from '@/ai/flows/task-filter-suggestions';
import { useToast } from '@/hooks/use-toast';
import CreateTaskDialog from './create-task-dialog';
import { cn } from '@/lib/utils';

interface TasksTableProps {
  tasks: Task[];
  title: string;
}

const priorityColors: { [key in Priority]: string } = {
  Urgent: 'bg-red-500 hover:bg-red-600',
  High: 'bg-orange-500 hover:bg-orange-600',
  Medium: 'bg-yellow-500 hover:bg-yellow-600',
  Low: 'bg-green-500 hover:bg-green-600',
};

const statusColors: { [key in Status]: string } = {
  'To Do': 'bg-gray-500',
  'In Progress': 'bg-blue-500',
  Done: 'bg-green-500',
  Cancelled: 'bg-red-500',
};

export default function TasksTable({ tasks, title }: TasksTableProps) {
  const [filteredTasks, setFilteredTasks] = useState(tasks);
  const [priorityFilter, setPriorityFilter] = useState('all');
  const [statusFilter, setStatusFilter] = useState('all');
  const [searchQuery, setSearchQuery] = useState('');
  const [isAiSearching, startAiSearchTransition] = useTransition();
  const [isSuggestionLoading, startSuggestionLoadingTransition] = useTransition();
  const [suggestedFilters, setSuggestedFilters] = useState<string[]>([]);
  const { toast } = useToast();

  useEffect(() => {
    let result = tasks;
    if (priorityFilter !== 'all') {
      result = result.filter(task => task.priority === priorityFilter);
    }
    if (statusFilter !== 'all') {
      result = result.filter(task => task.status === statusFilter);
    }
    setFilteredTasks(result);
    setSearchQuery('');
  }, [priorityFilter, statusFilter, tasks]);

  const handleAiSearch = () => {
    if (!searchQuery) {
      setFilteredTasks(tasks);
      return;
    }
    startAiSearchTransition(async () => {
      try {
        const taskTitles = tasks.map(t => t.title);
        const { relevantTasks } = await aiPoweredTaskSearch({ query: searchQuery, tasks: taskTitles });
        const result = tasks.filter(t => relevantTasks.includes(t.title));
        setFilteredTasks(result);
      } catch (error) {
        toast({
          variant: "destructive",
          title: "AI Search Failed",
          description: "Could not perform AI-powered search. Please try again.",
        });
      }
    });
  };

  const handleGetSuggestions = () => {
    startSuggestionLoadingTransition(async () => {
        try {
            const taskListString = JSON.stringify(tasks.map(t => ({ title: t.title, priority: t.priority, status: t.status })));
            const { suggestedFilters } = await getTaskFilterSuggestions({ taskList: taskListString, pastSearches: '[]' });
            setSuggestedFilters(suggestedFilters);
        } catch (error) {
            toast({
                variant: "destructive",
                title: "Suggestion Failed",
                description: "Could not get filter suggestions. Please try again.",
            });
        }
    });
  }

  return (
    <Card>
      <CardHeader>
        <div className="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <CardTitle>{title}</CardTitle>
                <CardDescription>View, search, and manage tasks.</CardDescription>
            </div>
            <CreateTaskDialog />
        </div>
        <div className="flex flex-col gap-4 pt-4">
            <div className="flex flex-col md:flex-row gap-2">
                <div className="relative flex-1">
                    <Search className="absolute left-2.5 top-2.5 h-4 w-4 text-muted-foreground" />
                    <Input 
                        placeholder="Search tasks with natural language..." 
                        className="pl-8" 
                        value={searchQuery}
                        onChange={(e) => setSearchQuery(e.target.value)}
                        onKeyDown={(e) => e.key === 'Enter' && handleAiSearch()}
                    />
                </div>
                <Button onClick={handleAiSearch} disabled={isAiSearching}>
                    {isAiSearching ? <Loader2 className="mr-2 h-4 w-4 animate-spin" /> : <Bot className="mr-2 h-4 w-4" />}
                    AI Search
                </Button>
                <Select value={priorityFilter} onValueChange={setPriorityFilter}>
                    <SelectTrigger className="w-full md:w-[180px]">
                        <SelectValue placeholder="Filter by priority" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectItem value="all">All Priorities</SelectItem>
                        <SelectItem value="Urgent">Urgent</SelectItem>
                        <SelectItem value="High">High</SelectItem>
                        <SelectItem value="Medium">Medium</SelectItem>
                        <SelectItem value="Low">Low</SelectItem>
                    </SelectContent>
                </Select>
                <Select value={statusFilter} onValueChange={setStatusFilter}>
                    <SelectTrigger className="w-full md:w-[180px]">
                        <SelectValue placeholder="Filter by status" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectItem value="all">All Statuses</SelectItem>
                        <SelectItem value="To Do">To Do</SelectItem>
                        <SelectItem value="In Progress">In Progress</SelectItem>
                        <SelectItem value="Done">Done</SelectItem>
                        <SelectItem value="Cancelled">Cancelled</SelectItem>
                    </SelectContent>
                </Select>
            </div>
            <div className='flex items-center gap-2 flex-wrap'>
                <Button variant="ghost" size="sm" onClick={handleGetSuggestions} disabled={isSuggestionLoading}>
                    {isSuggestionLoading ? <Loader2 className="mr-2 h-4 w-4 animate-spin" /> : <Sparkles className="mr-2 h-4 w-4" />}
                    Suggest Filters
                </Button>
                {suggestedFilters.map((filter, i) => (
                    <Badge key={i} variant="secondary" className="cursor-pointer" onClick={() => setSearchQuery(filter)}>
                        {filter}
                    </Badge>
                ))}
            </div>
        </div>
      </CardHeader>
      <CardContent>
        <div className="overflow-x-auto">
          <Table>
            <TableHeader>
              <TableRow>
                <TableHead>Task</TableHead>
                <TableHead>Status</TableHead>
                <TableHead>Priority</TableHead>
                <TableHead>Deadline</TableHead>
                <TableHead>Assignee</TableHead>
              </TableRow>
            </TableHeader>
            <TableBody>
              {filteredTasks.length > 0 ? (
                filteredTasks.map(task => (
                  <TableRow key={task.id}>
                    <TableCell className="font-medium">{task.title}</TableCell>
                    <TableCell>
                      <Badge className={cn('text-primary-foreground', statusColors[task.status])}>
                        {task.status}
                      </Badge>
                    </TableCell>
                    <TableCell>
                      <Badge className={cn('text-primary-foreground', priorityColors[task.priority])}>
                        {task.priority}
                      </Badge>
                    </TableCell>
                    <TableCell>{format(task.deadline, 'PPP')}</TableCell>
                    <TableCell>
                      <div className="flex items-center gap-2">
                        <Avatar className="h-8 w-8">
                          <AvatarImage src={task.assignee.avatar} alt={task.assignee.name} data-ai-hint="person face" />
                          <AvatarFallback>{task.assignee.name.charAt(0)}</AvatarFallback>
                        </Avatar>
                        <span>{task.assignee.name}</span>
                      </div>
                    </TableCell>
                  </TableRow>
                ))
              ) : (
                <TableRow>
                  <TableCell colSpan={5} className="text-center">
                    No tasks found.
                  </TableCell>
                </TableRow>
              )}
            </TableBody>
          </Table>
        </div>
      </CardContent>
    </Card>
  );
}
