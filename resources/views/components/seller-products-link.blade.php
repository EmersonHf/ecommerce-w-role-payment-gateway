<div>                
    @if (Auth::user() && Auth::user()->hasRole('seller'))
        <a href="{{ route('seller.products.index', ['seller' => Auth::user()->id]) }}"
            class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base md:mt-0">My
            Products
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                <path d="M5 12h14M12 5l7 7-7 7"></path>
            </svg>
        </a>
    @endif
</div>

