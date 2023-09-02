function addToCart(button)
{
    var amount = button.parentNode.querySelector('input[name="amount"]').value;
    var productId = button.getAttribute('data-product-id');
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(
        'add-to-cart',
        {
            method: 'POST',
            headers: {'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json', "X-Requested-With": "XMLHttpRequest"},
            body: JSON.stringify({productId: productId, amount: amount})
        }
    ).then(reload => window.location.replace(window.location.href));
}
