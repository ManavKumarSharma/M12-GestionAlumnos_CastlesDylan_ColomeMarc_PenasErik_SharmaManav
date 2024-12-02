window.onload = function () {
    const select= document.getElementById('resutls_form');

    select.addEventListener('change', function () {
        this.form.submit();
    })
}