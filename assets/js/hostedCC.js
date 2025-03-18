function getApexNextButton()
{
    let button = null;

    let result = document.querySelectorAll("BUTTON.btn.btn-highlight.btn-lg.w-100");
    if (result.length === 1) {
        button = result[0];
    } else {
        for (var i = 0; i < result.length; i++) {
            button = result[i];
            break;
        }
    }

    return button;
}

async function mollieHandlePaymentForm(e)
{
    var paymentForm = document.getElementById('payment');
    if (paymentForm.elements['payment_molliecreditcard'].checked === true) {
        e.preventDefault();

        const { token, error } = await mollie.createToken();
        if(error !== undefined) {
            document.getElementById('mollieCreditcardError').innerHTML = error.message;
            document.getElementById('mollieCreditcardErrorbox').style.display = '';
        } else {
            document.getElementById('mollieCreditcardError').innerHTML = '';
            document.getElementById('mollieCreditcardErrorbox').style.display = 'none';
            document.getElementById("mollieCCToken").value = token;

            paymentForm.submit();
        }
    } else {
        // default behaviour
        paymentForm.submit();
    }
}

function mollieHandleCreditcardRadioChange(e)
{
    if (e.target.id === "payment_molliecreditcard" && e.target.checked === true) {
        mollieApexAddEvents();
    } else {
        mollieApexRevertEvents();
    }
}

function mollieApexAddEventToRadioButtons()
{
    let result = document.querySelectorAll('INPUT[type=radio][name=paymentid]');
    if (result.length > 0) {
        for (var i = 0; i < result.length; i++) {
            result[i].addEventListener('change', mollieHandleCreditcardRadioChange);
        }
    }

    // Check if Mollie Creditcard is already selected
    let elemCCRadio = document.getElementById('payment_molliecreditcard');
    if (elemCCRadio && elemCCRadio.checked === true) {
        mollieApexAddEvents();
    }
}

function mollieGetSubmitButtonClone(createAllowed)
{
    let clone = document.getElementById('mollie_creditcard_submit');
    let button = getApexNextButton();
    if (clone === null && button !== null && createAllowed === true) {
        clone = button.cloneNode(true);
        clone.setAttribute('id', 'mollie_creditcard_submit');

        clone.onclick = null; // remove on click event from button and add an extended on click event which also submits the form
        clone.removeAttribute("onclick");
        clone.addEventListener('click', mollieHandlePaymentForm);

        button.after(clone);
    }
    return clone;
}

function mollieApexAddEvents()
{
    let button = getApexNextButton();
    if (button !== null) {
        let clone = mollieGetSubmitButtonClone(true);

        clone.style.display = '';
        button.style.display = 'none';

        let paymentForm = document.getElementById('payment');
        paymentForm.addEventListener('submit', mollieHandlePaymentForm);
    }
}

function mollieApexRevertEvents()
{
    let button = getApexNextButton();
    if (button !== null) {
        let clone = mollieGetSubmitButtonClone(false);
        if (clone !== null) {
            clone.style.display = 'none';
            button.style.display = '';
        }

        let paymentForm = document.getElementById('payment');
        paymentForm.removeEventListener('submit', mollieHandlePaymentForm);
    }
}
