@foreach($results as $product)
<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            @if($product->image)
                <div class="col-md-3">
                    <img src="{{ Storage::url($product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
                </div>
            @endif
            <div class="col">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">{{ Str::limit($product->description, 150) }}</p>
                <p class="card-text">
                    <small class="text-muted">Category: {{ $product->category->name }}</small>
                </p>
                <h6 class="card-subtitle mb-2 text-primary">${{ number_format($product->price, 2) }}</h6>
                <a href="{{ route('products.show', $product) }}" class="btn btn-primary btn-sm">View Details</a>
            </div>
        </div>
    </div>
</div>
@endforeach

{{ $results->links() }}