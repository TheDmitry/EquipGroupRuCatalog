@extends('layouts.base')
@vite('resources/js/catalog.js')

@section('content')
    <div class="row">
        <div class="col-12 col-md-2 mb-3 mb-md-0">
            <div class="list-group shadow-sm">
                @foreach ($groups as $group)
                    <x-sidebar.item :group="$group" />
                @endforeach
            </div>
        </div>

        <div class="col-12 col-md-10">
            <div class="container-fluid d-flex flex-column flex-md-row gap-2 mb-3">
                <x-catalog.sort-dropdown />
                <x-pagination.settings />
                <x-catalog.style-settings />
            </div>
            <div class="mt-4">
                {{ $products->links('components.pagination.bootstrap5') }}
            </div>
            <div id="products"
                class="row {{ $currentView === 'grid' ? 'row-cols-1 row-cols-sm-2 row-cols-md-3' : 'row-cols-1' }} gx-2 gy-3">


                @foreach ($products as $product)
                    @include('components.catalog.item', ['product' => $product])
                @endforeach
            </div>
        </div>
    </div>


@endsection