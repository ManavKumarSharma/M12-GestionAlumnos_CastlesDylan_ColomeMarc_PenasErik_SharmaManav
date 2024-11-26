window.onload = function () {
    const select= document.getElementById('results');

    select.addEventListener('change', function () {
        this.form.submit();
    })
}