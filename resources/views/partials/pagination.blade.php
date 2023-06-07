 @if ($data->lastPage() > 1)
 
 <nav aria-label="Page navigation example">
     <ul class="pagination justify-content-end">

         {{-- Previous Page Link --}}
         @if ($data->onFirstPage())
         <li class="page-item"><a class="page-link" disabled aria-disabled="true"><span>&laquo;</span></a></li>
         @else
         <li class="page-item"><a class="page-link" href="{{ $data->previousPageUrl() }}" rel="prev">&laquo;</a></li>
         @endif

         {{-- Pagination Elements --}}
         @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)
         @if ($page == $data->currentPage())
         <li class="page-item"><a class="page-link active" aria-current="page">{{ $page }}</a></li>
         @else
         <li class="page-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
         @endif
         @endforeach

         {{-- Next Page Link --}}
         @if ($data->hasMorePages())
         <li><a class="page-link" href="{{ $data->nextPageUrl() }}" rel="next">&raquo;</a></li>
         @else
         <li><a class="page-link" disabled aria-disabled="true"><span>&raquo;</span></a></li>
         @endif

     </ul>
 </nav>

 @endif
