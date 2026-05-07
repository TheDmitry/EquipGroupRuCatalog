@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-4">
            <div class="list-group">
                @foreach ($groups as $group)
                    <a href="/group/{{ $group->id }}" class="list-group-item list-group-item-action">
                        {{ $group->name }} ({{ $group->productsCount }})
                    </a>
                @endforeach
            </div>
        </div>

        <div class="col-8">
            <div class="row row-cols-1 gap-0 row-gap-1 d-flex">
            @include('components.sort-dropdown')
                @foreach ($products as $product)
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
                @endforeach
            </div>
            <div class="mt-4">
                {{ $products->links('components.pagination') }}
            </div>
        </div>
    </div>


@endsection