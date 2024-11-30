document.addEventListener("DOMContentLoaded", function () {
    var stripe = Stripe(stripePublishableKey);
    var elements = stripe.elements();

    var card = elements.create("card");
    card.mount("#card-element");

    card.on("change", function (event) {
        var displayError = document.getElementById("card-errors");
        displayError.textContent = event.error ? event.error.message : "";
    });

    var form = document.getElementById("payment-form");
    form.addEventListener("submit", function (event) {
        event.preventDefault();

        stripe.createToken(card).then(function (result) {
            if (result.error) {
                document.getElementById("card-errors").textContent =
                    result.error.message;
            } else {
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        var form = document.getElementById("payment-form");
        var hiddenInput = document.createElement("input");
        hiddenInput.type = "hidden";
        hiddenInput.name = "stripeToken";
        hiddenInput.value = token.id;
        form.appendChild(hiddenInput);

        form.submit();
    }
});
