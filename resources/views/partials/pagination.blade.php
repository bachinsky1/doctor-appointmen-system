{{-- Check if there is more than one page --}}
@if ($data->lastPage() > 1)
{{-- Create a navigation section with pagination --}}
<nav aria-label="Page navigation example">
    {{-- Create an unordered list of pagination links, align to the right --}}
    <ul class="pagination justify-content-end">

        {{-- Previous Page Link --}}
        {{-- If on first page, disable link --}}
        @if ($data->onFirstPage())
        <li class="page-item"><a class="page-link" disabled aria-disabled="true"><span>&laquo;</span></a></li>
        {{-- Otherwise, create a link to the previous page --}}
        @else
        <li class="page-item"><a class="page-link" href="{{ $data->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        {{-- Loop through each page and create a link for it --}}
        @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)
        {{-- If this is the current page, add an active class --}}
        @if ($page == $data->currentPage())
        <li class="page-item"><a class="page-link active" aria-current="page">{{ $page }}</a></li>
        {{-- Otherwise, create a link to the page --}}
        @else
        <li class="page-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
        @endif
        @endforeach

        {{-- Next Page Link --}}
        {{-- If there are more pages, create a link to the next page --}}
        @if ($data->hasMorePages())
        <li><a class="page-link" href="{{ $data->nextPageUrl() }}" rel="next">&raquo;</a></li>
        {{-- Otherwise, disable the link --}}
        @else
        <li><a class="page-link" disabled aria-disabled="true"><span>&raquo;</span></a></li>
        @endif
        
    </ul>
</nav>
@endif

