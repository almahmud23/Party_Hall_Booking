/* script.js */
document.addEventListener("DOMContentLoaded", function () {
    let images = document.querySelectorAll(".slideshow img");
    let currentIndex = 0;

    function showNextImage() {
        images.forEach(img => img.classList.remove("active"));
        images[currentIndex].classList.add("active");
        currentIndex = (currentIndex + 1) % images.length;
    }

    setInterval(showNextImage, 3000);
    images[0].classList.add("active");
});

document.getElementById("bookingForm").addEventListener("submit", async function (event) {
    event.preventDefault();
    
    let formData = {
        name: document.getElementById("name").value,
        email: document.getElementById("email").value,
        phone: document.getElementById("phone").value,
        partyType: document.getElementById("partyType").value,
        date: document.getElementById("date").value,
        message: document.getElementById("message").value
    };

    try {
        let response = await fetch("save_booking.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(formData)
        });

        let result = await response.json();
        alert(result.message);
    } catch (error) {
        console.error("Error:", error);
    }
});

