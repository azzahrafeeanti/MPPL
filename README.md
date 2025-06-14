# TapakAsa

**TapakAsa** adalah platform volunteering yang mempertemukan individu, komunitas, dan perusahaan dengan berbagai kegiatan sosial dari seluruh Indonesia. Melalui satu ruang digital yang tertata, kami memudahkan siapa pun untuk menemukan peran, mendaftar sebagai relawan, dan terlibat langsung dalam aksi nyata yang berdampak.

Kami percaya bahwa kebaikan yang terorganisir akan menjangkau lebih jauh. Karena itu, setiap kegiatan di TapakAsa dirancang agar partisipasi menjadi pengalaman yang mudah, jelas, dan bermakna. Di sinilah langkah kecil punya tempat, dan setiap kontribusi tumbuh menjadi harapan bersama.

![mockup](Mockup.jpg)

---

## Fitur-Fitur TapakAsa

### Deskripsi dan Panduan Kegiatan  
Setiap kegiatan dirancang dengan informasi yang lengkap dan narasi yang jelas.  
Panduan pelaksanaan disediakan agar setiap relawan datang dengan pemahaman bukan hanya niat.

### Jadwal Kegiatan  
Waktu pelaksanaan disampaikan secara terbuka dan teratur.  
Kegiatan bisa dipilih dan direncanakan sesuai ritme hidup dan semangat yang ingin dibawa.

### Pendaftaran dan Reservasi Tiket  
Semua kegiatan dikelola melalui sistem tiket baik berbayar, bayar sukarela, maupun gratis.  
Dengan ini, proses registrasi menjadi lebih tertib dan terdata, memungkinkan pengalaman yang rapi bagi penyelenggara dan peserta.

### Akun Relawan  
Akun relawan menjadi rumah bagi setiap jejak kebaikan yang kamu lakukan.  
Di dalamnya tersimpan riwayat kegiatan dan akses tiket, membentuk perjalanan sosialmu sendiri.

### Kontak Kami  
Kami membuka ruang kolaborasi, tanya jawab, maupun peluang kerja sama.  
Hubungi tim TapakAsa melalui halaman resmi *Kontak Kami* atau saluran media sosial yang tersedia.

### CSR  
Bagi perusahaan, TapakAsa menjadi mitra untuk membangun dampak sosial yang lebih luas.  
Kami mendukung program CSR melalui kegiatan sosial yang dapat disesuaikan, dari partisipasi karyawan hingga sponsorship berkelanjutan.

---

> TapakAsa: Menjejak bersama, menyemai harapan 

---

## Teknologi yang Digunakan

- *Frontend*: HTML, CSS, JavaScript  
- *Backend*: PHP dengan Laravel  
- *Database*: MySQL  

---

## Tim Pengembang TapakAsa

| Nama | NIM | Peran |
|------|-----|-------|
| Fatimah Khoirun Nisa | 23106050078 | UI/UX Designer |
| Dinar Alvi Karima | 23106050071 | Frontend Developer |
| Hannah Khairunnisa Filzah | 23106050053 | Backend Developer |
| Azzahra Nur Addin Afeeanti | 23106050079 | Creative Research & Content Planner |

---

## Deskripsi Tugas Tim

### Fatimah Khoirun Nisa– 23106050078  
*UI/UX Designer*  
Bertugas merancang antarmuka pengguna yang bersih, intuitif, dan mudah digunakan. Mulai dari pembuatan wireframe hingga prototipe desain akhir, semua disusun agar pengalaman pengguna terasa nyaman dan fungsional di berbagai perangkat.

### Dinar Alvi Karima – 23106050071  
*Frontend Developer*  
Berperan dalam membangun tampilan web berdasarkan desain UI/UX yang telah dibuat, mencakup penerapan HTML, CSS, dan JavaScript agar tampilan web responsif, interaktif, dan terhubung dengan backend secara optimal.

### Hannah Khairunnisa Filzah – 23106050053  
*Backend Developer*  
Menangani bagian server-side dari platform, seperti pengaturan data kegiatan dan akun. Selain itu juga memastikan semua fitur berjalan sesuai logika dan dapat diakses dengan stabil.

### Azzahra Nur Addin Afeeanti – 23106050079  
*Creative Research & Content Planner*  
Bertanggung jawab pada penyusunan konten, gaya komunikasi platform, serta riset fitur berbasis kebutuhan pengguna. Menggabungkan data, tren sosial, dan insight relawan untuk menciptakan konsep fitur yang relevan dan berdampak.

---

## Tujuan Proyek

- Memberikan akses mudah bagi masyarakat untuk berkontribusi dalam kegiatan sosial secara digital  
- Menumbuhkan partisipasi aktif generasi muda dalam gerakan relawan  
- Membangun ekosistem relawan berbasis digital yang terstruktur dan berkelanjutan  
- Menjadikan proses menjadi relawan lebih modern, transparan, dan terdokumentasi

---

# Panduan: Cara Menjalankan Proyek TapakAsa di Laptop 
### Langkah 1: Siapkan File Proyek dan Database

1. pastikan laravel, fialment, php versi 8.3, xampp/laragon/mamp terinstall

2.  Ekstrak File Proyek:
    * Teman Anda akan memberikan Anda sebuah file ZIP (misalnya tapak_asa_project.zip) dan sebuah file SQL (tapak_asa_database_backup.sql).
    * Ekstrak file tapak_asa_project.zip ke dalam folder proyek web server Anda:
        * Laragon: D:\laragon\www\ (atau lokasi www Anda)
        * XAMPP: C:\xampp\htdocs\ (atau lokasi htdocs Anda)
        * MAMP: Applications/MAMP/htdocs/ (atau lokasi htdocs Anda)
    * Setelah diekstrak, Anda akan memiliki folder proyek (misalnya tapak_asa) di lokasi tersebut.


### Langkah 2: Instalasi dan Konfigurasi Laravel

1.  Buka Terminal/Command Prompt/Git Bash:
    * Navigasi ke dalam folder proyek Laravel Anda (misalnya cd D:\laragon\www\tapak_asa). Ini sangat penting, semua perintah selanjutnya dijalankan dari sini.


2.  Instal Dependencies Proyek:
    * Jalankan perintah ini:
        bash
        composer install
        
    * Perintah ini akan mengunduh semua library dan paket PHP yang dibutuhkan proyek (termasuk Laravel dan Filament) dan menempatkannya di folder vendor/. Ini mungkin memakan waktu beberapa menit, tergantung koneksi internet Anda.


3.  Generate Application Key:
    * Kunci aplikasi (APP_KEY) sangat penting untuk keamanan.
    * Jalankan perintah:
        bash
        php artisan key:generate
        
    * Ini akan otomatis mengisi nilai APP_KEY di file .env Anda.


4.  Buat Symlink Storage:
    * Ini diperlukan agar gambar dan file yang diunggah (seperti foto profil, bukti pembayaran, gambar event) dapat diakses oleh aplikasi.
    * Jalankan perintah:
        bash
        php artisan storage:link
        
    * Ini akan membuat folder public/storage yang menunjuk ke storage/app/public.
      

### Langkah 3: Jalankan Proyek

1.  Pastikan Server Lokal Berjalan:
    * Jika Anda menggunakan Laragon/XAMPP/MAMP, pastikan semua layanan (Apache/Nginx, MySQL, PHP) sudah berjalan (biasanya ada tombol "Start All" di aplikasi mereka).

2. jalankan perintah 'php artisan serve' di terminal dan klik link yang muncul.
   misal: http://127.0.0.1:8000/


3.  Akses Filament Admin Panel:
    - php artisan make:filament-user ->digunakan untuk membuat admin, nanti bisa diisi nama, email, dan password dari admin, misal nama adminnya tapakAsa
    - supaya bisa buka di web browser, ketik http://127.0.0.1:8000/adminTapakasa di web browser, jadi ini tu kayak link yg buat user cuman ditambahin /admin...

Selamat! Proyek TapakAsa seharusnya sudah dapat berjalan dengan baik di laptop Anda.
