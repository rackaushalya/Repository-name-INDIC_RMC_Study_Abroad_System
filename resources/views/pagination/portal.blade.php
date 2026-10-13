{{--
    Pagination for the student/admin portal pages. Self-contained styling so it
    does not depend on Tailwind or Bootstrap. Use: {{ $items->links('pagination.portal') }}
--}}
@if ($paginator->hasPages())
    <style>
        .portal-pager { display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; font-family: Arial, Helvetica, sans-serif; }
        .portal-pager-info { font-size: 12px; color: #727c8d; }
        .portal-pager-links { display: flex; gap: 6px; flex-wrap: wrap; }
        .portal-pager-links a,
        .portal-pager-links span {
            min-width: 34px;
            height: 34px;
            padding: 0 11px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e1e5ed;
            border-radius: 8px;
            background: #fff;
            color: #374151;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
        }
        .portal-pager-links a:hover { border-color: #fdba74; color: #f97316; }
        .portal-pager-links .current { background: #f97316; border-color: #f97316; color: #fff; }
        .portal-pager-links .disabled { color: #b6bdc9; background: #f8fafc; }
    </style>

    <nav class="portal-pager" role="navigation" aria-label="Pagination">

        <div class="portal-pager-info">
            Showing {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }}
            of {{ $paginator->total() }}
        </div>

        <div class="portal-pager-links">

            @if ($paginator->onFirstPage())
                <span class="disabled">&lsaquo;</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&lsaquo;</a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="disabled">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="current">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next">&rsaquo;</a>
            @else
                <span class="disabled">&rsaquo;</span>
            @endif

        </div>

    </nav>
@endif
