document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.cl').forEach(function(closeButton) {
        closeButton.addEventListener('click', function() {
            this.closest('div').style.display = 'none';
        });
    });
});