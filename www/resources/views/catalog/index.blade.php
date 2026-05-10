@extends('layouts.base')
@php
    $view = request('view', 'list') === 'list' ? 'list' : 'grid';
@endphp
@vite('resources/js/catalog.js')

@section('content')
    <div class="row">
        <div class="col-2">
            <div class="list-group shadow-sm">

                @foreach ($groups as $group)
                    @include('components.sidebar-item', ['group' => $group])
                @endforeach
            </div>
        </div>

        <div class="col-8">
            <div class="container-fluid d-flex gap-2">
                @include('components.sort-dropdown')
                @include('components.pagination-settings')
                @include('components.catalog-style-settings')
            </div>
            <div class="mt-4">
                {{ $products->links('components.pagination') }}
            </div>
            <div id="products"
                class="row {{ $view === 'grid' ? 'row-cols-3 row-cols-md-3' : 'row-cols-1' }} gap-0 row-gap-1 d-flex">


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
        </div>
    </div>


@endsection