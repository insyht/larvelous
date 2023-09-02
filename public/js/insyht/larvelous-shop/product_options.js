document.addEventListener('DOMContentLoaded', function () {
    maxInputsCounter();
});

function triggerRelated(optionTitle, choiceTitle)
{
    document.querySelectorAll("[data-parent-option='" + optionTitle + "']").forEach(function (el) {
        if (el.getAttribute("data-parent-choice") <= parseInt(choiceTitle)) {
            el.style.display = 'block';
        } else {
            el.style.display = 'none';
        }
    });
}

function maxInputsCounter() {
    var inputsWithMaxLength = document.querySelectorAll("input[maxlength]");
    inputsWithMaxLength.forEach(function (inputWithMaxLength) {
        var counterEl = inputWithMaxLength.parentNode.querySelector('.input-group-text');
        if (counterEl) {
            inputWithMaxLength.addEventListener('input', function () {
                counterEl.innerHTML = inputWithMaxLength.value.length + '/' + inputWithMaxLength.getAttribute('maxlength');
            });
        }
    });
}
