<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Borsa</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{!! asset('that/vendors/mdi/css/materialdesignicons.min.css') !!}">
  <link rel="stylesheet" href="{!! asset('that/vendors/base/vendor.bundle.base.css') !!}">

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .top-title {
      color: white;
      padding: 16px;
    }

    .button-box {

      width: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }


    .parent-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
      background-color: #123C69;
    }

    .form-container {
      background-color: #fff;
      border-radius: 30px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 30px;
      padding-top: 30px;
      margin-left: 50px;
      overflow: hidden;
      width: 60%;
      height: 40vw;
      overflow-y: auto;
    }

    .form {
      display: flex;
      flex-direction: column;
      flex-wrap: wrap;
      justify-content: end;
      align-items: center;
      align-content: center;
      margin-top: 5rem;
    }

    .form-group {
      width: 40%;
      margin-bottom: 30px;
    }

    .form-group label {
      display: block;
      font-weight: bold;
    }

    .form-group input,
    .form-group select {
      width: 100%;
      border: none;
      border-bottom: 1px solid #9e9c9c;
      padding: 10px 5px;
    }

    .create-account-button {
      width: 100%;
      text-align: center;
      margin-top: 20px;
      background-color: #123C69;
      color: #fff;
      padding: 10px 0;
      border: none;
      border-radius: 10px;
      font-size: large;
      width: 50%;
    }

    .login-link {
      text-align: center;
      margin-top: 10px;
      padding-top: 10px;
      /* margin-left: 10%; */
    }

    .login-link a {
      color: #67b0d1;
      text-decoration: none;
    }

    .image-container {
      width: 30%;
      margin-right: 20px;
    }

    .image-container img {
      max-width: 100%;
      min-height: 60vh;
      /* border-radius: 10px; */
      margin-left: 60px;
    }

    .singup-title {
      text-align: center;
    }

    @media (max-width: 768px) {
      .form {
        flex-direction: column;
      }

      .form-group {
        width: 100%;
      }

      .create-account-button {
        width: 100%;
      }
    }
  </style>


</head>

<body>
  <div class="parent-container">

    <div class="image-container">
      <div class="top-title">
        <h1>Borsa</h1>
        <h3>Powered By Elebat Solution</h3>
      </div>
      <!-- <img src="./img/women_shoping.png" alt="Image"> -->
      <img src="{!! asset('that/images/women_shoping.png" alt="logo') !!}">
    </div>
    <div class="form-container">
      <h2 class="singup-title">Login</h2>
      <form method="POST" action="{{ route('login') }}" class="form">
        @csrf

        <div class="form-group">
          <!-- <label for="userName">User Name</label> -->
          <input type="text" id="userName" name="userName" placeholder="User Name" value="{{ old('userName') }}" required autocomplete="off" autofocus>

          @error('userName')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>


        <div class="form-group">
          <!-- <label for="password">Password</label> -->
          <input type="password" id="password" name="password" value="{{ old('password') }}" placeholder="Password" required autocomplete="off">
          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="button-box"><label class="form-check-label text-muted">
                    <input type="checkbox" class="form-check-input">
                    Remember me
                </label> <br>
                <button class="create-account-button" type="submit" onsubmit="setTimeout()">Login</button></div>


      </form>

      <p class="login-link">Don't have an account?  <a href="{{ route('register') }}">SignUp</a></p>
    </div>
  </div>

  <script src="{!! asset('that/vendors/base/vendor.bundle.base.js') !!}"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{!! asset('that/js/off-canvas.js') !!}"></script>
  <script src="{!! asset('that/js/hoverable-collapse.js') !!}"></script>
  <script src="{!! asset('that/js/template.js') !!}"></script>
</body>

</html>
