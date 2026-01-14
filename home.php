<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - My Daily Journal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #e0f2fe; transition: all 0.3s ease; }
        .dark-mode { background-color: #0c4a6e; color: white; }
        
        .nav-custom {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .dark-mode .nav-custom {
            background: rgba(12, 74, 110, 0.8);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 4px solid #bae6fd;
        }

        .dark-mode .glass-card {
            background: rgba(9, 46, 67, 0.9);
            border-color: #334155;
            color: white;
        }

        /* Perbaikan warna teks agar terbaca di dark mode */
        p, span, li { color: #0369a1; }
        .dark-mode p, .dark-mode span, .dark-mode li, .dark-mode h1, .dark-mode h2, .dark-mode h3, .dark-mode a { 
            color: #e2e8f0; 
        }
        
        /* Warna spesifik untuk Judul Logo */
        .logo-text { color: #0c4a6e; }
        .dark-mode .logo-text { color: #f0f9ff; }
    </style>
</head>
<body>
    <nav class="sticky top-0 z-50 shadow-sm nav-custom">
        <div class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-3 items-center max-w-6xl mx-auto px-4 gap-4">
                
                <div class="flex justify-center md:justify-start">
                    <a href="home.php" class="logo-text font-black text-xl tracking-tighter italic">
                        MY DAILY JOURNAL
                    </a>
                </div>

                <div class="flex justify-center items-center gap-6">
                    <a href="home.php" class="text-sky-800 hover:text-sky-500 font-black transition tracking-wide text-xs uppercase">Home</a>
                    <a href="gallery.php" class="text-sky-800 hover:text-sky-500 font-black transition tracking-wide text-xs uppercase">Gallery</a>
                    <a href="kontak.php" class="text-sky-800 hover:text-sky-500 font-black transition tracking-wide text-xs uppercase">Kontak</a>
                    <a href="aboutme.php" class="text-sky-800 hover:text-sky-500 font-black transition tracking-wide text-xs uppercase">About Me</a>
                </div>

                <div class="flex justify-center md:justify-end items-center gap-3">
                    <button onclick="toggleDarkMode()" class="bg-white/50 border border-sky-200 px-4 py-1.5 rounded-full font-bold text-sky-800 transition flex items-center gap-2 text-[10px] shadow-sm hover:bg-white">
                        <span id="darkModeIcon">🌙</span> <span id="darkModeText">Dark Mode</span>
                    </button>
                    <a href="login.php" class="bg-sky-500 text-white hover:bg-sky-600 px-6 py-1.5 rounded-full font-black transition shadow-md uppercase text-[10px]">
                        🔐 LOGIN
                    </a>
                </div>
                
            </div> 
        </div>
    </nav>

    <main class="max-w-5xl mx-auto mt-10 p-4">
        <div class="glass-card rounded-[3rem] p-8 shadow-2xl flex flex-col md:flex-row items-center gap-8 mb-10">
            <div class="relative">
                <div class="w-40 h-40 rounded-full border-8 border-sky-200 p-1 shadow-xl overflow-hidden bg-white">
                    <img src="./img/orangcantik.jpeg" alt="Profile" class="w-full h-full object-cover rounded-full">
                </div>
                <div class="absolute bottom-3 right-3 bg-green-500 w-5 h-5 rounded-full border-4 border-white shadow-md"></div>
            </div>
            <div class="flex-1 text-center md:text-left">
                <h1 class="text-3xl font-black text-sky-900 mb-1 italic tracking-tight">Putri Surya</h1>
                <p class="text-sky-600 font-black mb-4 italic text-sm uppercase">Mahasiswa Teknik Informatika</p>
                <div class="grid grid-cols-1 gap-2 bg-sky-50/50 p-5 rounded-3xl border-2 border-sky-100 text-sm">
                    <p class="font-bold"><strong class="text-sky-900">NIM:</strong> A11.2024.15765</p>
                    <p class="font-bold"><strong class="text-sky-900">Program Studi:</strong> Teknik Informatika</p>
                    <p class="font-bold"><strong class="text-sky-900">Universitas:</strong> Dian Nuswantoro</p>
                </div>
            </div>
        </div>

        <div class="glass-card rounded-[3rem] p-10 shadow-2xl">
            <div class="flex items-center gap-4 mb-8 border-b-4 border-sky-100 pb-6">
                <span class="text-3xl">📰</span>
                <h2 class="text-2xl font-black text-sky-900 uppercase italic">Artikel Terbaru</h2>
            </div>

            <article>
                <h1 class="font-black text-2xl text-sky-600 mb-4 leading-tight tracking-tight uppercase text-center">
                    Spot CFD di Semarang untuk Olahraga di Minggu Pagi
                </h1>
                
                <p class="text-sky-900 font-bold leading-relaxed mb-8 text-center text-sm opacity-80">
                    Berikut adalah titik favorit di Semarang untuk mengisi pagi harimu:
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <div class="bg-sky-100 p-6 rounded-[2.5rem] border-t-8 border-sky-400 shadow-sm flex flex-col">
                        <h3 class="font-black text-lg text-sky-900 uppercase">1. Jalan Pemuda</h3>
                        <p class="text-xs mt-3 text-sky-700 font-bold italic leading-relaxed">Pusat kota dengan bangunan bersejarah yang megah.</p>
                    </div>

                    <div class="bg-sky-100 p-6 rounded-[2.5rem] border-t-8 border-sky-400 shadow-sm flex flex-col">
                        <h3 class="font-black text-lg text-sky-900 uppercase">2. Jalan Pahlawan</h3>
                        <p class="text-xs mt-3 text-sky-700 font-bold leading-relaxed">Jalur rindang cocok untuk jogging dan bersepeda keluarga.</p>
                    </div>

                    <div class="bg-sky-100 p-6 rounded-[2.5rem] border-t-8 border-sky-400 shadow-sm flex flex-col">
                        <h3 class="font-black text-lg text-sky-900 uppercase">3. Simpang Lima</h3>
                        <p class="text-xs mt-3 text-sky-700 font-bold leading-relaxed">Ikon kota Semarang yang menjadi titik kumpul paling ramai.</p>
                    </div>
                </div>

                <div class="flex justify-center mt-6">
                    <a href="https://kumparan.com/seputar-semarang/3-spot-cfd-di-semarang-untuk-olahraga-di-minggu-pagi-24Fw2wDa0tw" target="_blank" 
                       class="bg-sky-500 hover:bg-sky-600 text-white font-black px-8 py-2 rounded-full transition shadow-lg transform hover:scale-105 text-[10px] tracking-[0.2em] uppercase">
                        Baca Lengkap →
                    </a>
                </div>
            </article>
        </div>
        
        <footer class="text-center py-10 text-sky-900/50 font-black text-xs uppercase tracking-widest">
            &copy; 2025 Putri Surya - My Daily Journal
        </footer>
    </main>

    <script>
        // Check local storage for dark mode
        if (localStorage.getItem('darkMode') === 'enabled') {
            document.body.classList.add('dark-mode');
            updateDarkModeButton();
        }

        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            localStorage.setItem('darkMode', document.body.classList.contains('dark-mode') ? 'enabled' : 'disabled');
            updateDarkModeButton();
        }

        function updateDarkModeButton() {
            const icon = document.getElementById('darkModeIcon');
            const text = document.getElementById('darkModeText');
            const isDark = document.body.classList.contains('dark-mode');
            icon.textContent = isDark ? '☀️' : '🌙';
            text.textContent = isDark ? 'Light' : 'Dark Mode';
        }
    </script>
</body>
</html>