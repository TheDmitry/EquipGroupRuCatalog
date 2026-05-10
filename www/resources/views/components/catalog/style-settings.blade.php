@php
    $view = request('view', 'list') === 'list' ? 'list' : 'grid';
@endphp

<div class="btn-group" role="group">
    <input type="radio" class="btn-check" name="viewMode" id="viewList" autocomplete="off" {{ $view === 'list' ? 'checked' : '' }}>
    <label class="btn btn-outline-primary" for="viewList">Список</label>

    <input type="radio" class="btn-check" name="viewMode" id="viewGrid" autocomplete="off" {{ $view === 'list' ? 'grid' : '' }}>
    <label class="btn btn-outline-primary" for="viewGrid" >Сеткой</label>
</div>