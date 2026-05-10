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
                    <div class="list-group-item d-flex justify-content-between align-items-center
                            {{ $parent->id === $group->id ? 'active' : '' }}">

                        <a href="/group/{{ $group->id }}" class="text-decoration-none flex-grow-1 text-reset">

                            <div>
                                <div class="fw-semibold">
                                    {{ $group->name }}
                                </div>

                                <small class="text-muted">
                                    Категория
                                </small>
                            </div>

                        </a>

                        <span class="badge bg-secondary rounded-pill fs-6 ms-2">
                            {{ $group->productsCount }}
                        </span>

                    </div>
                @endforeach

            </div>
        </div>

        <div class="col-8">
            <div class="container-fluid d-flex gap-2">
                @include('components.catalog.sort-dropdown')
                @include('components.pagination.settings')
                @include('components.catalog.style-settings')
            </div>
            <div class="mt-4">
                {{ $products->links('components.pagination.bootstrap5') }}
            </div>
            <div id="products"
                class="row {{ $view === 'grid' ? 'row-cols-3 row-cols-md-3' : 'row-cols-1' }} gap-0 row-gap-1 d-flex">


                @foreach ($products as $product)
                    @include('components.catalog.item', ['product' => $product])
                @endforeach
            </div>
        </div>
    </div>


@endsection