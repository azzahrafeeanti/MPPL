<div class="container navbar">
    <h1 class="logo">TapakAsa</h1>
    <nav>
        <ul class="nav-menu">
            <li><a href="{{ route('landing.index') }}">Home</a></li>
            <li><a href="{{ route('landing.cariEvent') }}">Cari Event</a></li>
            <li><a href="{{ route('landing.aboutUs') }}">About Us</a></li>
        </ul>
    </nav>
    @auth
        <div class="profile" id="profile">
            <img
                src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('img/editProfil.jpg') }}"
                alt="User Profile"
                class="profile-pic"
            />
            <span class="profile-name">{{ Auth::user()->name }}</span>
            <div class="dropdown-menu" id="dropdownMenu">
                <a href="{{ route('landing.editProfil') }}">Edit Profil</a>
                <a href="{{ route('order.tiketSaya') }}">Riwayat Tiket</a>
                <a href="{{ route('sign.out') }}">Sign Out</a>
            </div>
        </div>
    @endauth
    @guest
        <div class="auth-buttons">
            <a href="{{ route('landing.signUp') }}" class="btn neutral-btn">Daftar</a>
            <a href="{{ route('landing.signIn') }}" class="btn login-btn">Masuk</a>
        </div>
    @endguest
    
        <div class="menu-toggle" id="menu-toggle">
            <i class="fa-solid fa-bars"></i>
        </div>
        

</div>
