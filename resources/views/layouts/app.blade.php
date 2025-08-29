<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Flocashra') }} {{ isset($title) ? ' - ' . $title : '' }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="font-sans antialiased">
  <div x-data="{ sidebarIsOpen: false }" class="min-h-screen bg-gray-100 dark:bg-gray-900">
    <!-- Skip to main content link for accessibility -->
    <a class="sr-only" href="#main-content">skip to the main content</a>

    <!-- Dark overlay for mobile sidebar -->
    <div x-cloak x-show="sidebarIsOpen" class="fixed inset-0 z-20 bg-neutral-800/10 backdrop-blur-xs md:hidden"
      aria-hidden="true" x-on:click="sidebarIsOpen = false" x-transition.opacity></div>

    <div class="relative flex w-full flex-col md:flex-row">
      <!-- Sidebar Navigation -->
      <nav x-cloak class="fixed left-0 z-30 flex h-svh w-60 shrink-0 flex-col border-r border-neutral-300 bg-neutral-200 p-4 transition-transform duration-300 md:w-64 md:translate-x-0 md:relative dark:border-neutral-700 dark:bg-neutral-900"
           x-bind:class="sidebarIsOpen ? 'translate-x-0' : '-translate-x-60'"
           aria-label="sidebar navigation">
          <!-- Logo -->
          <a href="{{ route('dashboard') }}" wire:navigate class="ml-2 w-fit text-2xl font-bold text-black dark:text-neutral-100">
              <x-application-logo class="w-24" />
          </a>

          <!-- Search -->
          <div class="relative my-4 flex w-full max-w-xs flex-col gap-1 text-neutral-800 dark:text-neutral-300">
              <i class="fa-solid fa-search absolute left-2 top-1/2 size-5 -translate-y-1/2 text-neutral-800/50 dark:text-neutral-300/50"></i>
              <input type="search" class="w-full border border-neutral-300 rounded-xl bg-neutral-100 px-2 py-1.5 pl-9 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-500 disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-800/50 dark:focus-visible:outline-purple-400"
                     placeholder="Search" aria-label="Search"/>
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

      <!-- Main Content Area -->
      <div class="flex flex-col w-full">
        <!-- Top Navigation Bar -->
        <div class="sticky top-0 z-10 w-full border-b border-neutral-300 bg-neutral-200 px-4 py-2 dark:border-neutral-700 dark:bg-neutral-900">
            <div class="flex items-center justify-between">
                <!-- Sidebar Toggle -->
                <button type="button" class="md:hidden text-neutral-800 dark:text-neutral-300" x-on:click="sidebarIsOpen = true">
                    <i class="fa-solid fa-bars size-5"></i>
                    <span class="sr-only">Toggle Sidebar</span>
                </button>

                <!-- Breadcrumbs -->
                <nav class="hidden md:block text-sm font-medium text-neutral-800 dark:text-neutral-300">
                    <ol class="flex items-center gap-1">
                        <li class="flex items-center gap-1">
                            <a href="#" class="hover:text-black dark:hover:text-neutral-100">Dashboard</a>
                            <i class="fa-solid fa-chevron-right size-4"></i>
                        </li>
                        <li class="font-bold text-black dark:text-neutral-100">Current Page</li>
                    </ol>
                </nav>

                <!-- Profile Menu -->
                <div x-data="{ profileOpen: false }" class="relative" @keydown.escape.window="profileOpen = false">
                    <button type="button"
                            class="flex items-center rounded-xl gap-2 p-2 text-neutral-800 hover:bg-purple-500/5 hover:text-black focus:outline-none dark:text-neutral-300 dark:hover:bg-purple-400/5 dark:hover:text-neutral-100"
                            @click="profileOpen = !profileOpen">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}"
                             class="size-8 rounded-xl object-cover"
                             alt="{{ auth()->user()->name }}" />
                        <div class="hidden md:flex flex-col text-left">
                            <span class="text-sm font-bold text-black dark:text-neutral-100">{{ auth()->user()->name }}</span>
                            <span class="text-xs">{{ auth()->user()->email }}</span>
                        </div>
                    </button>

                    <!-- Profile Dropdown -->
                    <div x-show="profileOpen"
                         x-transition
                         @click.away="profileOpen = false"
                         class="absolute right-0 mt-2 w-48 rounded-xl border border-neutral-300 bg-neutral-100 shadow-lg dark:border-neutral-700 dark:bg-neutral-800">
                        <div class="p-1">
                            <a href="{{ route('profile') }}" wire:navigate
                               class="flex items-center gap-2 rounded-lg px-4 py-2 text-sm text-neutral-800 hover:bg-purple-500/5 hover:text-black dark:text-neutral-300 dark:hover:bg-purple-400/5 dark:hover:text-neutral-100">
                                <i class="fa-solid fa-user"></i>
                                Profile
                            </a>
                            <livewire:components.logout-button />

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main id="main-content" class="h-svh w-full overflow-y-auto">
            {{ $slot }}
        </main>
      </div>
    </div>
  </div>
</body>

</html>
