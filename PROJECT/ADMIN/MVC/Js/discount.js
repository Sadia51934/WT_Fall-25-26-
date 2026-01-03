const discountCard = document.getElementById("discount-card");

function goToPage() {
    window.location.href = "../php/discount.php";
}

discountCard.addEventListener("click", goToPage);
