document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.item').forEach(function (element) {
        element.addEventListener('click', function () {
            const path = element.dataset.path;
            const action = confirm("Нажмите 'ОК' для просмотра или 'Отмена' для редактирования.");
            if (action) {
                window.location.href = `pages/view.php?path=${encodeURIComponent(path)}`;
            } else {
                window.location.href = `pages/edit.php?path=${encodeURIComponent(path)}`;
            }
        });
    });
});

