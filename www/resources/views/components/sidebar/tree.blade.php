@foreach ($groups as $group)
    <div
        class="list-group-item d-flex justify-content-between align-items-center btn btn-primary{{ in_array($group->id, $path) ? ' active' : '' }}">
        <a href="/group/{{ $group->id }}?{{ http_build_query(request()->query()) }}" class="text-decoration-none flex-grow-1 text-reset">
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

    @if (in_array($group->id, $path))
        <div class="ms-4 gap-2 list-group shadow-sm">
            <x-sidebar.tree :groups="$group->children" :parent="$group" :path="$path" />
        </div>
    @endif
@endforeach