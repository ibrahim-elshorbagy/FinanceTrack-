<nav x-cloak x-data="{
    searchQuery: '',
    filteredNavItems: [],

    init() {
        this.updateFilteredItems();
        this.$watch('searchQuery', () => this.updateFilteredItems());
    },

    updateFilteredItems() {
        const query = this.searchQuery.toLowerCase().trim();
        if (!query) {
            this.filteredNavItems = [];
            return;
        }

        // Define all navigation items for searching
        const allNavItems = [
            { name: 'Dashboard', icon: 'fa-chart-line', href: '{{ route('dashboard') }}', route: 'dashboard' },
            { name: 'Users', icon: 'fa-users', href: '#', route: 'users.index', parent: 'User Management' },
            { name: 'Roles', icon: 'fa-users', href: '#', route: 'users.roles', parent: 'User Management' },
            { name: 'Permissions', icon: 'fa-users', href: '#', route: 'users.permissions', parent: 'User Management' },
            { name: 'All Wallets', icon: 'fa-wallet', href: '#', route: 'wallets.index', parent: 'Wallets' },
            { name: 'Transactions', icon: 'fa-wallet', href: '#', route: 'wallets.transactions', parent: 'Wallets' },
            { name: 'Reports', icon: 'fa-wallet', href: '#', route: 'wallets.reports', parent: 'Wallets' },
            { name: 'Active Tasks', icon: 'fa-list-check', href: '#', route: 'tasks.active', parent: 'Tasks' },
            { name: 'Completed', icon: 'fa-list-check', href: '#', route: 'tasks.completed', parent: 'Tasks' },
            { name: 'Sources', icon: 'fa-list-check', href: '#', route: 'tasks.sources', parent: 'Tasks' },
            { name: 'Settings', icon: 'fa-gear', href: '{{ route('profile') }}', route: 'profile' }
        ];

        this.filteredNavItems = allNavItems.filter(item =>
            item.name.toLowerCase().includes(query) ||
            (item.parent && item.parent.toLowerCase().includes(query))
        );
    },

    closeSidebar() {
        this.sidebarIsOpen = false;
    }
}"
  class="fixed left-0 z-30 flex h-svh w-60 shrink-0 flex-col border-r border-neutral-300 bg-neutral-200 p-4 transition-transform duration-300 md:w-64 md:translate-x-0 md:relative dark:border-neutral-700 dark:bg-neutral-900"
  x-bind:class="sidebarIsOpen ? 'translate-x-0' : '-translate-x-60'" aria-label="sidebar navigation">

  <!-- Close button for mobile -->
  <div class="py-4 justify-end flex">
    <button @click="closeSidebar()"
      class="md:hidden p-2 rounded-lg text-neutral-600 hover:text-neutral-900 hover:bg-neutral-300/50 dark:text-neutral-400 dark:hover:text-neutral-100 dark:hover:bg-neutral-700/50 transition-colors"
      aria-label="Close sidebar">
      <i class="fa-solid fa-times size-5"></i>
    </button>
  </div>
  <div class="flex items-center justify-between mb-4">
    <a href="{{ route('dashboard') }}" wire:navigate
      class="ml-2 w-48  text-2xl font-bold text-black dark:text-neutral-100">
      <x-application-logo  />
    </a>
  </div>


  <!-- Search -->
  <div class="relative flex w-full max-w-xs flex-col gap-1 text-neutral-800 dark:text-neutral-300">
    <i
      class="fa-solid fa-search absolute left-2 top-1/2 size-5 -translate-y-1/2 text-neutral-800/50 dark:text-neutral-300/50"></i>
    <input type="search" x-model="searchQuery"
      class="w-full border border-neutral-300 rounded-xl bg-neutral-100 px-2 py-1.5 pl-9 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-500 disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-800/50 dark:focus-visible:outline-purple-400"
      placeholder="Search navigation..." aria-label="Search" />

    <!-- Search Results -->
    <div x-show="searchQuery && filteredNavItems.length > 0" x-transition:enter="transition ease-out duration-200"
      x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
      x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
      x-transition:leave-end="opacity-0 scale-95"
      class="absolute top-full left-0 right-0 mt-2 bg-white dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 rounded-lg shadow-lg z-50 max-h-64 overflow-y-auto">

      <template x-for="item in filteredNavItems" :key="item.route">
        <a :href="item.href" wire:navigate @click="searchQuery = ''"
          class="flex items-center gap-3 px-3 py-2 text-sm text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-700 transition-colors first:rounded-t-lg last:rounded-b-lg">
          <i :class="'fa-solid ' + item.icon + ' size-4 shrink-0'"></i>
          <div class="flex flex-col">
            <span x-text="item.name"></span>
            <span x-show="item.parent" x-text="item.parent"
              class="text-xs text-neutral-500 dark:text-neutral-400"></span>
          </div>
        </a>
      </template>
    </div>

    <!-- No Results -->
    <div x-show="searchQuery && filteredNavItems.length === 0" x-transition
      class="absolute top-full left-0 right-0 mt-2 bg-white dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 rounded-lg shadow-lg z-50 px-3 py-4 text-center text-sm text-neutral-500 dark:text-neutral-400">
      No results found for "<span x-text="searchQuery"></span>"
    </div>
  </div>

  <!-- Sidebar Links -->
  <div class="flex flex-col gap-2 overflow-y-auto pb-6 mt-4" x-show="!searchQuery">
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
