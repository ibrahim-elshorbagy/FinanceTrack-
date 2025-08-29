<nav x-cloak
  class="fixed left-0 z-30 flex h-svh w-60 shrink-0 flex-col border-r border-neutral-300 bg-neutral-200 p-4 transition-transform duration-300 md:w-64 md:translate-x-0 md:relative dark:border-neutral-700 dark:bg-neutral-900"
  x-bind:class="sidebarIsOpen ? 'translate-x-0' : '-translate-x-60'" aria-label="sidebar navigation">
  <!-- Logo -->
  <a href="{{ route('dashboard') }}" wire:navigate class="ml-2 w-fit text-2xl font-bold text-black dark:text-neutral-100">
    <x-application-logo class="w-24" />
  </a>

  <!-- Search -->
  <div class="relative my-4 flex w-full max-w-xs flex-col gap-1 text-neutral-800 dark:text-neutral-300">
    <i
      class="fa-solid fa-search absolute left-2 top-1/2 size-5 -translate-y-1/2 text-neutral-800/50 dark:text-neutral-300/50"></i>
    <input type="search"
      class="w-full border border-neutral-300 rounded-xl bg-neutral-100 px-2 py-1.5 pl-9 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-500 disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-800/50 dark:focus-visible:outline-purple-400"
      placeholder="Search" aria-label="Search" />
  </div>

  <!-- Sidebar Links -->
  <div class="flex flex-col gap-2 overflow-y-auto pb-6">
    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" wire:navigate>
      <i class="fa-solid fa-chart-line size-5 shrink-0"></i>
      <span>Dashboard</span>
    </x-nav-link>

    <x-nav-submenu title="User Management" icon="fa-users" :active="request()->routeIs('users.*')">
      <x-nav-submenu-item href="#" :active="request()->routeIs('users.index')">Users</x-nav-submenu-item>
      <x-nav-submenu-item href="#" :active="request()->routeIs('users.roles')">Roles</x-nav-submenu-item>
      <x-nav-submenu-item href="#" :active="request()->routeIs('users.permissions')">Permissions</x-nav-submenu-item>
    </x-nav-submenu>

    <x-nav-submenu title="Wallets" icon="fa-wallet" :active="request()->routeIs('wallets.*')">
      <x-nav-submenu-item href="#" :active="request()->routeIs('wallets.index')">All Wallets</x-nav-submenu-item>
      <x-nav-submenu-item href="#" :active="request()->routeIs('wallets.transactions')">Transactions</x-nav-submenu-item>
      <x-nav-submenu-item href="#" :active="request()->routeIs('wallets.reports')">Reports</x-nav-submenu-item>
    </x-nav-submenu>

    <x-nav-submenu title="Tasks" icon="fa-list-check" :active="request()->routeIs('tasks.*')">
      <x-nav-submenu-item href="#" :active="request()->routeIs('tasks.active')">Active Tasks</x-nav-submenu-item>
      <x-nav-submenu-item href="#" :active="request()->routeIs('tasks.completed')">Completed</x-nav-submenu-item>
      <x-nav-submenu-item href="#" :active="request()->routeIs('tasks.sources')">Sources</x-nav-submenu-item>
    </x-nav-submenu>

    <x-nav-link href="{{ route('profile') }}" :active="request()->routeIs('profile')" wire:navigate>
      <i class="fa-solid fa-gear size-5 shrink-0"></i>
      <span>Settings</span>
    </x-nav-link>
  </div>
</nav>
