<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign in Form</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Public+Sans:ital,wght@0,100..900;1,100..900&family=Sriracha&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('css/SignIn.css') }}" />
  </head>
  <body>
    <main>
      <div class="box">
        <div class="inner-box">
          <div class="images"></div>
          <div class="forms-wrap">
            <div class="heading">
              <h2>Welcome Back</h2>
              <h4>Welcome Back, Please enter Your details</h4>
            </div>

            <div class="toggle-buttons">
              <a href="{{ route('landing.signIn') }}" class="toggle-btn active" id="signin-btn"
                >Sign In</a
              >
              <a href="{{ route('landing.signUp') }}" class="toggle-btn" id="signup-btn"
                >Sign Up</a
              >
            </div>

            <form method="POST" action="{{ route('landing.handleSignIn') }}" autocomplete="off" class="sign-in-form">
              @csrf
              <label for="email">Email</label>
              <input type="email" id="email" name="email" placeholder="Masukkan Email" required />
              <input type="password" name="password" placeholder="Masukkan Password" required>

              <button type="submit" class="continue-btn">Continue</button>
            </form>

            <div class="or">Or continue with</div>

            <div class="social-btn">
              <button class="apple">
                <img src="{{ asset('icons/Apple.svg') }}" alt="" />Apple
              </button>
              <button class="google">
                <img src="{{ asset('icons/google.svg') }}" alt="" />Google
              </button>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- javascript -->
    <link rel="stylesheet" href="DaftarAkun.js" />
    <script>
      const signinBtn = document.getElementById("signin-btn");
      const signupBtn = document.getElementById("signup-btn");

      signupBtn.addEventListener("click", function (e) {
        e.preventDefault(); // cegah pindah halaman langsung

        // ganti class active
        signinBtn.classList.remove("active");
        signupBtn.classList.add("active");

        // delay pindah halaman agar efek kelihatan
        setTimeout(() => {
          window.location.href = "{{ route('landing.signUp') }}";
        }, 200); // kasih delay 200ms biar efek aktif kelihatan dulu
      });
    </script>
  </body>
</html>

