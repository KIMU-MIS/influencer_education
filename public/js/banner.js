document.addEventListener('DOMContentLoaded', function () {
    const banners = document.querySelectorAll('.banner-image');
    let currentIndex = 0;

    function showNextBanner() {
        banners.forEach(img => img.style.display = 'none');
        currentIndex = (currentIndex + 1) % banners.length;
        banners[currentIndex].style.display = 'block';
    }

    if (banners.length > 1) {
        setInterval(showNextBanner, 3000);
    }
});
