'use client';

import { SidebarTrigger } from '@/components/ui/sidebar';
import UserNav from '@/components/dashboard/user-nav';

export default function AppHeader() {
  return (
    <header className="sticky top-0 z-10 flex h-16 items-center gap-4 border-b bg-background/80 px-4 backdrop-blur-sm md:px-6">
      <SidebarTrigger className="md:hidden" />
      <div className="w-full flex-1">
        {/* Can add breadcrumbs or page title here */}
      </div>
      <UserNav />
    </header>
  );
}
