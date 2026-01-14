<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Journal Putri Surya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
        
        /* --- DARK MODE CSS VARIABLES --- */
        :root {
            --bg-body: #f0f9ff; /* sky-50 */
            --bg-card: rgba(255, 255, 255, 0.9);
            --text-main: #0369a1; /* sky-900 */
            --border-color: #bae6fd;
        }

        body.dark-mode {
            --bg-body: #0f172a; /* slate-900 */
            --bg-card: rgba(30, 41, 59, 0.8);
            --text-main: #f1f5f9; /* slate-100 */
            --border-color: #334155; /* slate-700 */
        }

        html, body {
            overflow-x: hidden;
            overflow-y: scroll !important;
            height: auto !important;
            min-height: 100vh;
            scroll-behavior: smooth;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body) !important;
            color: var(--text-main) !important;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .halaman-panjang {
            min-height: 100vh; 
            padding: 120px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
            position: relative;
        }

        .kartu {
            background: var(--bg-card) !important;
            backdrop-filter: blur(10px);
            border-radius: 40px;
            padding: 50px;
            width: 100%;
            max-width: 1100px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            border: 4px solid var(--border-color) !important;
            z-index: 10;
        }

        /* Nav Custom */
        nav { transition: background-color 0.3s ease; }
        body.dark-mode nav { background-color: rgba(15, 23, 42, 0.9) !important; }

        /* Home Aesthetic Elements */
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(5deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }

        .floating-shape {
            position: absolute;
            z-index: 1;
            filter: blur(60px);
            opacity: 0.3;
            animation: float 8s ease-in-out infinite;
        }
        body.dark-mode .floating-shape { opacity: 0.1; }

        .clock-container {
            background: var(--bg-card);
            padding: 12px 30px;
            border-radius: 100px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            border: 2px solid var(--border-color);
            display: inline-flex;
            align-items: center;
        }

        /* Hover Effect */
        .gallery-item { transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        .gallery-item:hover { transform: scale(1.05) translateY(-10px); }
        
        a { text-decoration: none !important; }
        .nav-link-custom { color: #0369a1; transition: 0.3s; position: relative; }
        body.dark-mode .nav-link-custom { color: #38bdf8; }
        
        .nav-link-custom::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: #0ea5e9;
            transition: width 0.3s;
        }
        .nav-link-custom:hover::after { width: 100%; }

        /* Dark Mode Button Styles */
        #dark-mode-toggle {
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
            background: #f1f5f9;
        }
        body.dark-mode #dark-mode-toggle { background: #1e293b; }
    </style>
</head>
<body class="bg-sky-50 text-sky-900">

    <nav class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-lg shadow-sm p-4">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <h1 class="font-black italic text-sky-700 m-0 tracking-tighter dark:text-sky-400">PUTRI JOURNAL</h1>
            <div class="flex gap-6 font-bold text-[10px] uppercase items-center tracking-widest">
                <a href="#home" class="nav-link-custom">Home</a>
                <a href="#article" class="nav-link-custom">Article</a>
                <a href="#gallery" class="nav-link-custom">Gallery</a>
                <a href="#aboutme" class="nav-link-custom">About</a>
                <a href="#kontak" class="nav-link-custom">Contact</a>

                <button id="dark-mode-toggle" onclick="toggleDarkMode()">
                    <span id="dark-icon">🌙</span>
                </button>

                <a href="login.php" class="bg-sky-700 text-white px-5 py-2 rounded-full hover:bg-sky-600 transition shadow-lg shadow-sky-200">Login Admin</a>
            </div>
        </div>
    </nav>

    <section id="home" class="halaman-panjang justify-center overflow-hidden">
        <div class="floating-shape bg-sky-400 w-80 h-80 rounded-full -top-10 -left-10"></div>
        <div class="floating-shape bg-blue-300 w-96 h-96 rounded-full bottom-0 -right-10" style="animation-delay: -2s;"></div>
        <div class="floating-shape bg-indigo-200 w-64 h-64 rounded-full top-1/2 left-1/3" style="animation-delay: -4s;"></div>

        <div class="text-center z-10">
            <div class="mb-8">
                <div class="clock-container gap-4">
                    <div class="flex items-center gap-2">
                        <span class="text-sky-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                            </svg>
                        </span>
                        <span id="realtime-clock" class="text-xl font-black tracking-tighter">00:00:00</span>
                    </div>

                    <div class="h-6 w-[2px] bg-sky-100"></div>

                    <div class="flex items-center gap-2">
                        <span class="text-sky-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                            </svg>
                        </span>
                        <span id="realtime-date" class="text-[11px] font-bold uppercase tracking-widest">Loading...</span>
                    </div>
                </div>
            </div>

            <h1 class="text-[120px] font-black italic uppercase leading-none mb-4">
                Hello<span class="text-sky-500">.</span>
            </h1>
            
            <p class="text-2xl font-bold opacity-60 tracking-[0.4em] uppercase mb-12">
                Putri Surya Journal
            </p>

            <div class="flex flex-col items-center">
                <p class="text-[10px] font-black uppercase tracking-[0.5em] opacity-30 mb-4">Scroll Down</p>
                <a href="#article" class="animate-bounce bg-white p-4 rounded-full shadow-xl border border-sky-100 text-sky-600 hover:text-sky-400 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <section id="article" class="halaman-panjang">
        <div class="kartu">
            <h2 class="text-4xl font-black mb-10 italic border-b-8 border-sky-100 pb-4">📝 MY ARTICLES</h2>
            <div class="grid md:grid-cols-2 gap-10">
                <?php
                $sql = "SELECT * FROM article ORDER BY tanggal DESC";
                $result = $conn->query($sql);
                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "
                        <div class='border-b-2 border-sky-50 dark:border-slate-700 pb-6 group'>
                            <div class='overflow-hidden rounded-2xl mb-4 shadow-md'>
                                <img src='img/".$row['gambar']."' class='w-full h-56 object-cover group-hover:scale-110 transition duration-500' onerror='this.src=\"https://via.placeholder.com/400x200\"'>
                            </div>
                            <h3 class='font-bold text-xl uppercase'>".$row['judul']."</h3>
                            <p class='text-sm mt-2 opacity-80'>".substr(strip_tags($row['isi']), 0, 150)."...</p>
                        </div>";
                    }
                } else { echo "<p class='text-center opacity-50'>Belum ada artikel.</p>"; }
                ?>
            </div>
        </div>
    </section>

    <section id="gallery" class="halaman-panjang">
        <div class="kartu">
            <h2 class="text-4xl font-black mb-10 italic border-b-8 border-sky-100 pb-4">🖼️ GALLERY</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <?php
                $sql_gal = "SELECT * FROM gallery ORDER BY tanggal DESC";
                $result_gal = $conn->query($sql_gal);
                if ($result_gal && $result_gal->num_rows > 0) {
                    while($row_gal = $result_gal->fetch_assoc()) {
                ?>
                    <div class="gallery-item bg-white dark:bg-slate-800 p-3 rounded-[2.5rem] border-2 border-sky-50 dark:border-slate-700 shadow-sm">
                        <img src="img/<?= $row_gal['gambar'] ?>" class="w-full h-64 object-cover rounded-[2rem]" onerror="this.src='https://via.placeholder.com/300'">
                        <p class="text-center font-black mt-3 text-[10px] uppercase tracking-widest text-sky-700 dark:text-sky-400"><?= $row_gal['judul'] ?></p>
                    </div>
                <?php 
                    }
                } else {
                    echo "<p class='col-span-3 text-center opacity-50 font-bold py-10'>Data gallery belum ada di database.</p>";
                }
                ?>
            </div>
        </div>
    </section>

    <section id="aboutme" class="halaman-panjang">
        <div class="kartu">
            <?php include "aboutme.php"; ?>
        </div>
    </section>

    <section id="kontak" class="halaman-panjang">
        <div class="kartu">
            <?php include "kontak.php"; ?>
        </div>
    </section>

    <section id="profile" class="halaman-panjang bg-sky-900 text-white border-none">
        <div class="max-w-4xl flex flex-col md:flex-row items-center gap-12">
            <div class="relative">
                <div class="absolute -inset-4 bg-sky-500 rounded-full blur-2xl opacity-30 animate-pulse"></div>
                <img src="img/orangcantik.jpeg" class="relative w-72 h-72 rounded-full border-8 border-white/20 object-cover shadow-2xl" onerror="this.src='https://via.placeholder.com/200'">
            </div>
            <div class="text-center md:text-left z-10">
                <h2 class="text-6xl font-black italic">Putri Surya</h2>
                <p class="text-sky-300 font-bold text-2xl mt-2 tracking-tighter">A11.2024.15765</p>
                <div class="w-20 h-2 bg-sky-500 my-6 rounded-full mx-auto md:mx-0"></div>
                <p class="text-lg opacity-80 leading-relaxed max-w-md">Mahasiswa Teknik Informatika - Universitas Dian Nuswantoro Semarang. Berfokus pada Web Development dan Creative Coding.</p>
            </div>
        </div>
    </section>

    <footer class="py-10 text-center font-bold text-[10px] tracking-[0.5em] opacity-30">
        &copy; 2025 PUTRI SURYA JOURNAL
    </footer>

    <script>
        // LOGIKA DARK MODE
        function toggleDarkMode() {
            const body = document.body;
            body.classList.toggle('dark-mode');
            const isDark = body.classList.contains('dark-mode');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            updateIcon(isDark);
        }

        function updateIcon(isDark) {
            const icon = document.getElementById('dark-icon');
            icon.textContent = isDark ? '☀️' : '🌙';
        }

        // Cek Tema Saat Load
        document.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                document.body.classList.add('dark-mode');
                updateIcon(true);
            }
        });

        // Logika Jam
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('realtime-clock').textContent = `${hours}:${minutes}:${seconds}`;

            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            document.getElementById('realtime-date').textContent = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
        }
        
        setInterval(updateClock, 1000);
        updateClock();
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>