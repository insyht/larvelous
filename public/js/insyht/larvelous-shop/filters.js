function applyFilter(type, identifier, attributeId) {
    if (type === 'range') {
        var ranges = document.getElementById(identifier).querySelectorAll("input[type=range]");
        var filterUrl = '';
        var prefix = '?';
        ranges.forEach(function (rangeEl) {
            if (filterUrl.length > 0) {
                prefix = '&';
            }
           filterUrl += prefix + attributeId + "[]=" + encodeURIComponent(rangeEl.value);
        });
    } else if (type === 'text') {
        filterUrl = '?' + attributeId + "=" + encodeURIComponent(identifier.innerHTML.trim());
    }

    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch('filter' + filterUrl, {method: 'POST', headers: {'X-CSRF-TOKEN': csrfToken}})
        .then(response => response.text())
        .then(redirectUrl => window.location.replace(redirectUrl));
}

function removeFilter(attributeId) {
    filterUrl = '?' + attributeId;
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('filter' + filterUrl, {method: 'DELETE', headers: {'X-CSRF-TOKEN': csrfToken}})
        .then(response => response.text())
        .then(redirectUrl => window.location.replace(redirectUrl));
}
