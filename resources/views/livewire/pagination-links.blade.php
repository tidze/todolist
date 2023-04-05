<div>

    @if ($paginator->hasPages())
        <ul class="select-none flex justify-between">
            {{-- prev --}}
            @if ($paginator->onFirstPage())
                <li class="w-16 px-2 py-1 rounded border shadow bg-gray-500">Prev</li>
            @else
                <li class="cursor-pointer w-16 px-2 py-1 rounded border shadow bg-white" wire:click="previousPage">Prev</li>
            @endif
            {{-- end prev --}}

            {{-- numbers --}}

            {{-- end numbers --}}

            {{-- next --}}
            @if ($paginator->hasMorePages())
                <li class="cursor-pointer w-16 px-2 py-1 rounded border shadow bg-white" wire:click="nextPage">next</li>
            @else
                <li class="w-16 px-2 py-1 rounded border shadow bg-gray-500">next</li>
            @endif
            {{-- end next --}}
        </ul>
    @endif
</div>
