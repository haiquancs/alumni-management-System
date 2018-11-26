@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span class="page-link">Trở về</span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}&code={{@$code}}&full_name={{@$full_name}}&graduation_year={{@$graduation_year}}&graduation_business={{@$graduation_business}}&survey={{@$survey}}"
                                     rel="prev">Trở về</a></li>
        @endif

        {{-- Pagination --}}
        @for ($i=1; $i<=$paginator->lastPage(); $i++)
            @if ($i == $paginator->currentPage())
                <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $paginator->url($i) }}&code={{@$code}}&full_name={{@$full_name}}&graduation_year={{@$graduation_year}}&graduation_business={{@$graduation_business}}&survey={{@$survey}}">{{ $i }}</a></li>
            @endif
        @endfor

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}&code={{@$code}}&full_name={{@$full_name}}&graduation_year={{@$graduation_year}}&graduation_business={{@$graduation_business}}&survey={{@$survey}}" rel="next">Tiếp</a></li>
        @else
            <li class="page-item disabled"><span class="page-link">Tiếp</span></li>
        @endif
    </ul>
@endif
