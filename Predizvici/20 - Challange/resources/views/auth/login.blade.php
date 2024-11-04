<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navcolor">
  <div class="container-fluid">
  <a class="navbar-brand" href="{{ url('/index') }}"> <img class="logosize" src="{{ URL('images/logo.png') }}" alt="Brainster-Logo.png"> </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link text-dark" href="#">Академија за Програмирање</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="#">Академија за Маркетинг</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="#">Академија за Дизајн</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="#">Блог</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="#">Вработи наши студенти</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- ------------------------------------------------------------------------------------ -->
<!-- FORM -->
    <div class="d-flex justify-content-center">
        <button id="login-button" class="btn btn-primary me-2">Login</button>
        <button id="register-button" class="btn btn-secondary">Register</button>
    </div>
    <!-- LOGIN FORM -->
    <div id="login-form" class="d-none mt-3">
    <h2>LOGIN:</h2>
        <form method="POST" action="{{ route('login') }}" class="row g-3">
            @csrf
            <div class="col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class = "col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
    <!-- REGISTER FORM -->
    <div id="register-form" class="d-none mt-3">
    <h2>REGISTER:</h2>
        <form method="POST" action="{{ route('register') }}" class="row g-3">
            @csrf
            <div class="col-md-6">
                <label for="username" class="form-label">Name</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class = "col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script>
    document.getElementById('login-button').addEventListener('click', function() {
        document.getElementById('login-form').classList.remove('d-none');
        document.getElementById('register-form').classList.add('d-none');
    });

    document.getElementById('register-button').addEventListener('click', function() {
        document.getElementById('login-form').classList.add('d-none');
        document.getElementById('register-form').classList.remove('d-none');
    });
    </script>
</body>
</html>