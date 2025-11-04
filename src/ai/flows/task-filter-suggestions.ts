'use server';

/**
 * @fileOverview Task filter suggestions flow.
 *
 * This file defines a Genkit flow that suggests relevant filters based on the
 * current task list and past searches.
 *
 * @remarks
 * - `getTaskFilterSuggestions` -  A function that initiates the task filter suggestions flow.
 * - `TaskFilterSuggestionsInput` - The input type for the `getTaskFilterSuggestions` function.
 * - `TaskFilterSuggestionsOutput` - The output type for the `getTaskFilterSuggestions` function.
 */

import {ai} from '@/ai/genkit';
import {z} from 'genkit';

const TaskFilterSuggestionsInputSchema = z.object({
  taskList: z.string().describe('A list of tasks in JSON format.'),
  pastSearches: z.string().describe('A list of past search queries in JSON format.'),
});
export type TaskFilterSuggestionsInput = z.infer<typeof TaskFilterSuggestionsInputSchema>;

const TaskFilterSuggestionsOutputSchema = z.object({
  suggestedFilters: z
    .array(z.string())
    .describe('A list of suggested filters based on the task list and past searches.'),
});
export type TaskFilterSuggestionsOutput = z.infer<typeof TaskFilterSuggestionsOutputSchema>;

export async function getTaskFilterSuggestions(
  input: TaskFilterSuggestionsInput
): Promise<TaskFilterSuggestionsOutput> {
  return taskFilterSuggestionsFlow(input);
}

const taskFilterSuggestionsPrompt = ai.definePrompt({
  name: 'taskFilterSuggestionsPrompt',
  input: {schema: TaskFilterSuggestionsInputSchema},
  output: {schema: TaskFilterSuggestionsOutputSchema},
  prompt: `You are a task management assistant. Given a list of tasks and past searches, suggest relevant filters to narrow down the task list.

Task List:
{{taskList}}

Past Searches:
{{pastSearches}}

Suggest at least 3 relevant filters:
`,
});

const taskFilterSuggestionsFlow = ai.defineFlow(
  {
    name: 'taskFilterSuggestionsFlow',
    inputSchema: TaskFilterSuggestionsInputSchema,
    outputSchema: TaskFilterSuggestionsOutputSchema,
  },
  async input => {
    const {output} = await taskFilterSuggestionsPrompt(input);
    return output!;
  }
);
