<x-layout>

    <section class="bg-slate-300 text-white py-16 text-center">
        <div class="container mx-auto">
            <h2 class="text-4xl font-bold mb-4">Support & Help Center</h2>
            <p class="text-xl mb-6">We're here to assist you with any questions or issues you may have regarding our platform.</p>
            <a href="#faq" class="bg-yellow-500 text-gray-900 px-6 py-3 rounded-lg text-lg font-semibold hover:bg-yellow-400 transition-all">Find Answers in Our FAQ</a>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="container mx-auto py-12">
        <h2 class="text-3xl font-semibold text-center mb-6">Frequently Asked Questions (FAQ)</h2>
        <div class="space-y-6">
            <!-- FAQ Item 1 -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold mb-2">How do I sign up for My Crypto App?</h3>
                <p class="text-gray-500">You can sign up by clicking the "Sign Up" button on the homepage. After entering your details, you'll receive a confirmation email to activate your account.</p>
            </div>
            <!-- FAQ Item 2 -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold mb-2">How can I secure my account?</h3>
                <p class="text-gray-500">We recommend using two-factor authentication (2FA) to secure your account. Additionally, make sure to use a strong password and avoid sharing your credentials.</p>
            </div>
            <!-- FAQ Item 3 -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold mb-2">How do I deposit cryptocurrency into my wallet?</h3>
                <p class="text-gray-500">Go to your wallet section, select "Deposit", and choose the cryptocurrency you'd like to deposit. Follow the instructions to generate a deposit address.</p>
            </div>
            <!-- FAQ Item 4 -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold mb-2">What fees are associated with trading?</h3>
                <p class="text-gray-500">Our platform charges a small fee for each trade. The exact fee depends on the trade size and the cryptocurrency pair being traded. You can find more details in the "Fees" section of our site.</p>
            </div>
            <!-- FAQ Item 5 -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold mb-2">How do I withdraw my cryptocurrency?</h3>
                <p class="text-gray-500">To withdraw, go to your wallet section, click "Withdraw", and enter the destination wallet address. Follow the prompts to complete your withdrawal.</p>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="bg-gray-50 py-12">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-semibold mb-6">Need Further Assistance?</h2>
            <p class="text-xl mb-6">If you have any other questions or need help, feel free to contact our support team. We’re here to help!</p>
            <form action="#" method="POST" class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="col-span-1">
                        <label for="name" class="block text-lg font-semibold">Full Name</label>
                        <input type="text" id="name" name="name" class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                    </div>
                    <div class="col-span-1">
                        <label for="email" class="block text-lg font-semibold">Email Address</label>
                        <input type="email" id="email" name="email" class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                    </div>
                </div>
                <div class="mt-6">
                    <label for="message" class="block text-lg font-semibold">Your Message</label>
                    <textarea id="message" name="message" rows="6" class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required></textarea>
                </div>
                <button type="submit" class="mt-6 bg-blue-600 text-white px-6 py-3 rounded-lg text-lg font-semibold hover:bg-blue-500 transition-all">Send Message</button>
            </form>
        </div>
    </section>
 </x-layout>