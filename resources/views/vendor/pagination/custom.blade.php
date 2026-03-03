@if ($paginator->hasPages())
    <div class="pagination">
        <p>{{ __('pagination.showing', ['first' => $paginator->firstItem(), 'last' => $paginator->lastItem(), 'total' => $paginator->total()]) }}
        </p>

        <ul>
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <a href="javascript:void(0)"><i class="bi bi-chevron-left"></i></a>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i
                            class="bi bi-chevron-left"></i></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"><a href="javascript:void(0)">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i
                            class="bi bi-chevron-right"></i></a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <a href="javascript:void(0)"><i class="bi bi-chevron-right"></i></a>
                </li>
            @endif
        </ul>
    </div>
@endif