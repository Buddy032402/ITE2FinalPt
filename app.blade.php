<form action="{{ route('search') }}" method="GET" class="d-flex" id="searchForm">
    <input class="form-control me-2" type="search" name="query" 
           placeholder="Search products..." aria-label="Search"
           value="{{ request('query') }}"
           id="searchInput">
    <button class="btn btn-outline-success" type="submit">Search</button>
</form>

@push('scripts')
<script>
$(document).ready(function() {
    let searchTimer;
    
    $('#searchInput').on('input', function() {
        clearTimeout(searchTimer);
        
        searchTimer = setTimeout(() => {
            const query = $(this).val();
            if (query.length >= 3) {
                $.get('{{ route('search') }}', {
                    query: query
                }, function(response) {
                    $('#searchResults').html(response.results);
                });
            }
        }, 500);
    });
});
</script>
@endpush