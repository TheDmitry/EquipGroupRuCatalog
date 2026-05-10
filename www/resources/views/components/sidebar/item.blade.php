<div class="list-group-item d-flex justify-content-between align-items-center btn btn-primary">
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