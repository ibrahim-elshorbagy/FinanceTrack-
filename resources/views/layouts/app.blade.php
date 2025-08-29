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
      <x-sidebar />

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
