export type Role = 'Admin' | 'Manager' | 'Employee';

export type User = {
  id: string;
  name: string;
  email: string;
  avatar: string;
  role: Role;
};

export type Priority = 'Low' | 'Medium' | 'High' | 'Urgent';
export type Status = 'To Do' | 'In Progress' | 'Done' | 'Cancelled';

export type Task = {
  id: string;
  title: string;
  description: string;
  status: Status;
  priority: Priority;
  deadline: Date;
  createdAt: Date;
  assigner: User;
  assignee: User;
  tags?: string[];
  recurrence?: 'None' | 'Daily' | 'Weekly' | 'Monthly';
};
