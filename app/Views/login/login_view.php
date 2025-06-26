<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
        @keyframes bounce-slow {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes pulse-slow {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        .animate-bounce-slow {
            animation: bounce-slow 2s infinite;
        }

        .animate-pulse-slow {
            animation: pulse-slow 2.5s infinite;
        }

        @keyframes fadeUp {
            0% {
                opacity: 0;
                transform: translateY(40px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-up {
            opacity: 0;
            animation: fadeUp 1s ease-out forwards;
        }

        .fade-up-delay-1 {
            animation-delay: 0.3s;
        }

        .fade-up-delay-2 {
            animation-delay: 0.6s;
        }

        .fade-up-delay-3 {
            animation-delay: 0.9s;
        }

        [data-aos] {
            transition: all 0.6s ease-in-out;
        }
    </style>

</head>

<body class="bg-gradient-to-br from-blue-100 via-white to-blue-200 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">

    <!-- Navbar -->
    <nav id="navbar"
        class="bg-white/30 backdrop-blur-sm dark:bg-gray-900/30 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600 transition-all duration-300">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="<?= base_url('images/icons/full-load_4660830.png'); ?>" alt="Cuci Karpet & Selimut logo" class="h-8" alt="Logo">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">AL Laundry</span>
            </a>
            <!-- Menu yang berada di tengah -->
            <div class="items-center justify-between w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul id="navbar-menu"
                    class="flex space-x-4 md:space-x-8 p-0 font-medium transition-all duration-300 md:flex-row md:mt-0 backdrop-blur-sm bg-transparent">
                    <li><a href="javascript:void(0);" onclick="scrollToSection('home')"
                            class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white">Home</a>
                    </li>
                    <li><a href="javascript:void(0);" onclick="scrollToSection('about')"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:text-blue-700 md:p-0 dark:text-white">About</a>
                    </li>
                    <li><a href="javascript:void(0);" onclick="scrollToSection('services')"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:text-blue-700 md:p-0 dark:text-white">Services</a>
                    </li>
                    <li><a href="javascript:void(0);" onclick="scrollToSection('contact')"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:text-blue-700 md:p-0 dark:text-white">Contact</a>
                    </li>
                </ul>
                <!-- Tombol Login pindah ke sini -->
                <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                    class="ml-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">
                    Login
                </button>
            </div>


        </div>
    </nav>
    <div id="authentication-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Sign in to our platform
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="authentication-modal">
                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>

                <!-- Body -->
                <div class="p-4 md:p-5">
                    <form class="space-y-4" action="/login" method="POST">
                        <!-- Email -->
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="name@company.com" required />
                        </div>
                        <!-- Password -->
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                            <input type="password" name="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="••••••••" required />
                        </div>
                        <!-- Ingat saya -->
                        <div class="flex justify-between">
                            <div class="flex items-start">
                                <input id="remember" type="checkbox"
                                    class="w-4 h-4 border border-gray-300 rounded-sm bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" />
                                <label for="remember"
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
                            </div>
                            <a href="#" class="text-sm text-blue-700 hover:underline dark:text-blue-500">Lost Password?</a>
                        </div>
                        <!-- Submit -->
                        <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Login to your account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Sections -->
    <div class="pt-24 px-6 max-w-6xl mx-auto flex flex-col gap-16 min-h-screen">

        <!-- Home Section full width dengan sudut membulat -->
        <section id="home" class="px-4 pt-28">
            <div class="relative w-full h-[90vh] bg-cover bg-center bg-no-repeat rounded-3xl overflow-hidden"
                style="background-image: url('<?= base_url('images/bg2.jpg'); ?>');">

                <!-- Overlay -->
                <div class="absolute inset-0 bg-black/60"></div> <!-- Diperkuat agar teks lebih kontras -->

                <!-- Konten -->
                <div class="relative z-10 text-center py-32 px-4">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-yellow-300 mb-4 drop-shadow-lg" data-aos="fade-up" data-aos-delay="100">
                        Selamat Datang di <span class="text-cyan-300">AL Laundry</span>
                    </h1>
                    <p class="text-lg text-gray-200 drop-shadow-sm" data-aos="fade-up" data-aos-delay="300">
                        Solusi terbaik untuk kebutuhan laundry Anda – cepat, bersih, dan profesional.
                    </p>

                    <!-- Form Cek Transaksi -->
                    <form action="admin/hasil_cek" method="get" class="mt-8 max-w-xl mx-auto fade-up fade-up-delay-3">
                        <label for="id_transaksi" class="block mb-2 text-sm font-semibold text-white drop-shadow">
                            Cek Status Transaksi
                        </label>
                        <div class="flex flex-col sm:flex-row gap-2">
                            <input type="text" id="id_transaksi" name="id_transaksi"
                                class="w-full px-4 py-2 border border-white/50 bg-white/80 text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 placeholder-gray-600"
                                placeholder="Masukkan ID Transaksi (contoh: TRX202504300001)" required>
                            <button type="submit"
                                class="bg-cyan-600 text-white px-4 py-2 rounded-md hover:bg-cyan-700 transition duration-200">
                                Cek
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about"
            class="bg-gradient-to-br from-blue-50 via-white to-blue-100 dark:from-gray-800 dark:via-gray-900 dark:to-gray-800 px-6 py-12 text-center rounded-t-[4rem] rounded-b-[4rem] shadow-md relative overflow-hidden">

            <!-- Ikon Hiasan Kiri -->
            <img src="<?= base_url('images/icons/ironing-board_6974179.png'); ?>"
                class="absolute top-6 left-6 w-16 opacity-30 rotate-[-12deg] animate-bounce-slow"
                alt="Hiasan 1">

            <!-- Ikon Hiasan Kanan -->
            <img src="<?= base_url('images/icons/laundry-basket_10725113.png'); ?>"
                class="absolute bottom-6 right-6 w-16 opacity-30 rotate-[10deg] animate-pulse-slow"
                alt="Hiasan 2">

            <!-- Ikon Utama -->
            <img src="<?= base_url('images/icons/drying_3043352.png'); ?>"
                alt="Tentang Laundry"
                class="mx-auto mb-6 w-24 h-24 animate-pulse-slow">

            <h2 class="text-3xl font-bold mb-4 text-gray-900 dark:text-white" data-aos="fade-up">
                Tentang Layanan Laundry Kami
            </h2>

            <p class="text-gray-700 dark:text-gray-300 max-w-xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                AL Laundry adalah penyedia layanan laundry yang berdedikasi untuk memberikan hasil cucian bersih,
                wangi, dan rapi dengan layanan pelanggan terbaik. Kami mengutamakan kecepatan dan kualitas
                untuk memenuhi kebutuhan harian Anda.
            </p>
        </section>

        <!-- Services Section -->
        <section id="services" class="text-center scroll-mt-24">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4" data-aos="fade-up">Layanan Kami</h2>
            <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-3 mt-6">
                <!-- Service 1 -->
                <div class="p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md" data-aos="zoom-in" data-aos-delay="100">>
                    <img src="<?= base_url('images/icons/laundry-basket_10725113.png'); ?>" alt="Laundry Kiloan" class="w-16 h-16 mx-auto mb-4">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Laundry Kiloan</h3>
                    <p class="text-gray-600 dark:text-gray-300">Layanan laundry harian dengan harga terjangkau dan pengerjaan cepat.</p>
                </div>

                <!-- Service 2 -->
                <div class="p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md" data-aos="zoom-in" data-aos-delay="200">
                    <img src="<?= base_url('images/icons/ironing-board_6974179.png'); ?>" alt="Laundry Satuan" class="w-16 h-16 mx-auto mb-4">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Laundry Satuan</h3>
                    <p class="text-gray-600 dark:text-gray-300">Pencucian pakaian dengan metode khusus untuk menjaga kualitas kain.</p>
                </div>

                <!-- Service 3 -->
                <div class="p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md" data-aos="zoom-in" data-aos-delay="300">
                    <img src="<?= base_url('images/icons/household_1124583.png'); ?>" alt="Cuci Karpet & Selimut" class="w-16 h-16 mx-auto mb-4">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Cuci Karpet & Selimut</h3>
                    <p class="text-gray-600 dark:text-gray-300">Perawatan khusus untuk karpet dan selimut agar tetap bersih dan awet.</p>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="text-center scroll-mt-24">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4" data-aos="fade-up">Hubungi Kami</h2>
            <p class="text-gray-700 dark:text-gray-300 mb-6" data-aos="fade-up" data-aos-delay="100">
                Email: support@allaundry.com | Telp: +62 812-3456-7890
            </p>
            <form class="max-w-md mx-auto" action="/contact" method="POST" data-aos="fade-up" data-aos-delay="200">
                <input type="text" name="name" placeholder="Nama Anda"
                    class="w-full mb-3 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                <input type="email" name="email" placeholder="Email Anda"
                    class="w-full mb-3 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                <textarea name="message" rows="4" placeholder="Pesan Anda"
                    class="w-full mb-3 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition duration-200">Kirim
                    Pesan</button>
            </form>
        </section>

    </div>

    <script>
        function scrollToSection(id) {
            const section = document.getElementById(id);
            if (section) {
                section.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        }

        // Optional: close modal on clicking outside or on close button
        document.querySelectorAll('[data-modal-hide]').forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('authentication-modal').classList.add('hidden');
            });
        });
        // Show modal toggle by button with data-modal-toggle attribute
        document.querySelectorAll('[data-modal-toggle]').forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('authentication-modal').classList.remove('hidden');
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000, // durasi animasi
            once: false // hanya animasi pertama kali muncul
        });
    </script>
    <script>
        window.addEventListener("scroll", function() {
            const navbar = document.getElementById("navbar");
            const menu = document.getElementById("navbar-menu");

            if (window.scrollY > 10) {
                navbar.classList.add("backdrop-blur-md", "bg-white/60", "dark:bg-gray-900/60", "shadow-md");
                menu.classList.add("backdrop-blur-md", "bg-white/60", "dark:bg-gray-900/60", "shadow-md");
            } else {
                navbar.classList.remove("backdrop-blur-md", "bg-white/60", "dark:bg-gray-900/60", "shadow-md");
                menu.classList.remove("backdrop-blur-md", "bg-white/60", "dark:bg-gray-900/60", "shadow-md");
            }
        });
    </script>

</body>

</html>