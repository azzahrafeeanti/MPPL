<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Profil</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Public+Sans:ital,wght@0,100..900;1,100..900&family=Sriracha&display=swap"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('css/editProfil.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <!-- Close Button -->
    <div class="close-btn">
        <a href="{{ route('landing.index') }}">
            <img src="{{ asset('icons/close.svg') }}" alt="close" />
        </a>
    </div>

    <h2 id="profile-title">Profil</h2>

    <div class="modal">
        <form method="POST"
        action="{{ route('user.updateProfile') }}"
        enctype="multipart/form-data"
        >
        @csrf
        @method('PUT')
        @if (session('success'))
            <div class="alert alert-success" style="color: green; font-weight: bold; text-align: center; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" style="color: red; margin-bottom: 15px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="profile-pic-container">
            <img
                src="{{ Auth::user()->profile_photo ? url('storage/' . Auth::user()->profile_photo) : asset('img/editProfil.jpg') }}"
                alt="Profile Picture"
                class="foto-profil"
                id="displayed-photo"
            />

            <!-- ganti photo -->
            <input
                type="file"
                id="upload-photo"
                accept="image/*"
                style="display: none"
                name="profile_photo"
            />

            <!-- Ikon pensil -->
            <div class="edit-icon" id="trigger-upload">
                <img src="{{ asset('icons/Edit.svg') }}" alt="edit" />
                </div>
            </div>

            <div class="form-group">
                <label for="fullname">Full name</label>
                <input
                    type="text"
                    id="fullname"
                    name="name"
                    value="{{ old('name', Auth::user()->name) }}"
                    placeholder="full name"
                    required
                />
                @error('name') <div class="text-danger" style="color: red;">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', Auth::user()->email) }}"
                    placeholder="email"
                    required
                />
                @error('email') <div class="text-danger" style="color: red;">{{ $message }}</div> @enderror
            </div>
            <div class="buttons">
                <button type="submit" class="btn-update">Perbarui</button>
            </div>
        </form>
    </div>

    <script>
        // toggle edit mode
        // Ambil elemen
        const triggerUpload = document.getElementById("trigger-upload");
        const uploadInput = document.getElementById("upload-photo");
        const displayedPhoto = document.getElementById("displayed-photo");

        // Ketika ikon edit diklik, buka file picker
        triggerUpload.addEventListener("click", () => {
            uploadInput.click();
        });

        // Ketika file dipilih, tampilkan preview-nya
        uploadInput.addEventListener("change", function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    displayedPhoto.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>