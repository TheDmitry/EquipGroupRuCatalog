<div class="dropdown">
    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
        aria-expanded="false">
        Показать: {{ request('pagesize', 12) }}
    </button>

    <ul class="dropdown-menu">

        <li>
            <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['pagesize' => 6]) }}">
                6
            </a>
        </li>

        <li>
            <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['pagesize' => 12]) }}">
                12
            </a>
        </li>

        <li>
            <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['pagesize' => 18]) }}">
                18
            </a>
        </li>

    </ul>
</div>