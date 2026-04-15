function toggleDescription(id, btn) {
    const el = document.getElementById('desc-' + id);

    if (el.classList.contains('expanded')) {
        el.classList.remove('expanded');
        btn.innerText = 'показать больше';
    } else {
        el.classList.add('expanded');
        btn.innerText = 'свернуть';
    }
}