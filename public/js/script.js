document.addEventListener('DOMContentLoaded', function() {
    var dropdowns = document.getElementsByClassName('dropdown');

    Array.prototype.forEach.call(dropdowns, function(dropdown) {
        dropdown.addEventListener('click', function() {
            var dropdownContent = this.querySelector('.dropdown-content');
            dropdownContent.style.display = (dropdownContent.style.display === 'block') ? 'none' : 'block';
        });
    });

    document.addEventListener('click', function(event) {
        var target = event.target;
        if (!target.matches('.dropdown') && !target.matches('.dropdown-content')) {
            Array.prototype.forEach.call(dropdowns, function(dropdown) {
                dropdown.querySelector('.dropdown-content').style.display = 'none';
            });
        }
    });
});

