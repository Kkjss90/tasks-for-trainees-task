document.addEventListener('DOMContentLoaded', () => {
    document.body.addEventListener('click', function (event) {
        const target = event.target.closest('.dir');
        if (target) {
            const path = target.getAttribute('data-path');

            const form = document.createElement("form");
            form.method = "POST";
            form.action = "showDirectory.php";

            const input = document.createElement("input");
            input.type = "hidden";
            input.name = "path";
            input.value = path;
            form.appendChild(input);

            document.body.appendChild(form);
            form.submit();
        }
    });
});
