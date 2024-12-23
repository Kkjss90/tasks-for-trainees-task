document.getElementById('showUploadForm').addEventListener('click', function() {
    let form = document.getElementById('formContainer');

    if (form.style.display === 'block') {
        form.style.display = 'none';
    } else {
        form.style.display = 'block';
    }
});
