@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-2">
            <div class="list-group shadow-sm">
                @foreach ($groups as $group)
                    <a href="/group/{{ $group->id }}" class="list-group-item list-group-item-action">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <div class="fw-semibold">
                                    {{ $group->name }}
                                </div>

                                <small class="text-muted">
                                    Категория
                                </small>
                            </div>

                            <span class="badge bg-secondary rounded-pill fs-6">
                                {{ $group->productsCount }}
                            </span>

                        </div>

                    </a>
                @endforeach
            </div>
        </div>

        <div class="col-8">
            <div class="row row-cols-1 gap-0 row-gap-1 d-flex">

                <div class="container-fluid d-flex gap-2">
                    @include('components.sort-dropdown')
                    @include('components.pagination-settings')
                </div>

                <div class="mt-4">
                    {{ $products->links('components.pagination') }}
                </div>
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