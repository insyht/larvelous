document.addEventListener('DOMContentLoaded', function () {
    maxInputsCounter();
    beadsAmountAddColorChoosers();
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
