<div class="list-group-item p-2">

    <div class="d-flex justify-content-between align-items-center">

        <a href="/group/{{ $group->id }}" class="text-decoration-none flex-grow-1 text-reset">

            <div class="fw-semibold">
                {{ $group->name }}
            </div>

            <small class="text-muted">
                Категория
            </small>
        </a>

        <span class="badge bg-secondary rounded-pill ms-2">
            {{ $group->productsCount ?? 0 }}
        </span>

    </div>

    @if ($group->children && $group->children->count())
        <div class="ms-3 mt-1 border-start ps-2">

            @foreach ($group->children as $child)
                @include('components.group-node', [
                    'group' => $child
                ])
            @endforeach

            </div>
    @endif

</div>