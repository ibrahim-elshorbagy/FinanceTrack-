@props(['href', 'active' => false, 'badge' => null])

<li class="px-1 py-0.5">
    <a href="{{ $href }}"
       class="flex items-center rounded-xl gap-2 px-2 py-1.5 text-sm text-neutral-800 underline-offset-2 hover:bg-purple-500/5 hover:text-black focus-visible:underline focus:outline-hidden dark:text-neutral-300 dark:hover:bg-purple-400/5 dark:hover:text-neutral-100 {{ $active ? 'bg-purple-500/10 text-black dark:bg-purple-400/10 dark:text-neutral-100' : '' }}">
        <span>{{ $slot }}</span>
        @if($badge)
            <span class="ml-auto font-bold">{{ $badge }}</span>
        @endif
    </a>
</li>
