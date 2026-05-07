<div class="dropdown">
    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
        aria-expanded="false">
        @if (request('sort', 'name') === 'name')
            Название
        @else
            Цена
        @endif
        @if (request('direction', 'asc') === 'asc')
            ↑
        @else
            ↓
        @endif
    </button>

    <ul class="dropdown-menu">
        <li>
            <a class="dropdown-item" href="{{ request()->fullUrlWithQuery([
    'sort' => 'name',
    'direction' => 'asc'
]) }}">
                Название ↑
            </a>
        </li>

        <li>
            <a class="dropdown-item" href="{{ request()->fullUrlWithQuery([
    'sort' => 'name',
    'direction' => 'desc'
]) }}">
                Название ↓
            </a>
        </li>

        <li>
            <hr class="dropdown-divider">
        </li>

        <li>
            <a class="dropdown-item" href="{{ request()->fullUrlWithQuery([
    'sort' => 'price',
    'direction' => 'asc'
]) }}">
                Цена ↑
            </a>
        </li>

        <li>
            <a class="dropdown-item" href="{{ request()->fullUrlWithQuery([
    'sort' => 'price',
    'direction' => 'desc'
]) }}">
                Цена ↓
            </a>
        </li>
    </ul>
</div>