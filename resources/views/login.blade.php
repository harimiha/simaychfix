<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('style/css/login.css')}}">
    <link rel="icon" href="{{asset('style/assets/YCH No BG.png')}}">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> -->
</head>
<body>
    <div class="login-container">
        <div><img src="{{asset('style/assets/YCH No BG.png')}}" alt="logoych"></div>
        <p>Sign in to continue</p>
        @if (session('message'))
        <div class="alert alert-{{ session('message')['status'] }}">
            {{ session('message')['desc'] }}
        </div>
        @endif
        <form id="loginForm" method="post" action="{{ route('checklogin') }}" method="post">
            {{ csrf_field() }}
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <i class="fa fa-eye-slash" id="tooglePassword"></i>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
    <script src="{{asset('style/js/login.js')}}"></script>
    <script src="https://kit.fontawesome.com/9d2abd8931.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>
