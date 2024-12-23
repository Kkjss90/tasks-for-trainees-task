document.querySelectorAll('.delete-button').forEach(button => {
    button.addEventListener('click', function () {
        const path = this.dataset.path;

        if (confirm(`Вы уверены, что хотите удалить ${path}?`)) {
            fetch('pages/delete.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({ path }),
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.result === 'success') {
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Ошибка:', error);
                    alert('Произошла ошибка при удалении ресурса.');
                });
        }
    });
});