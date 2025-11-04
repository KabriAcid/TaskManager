'use client';

import { USERS } from '@/lib/data';
import type { User } from '@/lib/types';
import React, { createContext, useCallback, useState, useMemo, useEffect } from 'react';

interface AuthContextType {
  user: User | null;
  users: User[];
  switchUser: (userId: string) => void;
}

export const AuthContext = createContext<AuthContextType | null>(null);

export function AuthProvider({ children }: { children: React.ReactNode }) {
  const [user, setUser] = useState<User | null>(null);

  useEffect(() => {
    // Set default user on initial client-side render
    setUser(USERS[0]);
  }, []);

  const switchUser = useCallback((userId: string) => {
    const selectedUser = USERS.find(u => u.id === userId);
    if (selectedUser) {
      setUser(selectedUser);
    }
  }, []);

  const value = useMemo(() => ({
    user,
    users: USERS,
    switchUser,
  }), [user, switchUser]);

  return (
    <AuthContext.Provider value={value}>
      {children}
    </AuthContext.Provider>
  );
}
