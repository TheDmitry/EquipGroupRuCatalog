@extends('layouts.base')
@vite('resources/js/catalog.js')

@section('content')
    <div class="row">
        <div class="col-2">
            <div class="list-group gap-2 shadow-sm">
                <x-sidebar.tree :groups="$groups" :parent="$parent" :path="$path"/>
            </div>
        </div>

        <div class="col-8">
            <div class="container-fluid d-flex gap-2">
                <x-catalog.sort-dropdown />
                <x-pagination.settings />
                <x-catalog.style-settings />
            </div>
            <div class="mt-4">
                {{ $products->links('components.pagination.bootstrap5') }}
            </div>
            <div id="products"
                class="row {{ $currentView === 'grid' ? 'row-cols-3 row-cols-md-3' : 'row-cols-1' }} gap-0 row-gap-1 d-flex">


                @foreach ($products as $product)
                    @include('components.catalog.item', ['product' => $product])
                @endforeach
            </div>
        </div>
    </div>


@endsection