<div 
    onclick="window.open('https://wa.me/6281337899451?text=Halo%20Admin%20Aku%20Dev,%20saya%20ingin%20bertanya', '_blank')"
    class="fixed bottom-8 right-6 z-10 
           w-[78px] h-[78px] 
           bg-green-500 
           rounded-full 
           flex items-center justify-center 
           cursor-pointer
           shadow-lg
           hover:scale-110 hover:bg-green-600
           transition-all duration-300">

    <img src="{{ asset('images/whatsapp.png') }}" 
         class="w-[40px] h-[40px] object-contain" 
         alt="WhatsApp">
</div>
<footer class="bg-[#0F172A] text-white pt-[80px] pb-8">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-12 gap-8">

            <div class="col-span-12 md:col-span-4">
                <img src="/images/aku_dev_logo-removebg-preview.png" alt="" class="w-[100px]">
                <h3 class="text-xl font-lumanosimo font-semibold mb-4">Dari Nol Jadi Developer Handal</h3>
            </div>

            <div class="col-span-6 md:col-span-2">
                <h4 class="text-sm font-bitter font-semibold mb-4">Link</h4>
                <ul class="space-y-2 text-sm opacity-80">
                    <li><a href="{{ route('welcome') }}" class="font-montserrat hover:opacity-100">Home</a></li>
                    <li><a href="{{ route('materials.index') }}" class="font-montserrat hover:opacity-100">Belajar</a></li>
                    <li><a href="{{ route('badges.index') }}" class="font-montserrat hover:opacity-100">Badge</a></li>
                    <li><a href="{{ route('about') }}" class="font-montserrat hover:opacity-100">About Us</a></li>
                </ul>
            </div>

            <div class="col-span-6 md:col-span-2">
                <h4 class="text-sm font-bitter font-semibold mb-4">Our Contact</h4>
                <ul class="space-y-2 text-sm opacity-80">
                    <li><a href="https://wa.me/6285855550057/" target="_blank" class="font-montserrat hover:opacity-100">No. +62 858-5555-0057</a></li>
                    <li><a href="#" class="font-montserrat hover:opacity-100">Email: akudev@gmail.com</a></li>
                    <li><a href="#" class="font-montserrat hover:opacity-100">Instagram: AkuDev_</a></li>
                </ul>
            </div>

            <div class="col-span-12 md:col-span-4">
                <h4 class="text-sm font-bitter font-semibold mb-4">Our Location</h4>
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d246.9950363968931!2d112.58121981308561!3d-7.903365759255451!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sid!2sid!4v1769363353465!5m2!1sid!2sid" width="300" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

        </div>
        <div class="border-t border-white/10 mt-12 pt-6 text-center text-sm opacity-70">
            © 2026 Aku Dev. All rights reserved.
        </div>
    </div>
</footer>
