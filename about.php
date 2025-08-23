<?php
include 'config.php';
include 'includes/header.php';
?>
<div class="container mx-auto p-4 md:p-8">
    <div class="bg-white rounded-xl shadow-2xl p-8 lg:p-12 text-center max-w-7xl mx-auto transform transition-all duration-300 hover:scale-103">
        <h1 class="text-4xl md:text-5xl font-extrabold text-blue-700 leading-tight mb-4">About Me</h1>
        
        <div class="prose max-w-none mx-auto text-gray-700 leading-relaxed text-lg md:text-xl text-left">
            <p>Hello there! I am <b><font color="blueviolet">Pappu Roy</font></b>, and I am a passionate and dedicated computer science graduate specializing in full-stack software development. This blog serves as a showcase of my foundational skills and my commitment to building clean, functional, and user-friendly web applications.</p>
            
            <p class="mt-6">This project is built from the ground up to demonstrate a full understanding of the web development stack:</p>
            
            <ul class="list-disc list-inside mt-4 text-left">
                <li><b>Backend:</b> Developed with <b>PHP</b> and <b>MySQL</b>, it features essential functionalities like user authentication and full CRUD (Create, Read, Update, Delete) capabilities. This proves my ability to handle server-side logic and database interactions.</li>
                <li><b>Frontend:</b> The design is crafted with a combination of <b>HTML</b> and <b>Tailwind CSS</b>. The responsive layout ensures a seamless user experience across all devices, from desktops to mobile phones.</li>
                <li><b>Tools:</b> The application uses a modern rich text editor (TinyMCE) to allow for dynamic and formatted content, showcasing my ability to integrate third-party libraries.</li>
            </ul>
        </div>
        
        <div class="mt-10 pt-6 border-t border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Connect with me</h2>
            <div class="flex justify-center space-x-6">
                <!-- LinkedIn -->
                <a href="https://www.linkedin.com/in/pappu-roy-6526192a1/" target="_blank" class="text-blue-600 hover:text-blue-800 transition-transform duration-300 transform hover:scale-125">
                    <i class="fab fa-linkedin fa-3x"></i>
                </a>
                <!-- GitHub -->
                <a href="https://github.com/Pappu-Roy" target="_blank" class="text-gray-800 hover:text-black transition-transform duration-300 transform hover:scale-125">
                    <i class="fab fa-github-square fa-3x"></i>
                </a>
                <!-- Facebook -->
                <a href="https://www.facebook.com/" target="_blank" class="text-blue-700 hover:text-blue-900 transition-transform duration-300 transform hover:scale-125">
                    <i class="fab fa-facebook-square fa-3x"></i>
                </a>
                <!-- Instagram -->
                <a href="https://www.instagram.com/" target="_blank" class="text-pink-600 hover:text-pink-800 transition-transform duration-300 transform hover:scale-125">
                    <i class="fab fa-instagram-square fa-3x"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<?php
include 'includes/footer.php';
?>
