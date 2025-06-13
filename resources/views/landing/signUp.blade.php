<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up Form</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Public+Sans:ital,wght@0,100..900;1,100..900&family=Sriracha&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('css/SignUp.css') }}" />
    <style>
      .error-text{
          color: #dc3545;
          font-size: 11px;
          margin-bottom: 2rem;
          display: block;
          font-weight: 400;
      }
    </style>
  </head>
  <body>
    <main>
      <div class="box">
        <div class="inner-box">
          <div class="images"></div>
          <div class="forms-wrap">
            <div class="heading">
              <h2>Create an account</h2>
              <h4>Sign up and get interesting activities</h4>
            </div>

            <form method="POST" action="{{ route('landing.handleSignUp') }}" autocomplete="off" class="sign-in-form">
              @csrf
              <label for="name">Full Name</label>
              <input
                type="text"
                id="signup-name"
                name="name"
                placeholder="Enter your full name"
                required
              />
              @error('name')
                <span class="error-text">{{ $message }}</span>
              @enderror

              <label for="email">Email</label>
              <input
                type="email"
                id="signup-email"
                name="email"
                placeholder="Enter your email"
                required
              />
              @error('email')
                <span class="error-text">{{ $message }}</span>
              @enderror

              <label for="password">Password</label>
              <input
                type="password"
                id="signup-password"
                name="password"
                placeholder="Create a password"
                required
              />
              @error('password')
                <span class="error-text">{{ $message }}</span>
              @enderror

              <div class="account-link">
                Have any account? <a href="{{ route('landing.signIn') }}">Sign In</a>
              </div>

              <button type="submit" class="submit-btn">Submit</button>
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
  </body>
</html>
