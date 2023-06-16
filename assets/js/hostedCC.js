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

function mollieApexAddEventToNextButton()
{
    let button = null;

    let result = document.querySelectorAll("button.btn.btn-highlight.btn-lg.w-100");
    if (result.length === 1 && result[0].onclick !== null) {
        button = result[0];
    } else {
        for (var i = 0; i < result.length; i++) {
            if(result[i].onclick !== null) {
                button = result[i];
                break;
            }
        }
    }

    if (button !== null) {
        button.onclick = null; // remove on click event from button and add an extended on click event which also submits the form
        button.addEventListener('click', async e => {
            mollieHandlePaymentForm(e);
        });
    }
}
