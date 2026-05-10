document.addEventListener('DOMContentLoaded', function () {

    const listBtn = document.getElementById('viewList');
    const gridBtn = document.getElementById('viewGrid');
    const container = document.getElementById('products');

    const saved = localStorage.getItem('view') || 'list';
    applyMode(saved);

    listBtn.addEventListener('click', () => applyMode('list'));
    gridBtn.addEventListener('click', () => applyMode('grid'));

    function applyMode(mode) {
        localStorage.setItem('view', mode);

        if (mode === 'grid') {
            container.classList.remove('row-cols-1');
            container.classList.add('row-cols-2', 'row-cols-md-3');

            gridBtn.checked = true;
        } else {
            container.classList.remove('row-cols-2', 'row-cols-md-3');
            container.classList.add('row-cols-1');

            listBtn.checked = true;
        }

        const url = new URL(window.location);
        url.searchParams.set('view', mode);
        window.history.replaceState({}, '', url);
    }

});