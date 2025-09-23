<?php
include 'header.php';

// Get the item or service from the URL parameter
$item = $_GET['item'] ?? null;
$service = $_GET['service'] ?? null;

// Determine the form title and description
$form_title = "Send Us a Message";
$form_description = "Please fill out the form below to get in touch with our team. We'll get back to you as soon as possible.";

$is_extinguisher_request = false;
$is_exit_sign_request = false;
$preselected_item = '';

if ($item) {
    $preselected_item = htmlspecialchars($item);
    $form_title = "Request a Quote for " . $preselected_item;
    $form_description = "Please provide your details and any specific requirements for this item. We'll prepare a custom quote for you.";
    // Check if the requested item is an extinguisher
    if (strpos(strtolower($preselected_item), 'extinguisher') !== false) {
        $is_extinguisher_request = true;
    }
    // Check if the requested item is an exit sign
    if (strpos(strtolower($preselected_item), 'exit sign') !== false) {
        $is_exit_sign_request = true;
    }
} elseif ($service) {
    $preselected_item = htmlspecialchars($service);
    $form_title = "Request for " . $preselected_item;
    $form_description = "Please provide your details and we'll contact you to discuss your needs.";
}
?>

<main class="container mx-auto px-4 py-8">
    <!-- Extinguisher Recommendation Form -->
    <div class="bg-white rounded-3xl shadow-xl p-8 lg:p-12 max-w-4xl mx-auto mt-12 animate-fadeIn">
        <h2 class="text-4xl font-bold text-center text-red-700 mb-6">Find the Right Extinguisher</h2>
        <p class="text-center text-gray-600 mb-10">Unsure what you need? Select the most likely fire hazard below and we'll recommend the right extinguisher for you.</p>

        <form id="recommendationForm" class="space-y-6">
            <div>
                <label for="hazard_type" class="block text-lg font-medium text-gray-700 mb-2">What is the main fire hazard in your area?</label>
                <select id="hazard_type" name="hazard_type" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 transition-all">
                    <option value="" disabled selected>Select a fire hazard</option>
                    <option value="Wood, Paper, and Textiles">Wood, Paper, and Textiles</option>
                    <option value="Flammable Liquids and Gases">Flammable Liquids and Gases (e.g., petrol, paint)</option>
                    <option value="Electrical Equipment">Electrical Equipment (e.g., computers, appliances)</option>
                    <option value="Cooking Oils and Fats">Cooking Oils and Fats</option>
                    <option value="Multiple Hazards">Multiple Hazards (e.g., an office with papers, electronics, and a small kitchen)</option>
                </select>
            </div>

            <div id="recommendation-result" class="hidden bg-gray-100 p-6 rounded-lg text-center border border-gray-300">
                <h3 class="text-2xl font-bold text-blue-800 mb-4">Our Recommendation:</h3>
                <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-8">
                    <img id="recommended-extinguisher-img" src="" alt="Recommended Extinguisher" class="w-24 h-24 object-contain">
                    <div>
                        <p id="recommended-extinguisher-name" class="text-xl font-semibold text-blue-800 mb-2"></p>
                        <p id="recommendation-description" class="text-gray-600 mb-4"></p>
                        <button type="button" onclick="purchaseRecommended()" class="mt-4 bg-red-600 text-white font-bold py-2 px-6 rounded-full hover:bg-red-700 transition-colors transform hover:scale-105 shadow-lg">Purchase Now</button>
                    </div>
                </div>
            </div>

            <div class="flex justify-center">
                <button type="button" onclick="handleRecommendation()" class="bg-red-600 text-white font-bold py-4 px-10 rounded-full hover:bg-red-700 transition-colors transform hover:scale-105 shadow-lg">Get Recommendation</button>
            </div>
        </form>
    </div>
    
    <div class="bg-white rounded-3xl shadow-xl p-8 lg:p-12 max-w-4xl mx-auto mt-12 animate-fadeIn">
        <!-- Main Contact Form -->
        <h2 id="form_title" class="text-4xl font-bold text-center text-red-700 mb-6"><?php echo $form_title; ?></h2>
        <p id="form_description" class="text-center text-gray-600 mb-10"><?php echo $form_description; ?></p>

        <form id="contactForm" class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="md:col-span-2">
                <label for="full_name" class="block text-lg font-medium text-gray-700 mb-2">Full Name</label>
                <input type="text" id="full_name" name="full_name" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 transition-all">
            </div>

            <div class="md:col-span-2">
                <label for="email" class="block text-lg font-medium text-gray-700 mb-2">Email Address</label>
                <input type="email" id="email" name="email" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 transition-all">
            </div>

            <div class="md:col-span-2">
                <label for="phone" class="block text-lg font-medium text-gray-700 mb-2">Phone Number</label>
                <input type="tel" id="phone" name="phone" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 transition-all">
            </div>

            <div class="md:col-span-2">
                <label for="item_service" class="block text-lg font-medium text-gray-700 mb-2">I am interested in...</label>
                <input type="text" id="item_service" name="item_service" value="<?php echo $preselected_item; ?>" readonly class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed">
            </div>

            <!-- Dynamic Fields for Extinguishers -->
            <div id="extinguisher_fields" class="md:col-span-2 <?php echo $is_extinguisher_request ? '' : 'hidden'; ?> grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <label for="extinguisher_size" class="block text-lg font-medium text-gray-700 mb-2">Size (in kg)</label>
                    <input type="text" id="extinguisher_size" name="extinguisher_size" placeholder="e.g., 2kg, 6kg, 9kg" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 transition-all">
                </div>
                <div>
                    <label for="extinguisher_purpose" class="block text-lg font-medium text-gray-700 mb-2">Purpose of Use</label>
                    <input type="text" id="extinguisher_purpose" name="extinguisher_purpose" placeholder="e.g., Home, Office, Vehicle" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 transition-all">
                </div>
                <div>
                    <label for="extinguisher_quantity" class="block text-lg font-medium text-gray-700 mb-2">Quantity</label>
                    <input type="number" id="extinguisher_quantity" name="extinguisher_quantity" min="1" value="1" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 transition-all">
                </div>
            </div>

            <!-- Dynamic Fields for Exit Signs -->
            <?php if ($is_exit_sign_request): ?>
            <div class="md:col-span-1">
                <label for="exit_sign_color" class="block text-lg font-medium text-gray-700 mb-2">Color</label>
                <select id="exit_sign_color" name="exit_sign_color" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 transition-all">
                    <option value="Green">Green</option>
                    <option value="Red">Red</option>
                </select>
            </div>
            <div class="md:col-span-1">
                <label for="exit_sign_quantity" class="block text-lg font-medium text-gray-700 mb-2">Quantity</label>
                <input type="number" id="exit_sign_quantity" name="exit_sign_quantity" min="1" value="1" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 transition-all">
            </div>
            <?php endif; ?>

            <div class="md:col-span-2">
                <label for="message" class="block text-lg font-medium text-gray-700 mb-2">Additional Details</label>
                <textarea id="message" name="message" rows="5" placeholder="Include any other questions or specifics..." class="w-full p-3 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 transition-all"></textarea>
            </div>
            
            <div class="md:col-span-2 flex justify-center space-x-4">
                <button type="button" onclick="handleFormSubmission('email')" class="bg-red-600 text-white font-bold py-4 px-10 rounded-full hover:bg-red-700 transition-colors transform hover:scale-105 shadow-lg">Send via Email</button>
                <button type="button" onclick="handleFormSubmission('whatsapp')" class="bg-blue-600 text-white font-bold py-4 px-10 rounded-full hover:bg-blue-700 transition-colors transform hover:scale-105 shadow-lg">Send via WhatsApp</button>
            </div>
        </form>
    </div>
</main>

<script>
    function handleFormSubmission(method) {
        const form = document.getElementById('contactForm');
        const fullName = form.full_name.value;
        const email = form.email.value;
        const phone = form.phone.value;
        const itemService = form.item_service.value;
        const message = form.message.value;
        
        if (!fullName || !email || !phone) {
            alert('Please fill in your Full Name, Email, and Phone Number.');
            return;
        }

        let body = `Hello Unicorn Fire Company,\n\nI am interested in the following item/service: ${itemService}.\n\nMy details are:\nName: ${fullName}\nEmail: ${email}\nPhone: ${phone}\n\n`;

        // Add dynamic fields if they exist
        const extinguisherSize = form.extinguisher_size ? form.extinguisher_size.value : '';
        const extinguisherPurpose = form.extinguisher_purpose ? form.extinguisher_purpose.value : '';
        const extinguisherQuantity = form.extinguisher_quantity ? form.extinguisher_quantity.value : '';
        const exitSignColor = form.exit_sign_color ? form.exit_sign_color.value : '';
        const exitSignQuantity = form.exit_sign_quantity ? form.exit_sign_quantity.value : '';

        if (extinguisherSize) {
            body += `Desired Extinguisher Size: ${extinguisherSize} kg\n`;
        }
        if (extinguisherPurpose) {
            body += `Extinguisher Purpose: ${extinguisherPurpose}\n`;
        }
        if (extinguisherQuantity) {
            body += `Desired Extinguisher Quantity: ${extinguisherQuantity}\n`;
        }
        if (exitSignColor) {
            body += `Desired Exit Sign Color: ${exitSignColor}\n`;
        }
        if (exitSignQuantity) {
            body += `Desired Exit Sign Quantity: ${exitSignQuantity}\n`;
        }
        if (message) {
            body += `\nAdditional Details:\n${message}`;
        }

        if (method === 'email') {
            const mailtoLink = `mailto:uniconfiresafety@gmail.com?subject=Enquiry about ${encodeURIComponent(itemService)}&body=${encodeURIComponent(body)}`;
            window.location.href = mailtoLink;
        } else if (method === 'whatsapp') {
            const whatsappLink = `https://api.whatsapp.com/send?phone=254747587236&text=${encodeURIComponent(body)}`;
            window.open(whatsappLink, '_blank');
        }
    }

    function handleRecommendation() {
        const hazardType = document.getElementById('hazard_type').value;
        const resultDiv = document.getElementById('recommendation-result');
        const extinguisherNameEl = document.getElementById('recommended-extinguisher-name');
        const extinguisherDescEl = document.getElementById('recommendation-description');
        const extinguisherImgEl = document.getElementById('recommended-extinguisher-img');

        let recommendation = {};
        switch (hazardType) {
            case 'Wood, Paper, and Textiles':
                recommendation = {
                    name: "Water Extinguisher",
                    description: "Best for Class A fires (solids). These are a safe and reliable choice for common office and home environments.",
                    image: "https://placehold.co/100x100/0000FF/FFFFFF?text=Water"
                };
                break;
            case 'Flammable Liquids and Gases':
                recommendation = {
                    name: "Foam Extinguisher",
                    description: "Effective on Class A and B fires. The foam creates a blanket that smothers the flames.",
                    image: "https://placehold.co/100x100/0000FF/FFFFFF?text=Foam"
                };
                break;
            case 'Electrical Equipment':
                recommendation = {
                    name: "Carbon Dioxide (CO2) Extinguisher",
                    description: "Ideal for Class B and electrical fires. It displaces oxygen and leaves no residue, protecting sensitive equipment.",
                    image: "https://placehold.co/100x100/0000FF/FFFFFF?text=CO2"
                };
                break;
            case 'Cooking Oils and Fats':
                recommendation = {
                    name: "Wet Chemical Extinguisher",
                    description: "Designed specifically for Class F fires, such as those involving cooking oils and fats in kitchens.",
                    image: "https://placehold.co/100x100/0000FF/FFFFFF?text=Wet+Chem"
                };
                break;
            case 'Multiple Hazards':
                recommendation = {
                    name: "Dry Chemical / Dry Powder Extinguisher",
                    description: "A versatile option for most fire types, including A, B, C, and electrical fires. A great all-purpose choice.",
                    image: "https://placehold.co/100x100/0000FF/FFFFFF?text=Dry+Powder"
                };
                break;
            default:
                resultDiv.classList.add('hidden');
                return;
        }
        
        extinguisherNameEl.textContent = recommendation.name;
        extinguisherDescEl.textContent = recommendation.description;
        extinguisherImgEl.src = recommendation.image;
        resultDiv.classList.remove('hidden');
    }

    function purchaseRecommended() {
        const recommendedName = document.getElementById('recommended-extinguisher-name').textContent;
        const form = document.getElementById('contactForm');
        
        // Update the form title and description
        document.getElementById('form_title').textContent = "Request a Quote for " + recommendedName;
        document.getElementById('form_description').textContent = "Please provide your details and any specific requirements for this item. We'll prepare a custom quote for you.";

        // Update the 'I am interested in...' field with the recommended product
        document.getElementById('item_service').value = recommendedName;
        
        // Make the extinguisher-specific fields visible
        document.getElementById('extinguisher_fields').classList.remove('hidden');

        // Scroll down to the contact form
        form.scrollIntoView({ behavior: 'smooth' });
    }
</script>

<?php
include 'footer.php';
?>
