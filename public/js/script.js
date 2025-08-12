document.querySelectorAll('.has-dropdown').forEach(item => {
    item.addEventListener('mouseenter', () => {
        item.querySelector('.dropdown').style.display = 'block';
    });
    item.addEventListener('mouseleave', () => {
        item.querySelector('.dropdown').style.display = 'none';
    });
});

function showSearch() {
    const term = prompt("Masukkan kata kunci pencarian:");
    if (term) {
        alert("Anda mencari: " + term);
    }
}
