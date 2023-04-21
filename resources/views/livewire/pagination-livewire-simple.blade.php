<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center">
            <span>
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium bg-gray-500 border-2 border-gray-500 border-opacity-50 text-gray-800 cursor-default leading-5 rounded-md">
                        {{-- {!! __('pagination.previous') !!} --}}
                        Prev
                    </span>
                @else
                    <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev"
                        class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white border-2 border-teal-600 leading-5 rounded-md transition ease-in-out duration-150">
                        {{-- {!! __('pagination.previous') !!} --}}
                        Prev
                    </button>
                @endif
            </span>
            <div class="p-2"></div>
            <span>
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <button wire:click="nextPage" wire:loading.attr="disabled" rel="next"
                        class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white border-2 border-teal-600 leading-5 rounded-md transition ease-in-out duration-150">
                        {{-- {!! __('pagination.next') !!} --}}
                        Next
                    </button>
                @else
                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium bg-gray-500 border-2 border-gray-500 border-opacity-50 text-gray-800 cursor-default leading-5 rounded-md">
                        {{-- {!! __('pagination.next') !!} --}}
                        Next
                    </span>
                @endif
            </span>
        </nav>
    @endif
    <div class="p-0 w-full" wire:loading>
        <div class="text-blue-400 i nline-block border-blue-700 border-l-8 p-2 bg-blue-400 bg-opacity-30 animate-pulse">Loading . . . </div>
    </div>
</div>
