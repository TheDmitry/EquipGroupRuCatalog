@extends('layouts.base')

@section('content')
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                @foreach ($breadcrumbs as $breadcrumbId)
                    @php $breadcrumbGroup = \App\Models\Group::find($breadcrumbId); @endphp
                    <li class="breadcrumb-item">
                        @if ($breadcrumbId === $product->group->id)
                            {{ $breadcrumbGroup->name }}
                        @else
                            <a href="/group/{{ $breadcrumbId }}">{{ $breadcrumbGroup->name }}</a>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>

        <div class="card">
            <div class="card-body">
                <h1 class="card-title">{{ $product->name }}</h1>
                @if ($product->price)
                    <p class="card-text fs-4 text-primary">{{ $product->formatted_price }}</p>
                @else
                    <p class="card-text">Цена не указана</p>
                @endif
            </div>
        </div>
    </div>
@endsection

