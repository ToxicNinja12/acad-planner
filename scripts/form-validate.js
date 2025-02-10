const errorEls = document.getElementsByClassName('show-error');

for (let i = 0; i < errorEls.length; i++) {
    addErrorMsg(errorEls[i].previousElementSibling, errorEls[i]);
}

function addErrorMsg(input, errorMsg) {
    input.classList.add('placeholder-shown:border-red-500', 'placeholder-shown:focus:border-gray-300', 'placeholder-shown:focus:ring-red-500');
    errorMsg.classList.remove('invisible');

    input.addEventListener('input', () => {
        if (input.value === '') {
            errorMsg.classList.remove('invisible');
        } else {
            errorMsg.classList.add('invisible');
        }        
    });
}