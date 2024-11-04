<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Browse - KineMoe</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Optional custom styles */
        body {
            background-color: #f8f9fa;
            padding-top: 60px; /* Adjust based on your navbar height */
        }
        .card {
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <a class="navbar-brand text-danger" href="#">KINEMOE</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                <a href="{{ route('home') }}" class="btn btn-outline-danger">Sign Out</a>
                <a href="{{ route('adminlogin') }}" class="btn btn-outline-danger">Admin Panel</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            @foreach($movies as $movie)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="{{ route('show', ['id' => $movie->id]) }}">
                        <img src="{{ $movie->image_url }}" class="card-img-top" alt="{{ $movie->title }}">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $movie->title }}</h5>
                        <p class="card-text">Year: {{ $movie->year }}</p>
                        <!-- <a href="{{ route('show', ['id' => $movie->id]) }}" class="btn btn-primary btn-sm">View Details</a> -->
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
