<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">



    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Brainster Web</title>
  </head>
  <body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navcolor">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"> <img class="logosize" src="{{ URL('images/logo.png') }}" alt="Brainster-Logo.png"> </a>
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
        <li class="nav-item">
        <a class="nav-link text-dark" href="{{ Auth::check() ? '#' : route('login') }}">Login</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- ------------------------------------------------------------------------------------ -->

<!-- BANNER -->
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="banner">
        <img src="{{ URL('images/back.gif') }}" alt="Banner Image">
        <div class="banner-content">
          <h1>Brainster.xyz Labs</h1>
          <p>Проекти од академиите на Brainster</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- CARDS -->
<div class="container p-5">
  <div class="row">
    <!-- First Row -->
    <div class="col-md-4 mb-3">
      <div class="card">
        <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Card Image">
        <div class="card-body text-center">
          <h5 class="card-title">Wilderman-Adams</h5>
          <h6 class="card-subtitle mb-2 text-muted">Focused content-based</h6>
          <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vel dolorum atque beatae voluptatibus eaque cupiditate aspernatur! Debitis, adipisci laborum dolor autem laboriosam, labore a accusamus exercitationem fuga sint beatae nihil?</p>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card">
        <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Card Image">
        <div class="card-body text-center">
          <h5 class="card-title">Vandervort-Rolfson</h5>
          <h6 class="card-subtitle mb-2 text-muted">Robust analyzing forecast</h6>
          <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vel dolorum atque beatae voluptatibus eaque cupiditate aspernatur! Debitis, adipisci laborum dolor autem laboriosam, labore a accusamus exercitationem fuga sint beatae nihil?</p>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card">
        <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Card Image">
        <div class="card-body text-center">
          <h5 class="card-title">Schimmel, Stiedemann and Pollich</h5>
          <h6 class="card-subtitle mb-2 text-muted">Persistent discrete firmware</h6>
          <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vel dolorum atque beatae voluptatibus eaque cupiditate aspernatur! Debitis, adipisci laborum dolor autem laboriosam, labore a accusamus exercitationem fuga sint beatae nihil?</p>
        </div>
      </div>
    </div>
  </div>
  
  <div class="row">
    <!-- Second Row -->
    <div class="col-md-4 mb-3">
      <div class="card">
        <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Card Image">
        <div class="card-body text-center">
          <h5 class="card-title">Pagac-Feeney</h5>
          <h6 class="card-subtitle mb-2 text-muted">Customer-focused demand-driven leverage</h6>
          <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vel dolorum atque beatae voluptatibus eaque cupiditate aspernatur! Debitis, adipisci laborum dolor autem laboriosam, labore a accusamus exercitationem fuga sint beatae nihil?</p>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card">
        <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Card Image">
        <div class="card-body text-center">
          <h5 class="card-title">Kuhn-Sawayn</h5>
          <h6 class="card-subtitle mb-2 text-muted">Intuitive object-oriented policy</h6>
          <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vel dolorum atque beatae voluptatibus eaque cupiditate aspernatur! Debitis, adipisci laborum dolor autem laboriosam, labore a accusamus exercitationem fuga sint beatae nihil?</p>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card">
        <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Card Image">
        <div class="card-body text-center">
          <h5 class="card-title">Gutmann Ltd</h5>
          <h6 class="card-subtitle mb-2 text-muted">Future-proofed heuristic monitoring</h6>
          <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vel dolorum atque beatae voluptatibus eaque cupiditate aspernatur! Debitis, adipisci laborum dolor autem laboriosam, labore a accusamus exercitationem fuga sint beatae nihil?</p>
        </div>
      </div>
    </div>
  </div>
  
  <div class="row">
    <!-- Third Row -->
    <div class="col-md-4 mb-3">
      <div class="card">
        <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Card Image">
        <div class="card-body text-center">
          <h5 class="card-title">Nolan, O'Reilly and Muller</h5>
          <h6 class="card-subtitle mb-2 text-muted">Universal transitional capacity</h6>
          <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vel dolorum atque beatae voluptatibus eaque cupiditate aspernatur! Debitis, adipisci laborum dolor autem laboriosam, labore a accusamus exercitationem fuga sint beatae nihil?</p>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card">
        <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Card Image">
        <div class="card-body text-center">
          <h5 class="card-title">Pfannerstill-Gaylord</h5>
          <h6 class="card-subtitle mb-2 text-muted">Stand-alone zerotolerance challange</h6>
          <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vel dolorum atque beatae voluptatibus eaque cupiditate aspernatur! Debitis, adipisci laborum dolor autem laboriosam, labore a accusamus exercitationem fuga sint beatae nihil?</p>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card">
        <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Card Image">
        <div class="card-body text-center">
          <h5 class="card-title">Jerde-Witting</h5>
          <h6 class="card-subtitle mb-2 text-muted">Reduced clear-thinking hardware</h6>
          <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vel dolorum atque beatae voluptatibus eaque cupiditate aspernatur! Debitis, adipisci laborum dolor autem laboriosam, labore a accusamus exercitationem fuga sint beatae nihil?</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- FOOTER -->
<footer class="footer">
  <div class="container">
    <p>Made with <span style="color: red;">❤</span> by 
      <img class="logosize2" src="{{ URL('images/logo.png') }}" alt="Logo" style="vertical-align: middle;"> 
      <span class="text-success">- Say Hi!</span> - <span class="text-dark">Terms</span>
    </p>
  </div>
</footer>

    <!-- END -->

    <!-- JAVA -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   
  </body>
</html>