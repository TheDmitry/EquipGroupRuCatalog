@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-4">
            <ul>
                @foreach ($groups as $group)
                    <li>
                        <a href="/group/{{ $group->id }}">
                            {{ $group->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="col-8 container">
            <div class="row row-cols-2">
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