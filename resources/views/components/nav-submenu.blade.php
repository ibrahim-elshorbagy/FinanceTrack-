@props(['title', 'icon', 'active' => false])

<div x-data="{ isExpanded: {{ $active ? 'true' : 'false' }} }" class="flex flex-col">
    <button type="button"
            x-on:click="isExpanded = ! isExpanded"
            class="flex items-center justify-between rounded-xl gap-2 pr-2 py-1.5 text-sm font-medium underline-offset-2 focus:outline-hidden focus-visible:underline"
            x-bind:class="isExpanded ? 'text-black bg-purple-500/10 dark:text-neutral-100 dark:bg-purple-400/10' : 'text-neutral-800 hover:bg-purple-500/5 hover:text-black dark:text-neutral-300 dark:hover:bg-purple-400/5 dark:hover:text-neutral-100'">
        <i class="fa-solid {{ $icon }} size-5 shrink-0"></i>
        <span class="mr-auto text-left">{{ $title }}</span>
        <i class="fa-solid fa-chevron-down size-5 transition-transform shrink-0"
           x-bind:class="isExpanded ? 'rotate-180' : 'rotate-0'"></i>
    </button>

    <ul x-cloak x-collapse x-show="isExpanded" class="flex flex-col gap-0.5 mt-1">
        {{ $slot }}
    </ul>
</div>
