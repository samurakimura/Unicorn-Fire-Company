<?php
include 'header.php';
?>

<main class="relative w-full h-screen">
    <div class="absolute inset-0 z-0">
        <img src="assets/images/Gemini_Generated_Image_pc09f6pc09f6pc09.png" alt="Fire safety equipment" class="w-full h-full object-cover">
    </div>

    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white bg-black bg-opacity-50 p-4">
        <div class="max-w-4xl px-4">
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6 drop-shadow-lg">Unicon Fire Company</h1>
            <div class="h-24 sm:h-32 md:h-40 flex items-center justify-center mb-8">
                <!-- The JavaScript will dynamically insert and animate the phrases here -->
                <p id="animated-text" class="text-xl sm:text-2xl md:text-3xl font-light italic transition-opacity duration-1000 ease-in-out"></p>
            </div>
            <a href="services_and_equipment.php" class="bg-blue-600 text-white font-bold py-4 px-10 rounded-full hover:bg-blue-700 transition-colors duration-300 transform hover:scale-105 shadow-lg animate-bounceIn">Purchase Our Products</a>
        </div>
    </div>
</main>

<?php
include 'footer.php';
?>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const phrases = [
            "Your trusted partner in fire safety and protection.",
            "We provide expert training and certification.",
            "We sell quality equipment and professional services to keep you safe."
        ];
        const animatedTextElement = document.getElementById("animated-text");
        let currentPhraseIndex = 0;

        function animateText() {
            // Fade out the current phrase
            animatedTextElement.classList.add("opacity-0");

            setTimeout(() => {
                // Update the text to the next phrase
                currentPhraseIndex = (currentPhraseIndex + 1) % phrases.length;
                animatedTextElement.textContent = phrases[currentPhraseIndex];

                // Fade in the new phrase
                animatedTextElement.classList.remove("opacity-0");
            }, 1000); // Wait for the fade-out transition to complete
        }

        // Set the initial text
        animatedTextElement.textContent = phrases[currentPhraseIndex];
        animatedTextElement.classList.remove("opacity-0");

        // Start the animation loop
        setInterval(animateText, 5000); // Change text every 5 seconds
    });
</script>
