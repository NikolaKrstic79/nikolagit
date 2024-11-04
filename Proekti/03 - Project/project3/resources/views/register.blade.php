  <!doctype html>
  <html lang="en">
  <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

      <title>Register - KINEMOE</title>
  </head>
  <body>
      <!-- NAVBAR -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">
              <a class="navbar-brand text-danger" href="#">KINEMOE</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
                  <form class="d-flex">
                      <a href="{{ route('login') }}" class="btn btn-outline-danger">Sign In</a>
                  </form>
              </div>
          </div>
      </nav>
      <!-- BANNER -->
      <div class="jumbotron jumbotron-fluid text-center yellowbg text-white">
          <div class="container">
              <p class="lead text-dark">STEP 1 OF 3</p>
              <p class="lead text-dark">Create a password to start your membership</p>
              <p class="lead text-dark">Just a few more steps and you're done! We hate paperwork, too.</p>
              <!-- Register Form -->
              <form action="{{ route('register') }}" method="post">
                  @csrf
                  <div class="mb-3">
                      <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                      @if ($errors->has('email'))
                          <span class="text-danger">{{ $errors->first('email') }}</span>
                      @endif
                  </div>
                  <div class="mb-3">
                      <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                      @if ($errors->has('password'))
                          <span class="text-danger">{{ $errors->first('password') }}</span>
                      @endif
                  </div>
                  <button type="submit" class="btn btn-outline-danger">Next</button>
              </form>
          </div>
      </div>
      <!-- Optional JavaScript; choose one of the two! -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
  </html>
