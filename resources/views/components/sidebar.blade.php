    <ul class="sidebar-menu">
        <li><a href="{{ route('landing.index') }}">Home</a></li>
        <li><a href="{{ route('landing.cariEvent') }}">Cari Event</a></li>
        <li><a href="{{ route('landing.aboutUs') }}">About Us</a></li>
        @auth
            <li class="sidebar-profile">
                <span id="sidebarProfileToggle">Profile ▾</span>
                <ul class="sidebar-profile-dropdown">
                    <li><a href={{ route('landing.editProfil') }}>Edit Profil</a></li>
                    <li><a href="{{ route('order.tiketSaya') }}">Riwayat Tiket</a></li>
                    <li><a href="{{ route('sign.out') }}">Log Out</a></li>
                </ul>
            </li>
        @endauth
    </ul>
