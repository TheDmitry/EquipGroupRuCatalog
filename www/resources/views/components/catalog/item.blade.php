<div class="col">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            @if ($product->price)
                <p class="card-text">{{ $product->getFormattedPrice() }}</p>
            @endif
            <a href="/product/{{ $product->id }}" class="btn btn-primary">К товару</a>
        </div>
    </div>
</div>