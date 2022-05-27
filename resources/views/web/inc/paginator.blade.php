@if ($paginator->hasPages())
    <!-- pagination -->
    <div class="col-md-12">
        <div class="post-pagination">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a href="#" class=" btn disabled pagination-back pull-left">Back</a>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="pagination-back pull-left">Back</a>
            @endif

            
            <ul class="pages">
                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active">{{ $page }}</li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </ul>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="pagination-next pull-right">Next</a>
            @else
                <a href="#" class=" btn disabled pagination-next pull-right">Next</a>
            @endif
        </div>
    </div>
    <!-- pagination -->
@endif
