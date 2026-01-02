const buyNowBtn = document.getElementById('buyNowBtn');

function goToBooksPage() {
    window.location.href = '../Control/booklist.php'; 
}
buyNowBtn.addEventListener('click', goToBooksPage);
