document.addEventListener('DOMContentLoaded', function () {
    maxInputsCounter();
    beadsAmountAddColorChoosers();
    displayShippingAddressFields();
    var shippingAddressCheckbox = document.getElementById('invoice_is_not_shipping');
    if (shippingAddressCheckbox) {
        shippingAddressCheckbox.addEventListener('change', function () {
            displayShippingAddressFields();
        });
    }
});


function maxInputsCounter() {
    var inputsWithMaxLength = document.querySelectorAll("input[maxlength]");
    inputsWithMaxLength.forEach(function (inputWithMaxLength) {
        var counterEl = inputWithMaxLength.parentNode.querySelector('.input-group-text');
        if (counterEl) {
            inputWithMaxLength.addEventListener('input', function () {
                counterEl.innerHTML = inputWithMaxLength.value.length + '/10'
            });
        }
    });
}

function beadsAmountAddColorChoosers() {
    var beadsAmountElements = document.querySelectorAll('input[name="beadsAmount"]');
    beadsAmountElements.forEach(function (amountEl) {
        amountEl.addEventListener('change', function () {
            var beadsAmount = beadsAmountElements.length;
            if (document.querySelector('input[name="beadsAmount"]:checked')) {
                beadsAmount = document.querySelector('input[name="beadsAmount"]:checked').value;
            }

            var colorChoosersContainer = document.getElementById('beadsAmountColors');
            var allChoosers = colorChoosersContainer.querySelectorAll('.colorChooser');

            allChoosers.forEach(function (chooser, index) {
                if (index + 1 <= beadsAmount) {
                    // Show this color chooser
                    chooser.style.display = 'block';
                } else {
                    chooser.style.display = 'none';
                }
            });

        });
    });
}

function displayShippingAddressFields() {
    var checkbox = document.getElementById('invoice_is_not_shipping');
    var shippingAddressContainer = document.getElementById('shipping_address');
    if (!checkbox || !shippingAddressContainer) {
        return;
    }

    if (checkbox.checked) {
        if (shippingAddressContainer.querySelector('[name="shipping_first_name"]').value === '') {
            shippingAddressContainer.querySelector('[name="shipping_first_name"]').value = document.querySelector('[name="invoice_first_name"]').value;
        }
        if (shippingAddressContainer.querySelector('[name="shipping_last_name"]').value === '') {
            shippingAddressContainer.querySelector('[name="shipping_last_name"]').value = document.querySelector('[name="invoice_last_name"]').value;
        }
        if (shippingAddressContainer.querySelector('[name="shipping_company_name"]').value === '') {
            shippingAddressContainer.querySelector('[name="shipping_company_name"]').value = document.querySelector('[name="invoice_company_name"]').value;
        }
        if (shippingAddressContainer.querySelector('[name="shipping_country"]').value === '') {
            shippingAddressContainer.querySelector('[name="shipping_country"]').value = document.querySelector('[name="invoice_country"]').value;
        }
        if (shippingAddressContainer.querySelector('[name="shipping_street"]').value === '') {
            shippingAddressContainer.querySelector('[name="shipping_street"]').value = document.querySelector('[name="invoice_street"]').value;
        }
        if (shippingAddressContainer.querySelector('[name="shipping_house_number"]').value === '') {
            shippingAddressContainer.querySelector('[name="shipping_house_number"]').value = document.querySelector('[name="invoice_house_number"]').value;
        }
        if (shippingAddressContainer.querySelector('[name="shipping_house_number_ext"]').value === '') {
            shippingAddressContainer.querySelector('[name="shipping_house_number_ext"]').value = document.querySelector('[name="invoice_house_number_ext"]').value;
        }
        if (shippingAddressContainer.querySelector('[name="shipping_postal_code"]').value === '') {
            shippingAddressContainer.querySelector('[name="shipping_postal_code"]').value = document.querySelector('[name="invoice_postal_code"]').value;
        }
        if (shippingAddressContainer.querySelector('[name="shipping_city"]').value === '') {
            shippingAddressContainer.querySelector('[name="shipping_city"]').value = document.querySelector('[name="invoice_city"]').value;
        }
        if (shippingAddressContainer.querySelector('[name="shipping_phone"]').value === '') {
            shippingAddressContainer.querySelector('[name="shipping_phone"]').value = document.querySelector('[name="invoice_phone"]').value;
        }
        if (shippingAddressContainer.querySelector('[name="shipping_email"]').value === '') {
            shippingAddressContainer.querySelector('[name="shipping_email"]').value = document.querySelector('[name="invoice_email"]').value;
        }
        shippingAddressContainer.classList.remove('d-none');
    } else {
        shippingAddressContainer.classList.add('d-none');
    }
}
