'use server';

/**
 * @fileOverview AI-powered task search flow.
 *
 * This flow allows users to search for tasks using natural language descriptions.
 * - aiPoweredTaskSearch - A function that handles the task search process.
 * - AIPoweredTaskSearchInput - The input type for the aiPoweredTaskSearch function.
 * - AIPoweredTaskSearchOutput - The return type for the aiPoweredTaskSearch function.
 */

import {ai} from '@/ai/genkit';
import {z} from 'genkit';

const AIPoweredTaskSearchInputSchema = z.object({
  query: z.string().describe('The natural language query to search for tasks.'),
  tasks: z.array(z.string()).describe('A list of tasks to search through.'),
});
export type AIPoweredTaskSearchInput = z.infer<typeof AIPoweredTaskSearchInputSchema>;

const AIPoweredTaskSearchOutputSchema = z.object({
  relevantTasks: z.array(z.string()).describe('The tasks that are relevant to the query.'),
});
export type AIPoweredTaskSearchOutput = z.infer<typeof AIPoweredTaskSearchOutputSchema>;

export async function aiPoweredTaskSearch(input: AIPoweredTaskSearchInput): Promise<AIPoweredTaskSearchOutput> {
  return aiPoweredTaskSearchFlow(input);
}

const prompt = ai.definePrompt({
  name: 'aiPoweredTaskSearchPrompt',
  input: {
    schema: AIPoweredTaskSearchInputSchema,
  },
  output: {
    schema: AIPoweredTaskSearchOutputSchema,
  },
  prompt: `You are an AI assistant helping users find relevant tasks based on their natural language query.

  Given the following tasks:
  {{#each tasks}}
  - {{this}}
  {{/each}}

  Determine which tasks are relevant to the following query:
  {{query}}

  Return only the relevant tasks in a JSON array.
  Make sure to return a valid JSON array. Do not include any other text in the output.`,
});

const aiPoweredTaskSearchFlow = ai.defineFlow(
  {
    name: 'aiPoweredTaskSearchFlow',
    inputSchema: AIPoweredTaskSearchInputSchema,
    outputSchema: AIPoweredTaskSearchOutputSchema,
  },
  async input => {
    const {output} = await prompt(input);
    try {
      // Attempt to parse the output as JSON
      const relevantTasks = JSON.parse(output!.relevantTasks.toString());
      return {relevantTasks};
    } catch (error) {
      // If parsing fails, return an empty array
      console.error('Failed to parse JSON from the prompt output:', error);
      return {relevantTasks: []};
    }
  }
);
