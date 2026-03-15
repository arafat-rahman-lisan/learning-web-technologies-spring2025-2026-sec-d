const unitPrice = 500;

const quantityInput = document.getElementById("quantity");
const totalPriceInput = document.getElementById("totalPrice");
const errorMsg = document.getElementById("errorMsg");
let couponShown = false;

function updateTotalPrice()
 {
    let quantity = parseInt(quantityInput.value);

    if (isNaN(quantity)) 
        {
        quantity = 0;
    }
    if (quantity < 0) 
    {
        errorMsg.textContent = "Quantity cannot be less than 0.";
        quantity = 0;
        quantityInput.value = 0;
    } else 
{
        errorMsg.textContent = "";
    }

    const total = unitPrice * quantity;
    totalPriceInput.value = total;

    if (total > 1500 && !couponShown) 
    {
        alert("You are now eligible for a gift coupon!");
        couponShown = true;
    }

    if (total <= 1500)
 {
        couponShown = false;
    }
}

quantityInput.addEventListener("input", updateTotalPrice);
updateTotalPrice();