document.addEventListener('DOMContentLoaded', () => {
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Modal functionality for cart
    const cartModal = document.getElementById('cart-modal');
    const closeCartBtn = document.getElementById('close-cart-btn');
    const cartItemsList = document.getElementById('cart-items');
    const cartTotalSpan = document.getElementById('cart-total');
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

    const cart = JSON.parse(localStorage.getItem('cart')) || [];

    const updateCartModal = () => {
        cartItemsList.innerHTML = '';
        let total = 0;
        cart.forEach(item => {
            const li = document.createElement('li');
            li.className = 'flex justify-between items-center';
            li.innerHTML = `
                <span>${item.name} x ${item.quantity}</span>
                <span>KSH ${item.price * item.quantity}</span>
            `;
            cartItemsList.appendChild(li);
            total += item.price * item.quantity;
        });
        cartTotalSpan.textContent = `KSH ${total.toLocaleString()}`;
    };

    const addToCart = (productName, productPrice) => {
        const existingItem = cart.find(item => item.name === productName);
        if (existingItem) {
            existingItem.quantity++;
        } else {
            cart.push({ name: productName, price: productPrice, quantity: 1 });
        }
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartModal();
    };

    addToCartButtons.forEach(button => {
        button.addEventListener('click', () => {
            // In a real application, you would check for user login here.
            // For now, we simulate a login check with a simple prompt.
            if (confirm('You must be logged in to add items to your cart. Do you want to proceed?')) {
                const productCard = button.closest('.product-card');
                const productName = productCard.querySelector('h3').textContent.trim();
                const productPriceText = productCard.querySelector('p.text-2xl').textContent.trim().replace('KSH ', '').replace(',', '');
                const productPrice = parseFloat(productPriceText);

                addToCart(productName, productPrice);
                cartModal.classList.remove('hidden');
            }
        });
    });

    if (closeCartBtn) {
        closeCartBtn.addEventListener('click', () => {
            cartModal.classList.add('hidden');
        });
    }

    // Dynamic text animation on the homepage
    const animatedTextElement = document.getElementById('animated-text');
    const phrases = [
        "Your trusted partner in fire safety and protection.",
        "We provide expert training and certification.",
        "We sell quality equipment and professional services to keep you safe."
    ];
    let currentPhraseIndex = 0;
    
    const animateText = () => {
        if (!animatedTextElement) return;

        // Fade out
        animatedTextElement.style.opacity = '0';

        // Wait for the fade out to complete, then change text and fade in
        setTimeout(() => {
            currentPhraseIndex = (currentPhraseIndex + 1) % phrases.length;
            animatedTextElement.textContent = phrases[currentPhraseIndex];
            animatedTextElement.style.opacity = '1';
        }, 1000); // This should match the CSS transition duration
    };

    if (animatedTextElement) {
        // Initial text display
        animatedTextElement.textContent = phrases[currentPhraseIndex];
        animatedTextElement.style.opacity = '1';
        // Start the animation loop
        setInterval(animateText, 5000); // Change text every 5 seconds
    }
});

// Redirect to services_and_equipment.php with a service parameter
document.querySelectorAll('a[href^="contact_page.php?service="]').forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        const serviceType = e.currentTarget.href.split('=')[1];
        window.location.href = `contact_page.php?service=${serviceType}`;
    });
});
