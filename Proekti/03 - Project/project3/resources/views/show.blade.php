<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $movie->title }} - KineMoe</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 60px;
        }
        .movie-details {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .checked {
            color: orange;
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
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <div class="movie-details">
                    <h2>{{ $movie->title }}</h2>
                    <p><strong>Year:</strong> {{ $movie->year }}</p>
                    <p>{{ $movie->time }}</p>
                    <p><strong>Description:</strong></p>
                    <p>{{ $movie->description }}</p>
                    <p><strong>Director:</strong> {{ $movie->director }}</p>
                    <p><strong>Writer:</strong> {{ $movie->writer }}</p>
                    <p><strong>Stars:</strong> {{ $movie->stars }}</p>
                    <div class="embed-responsive embed-responsive-16by9 mb-4">
                        <iframe class="embed-responsive-item" src="{{ $movie->trailer_url }}" allowfullscreen></iframe>
                    </div>
                    <a href="{{ route('moviebrowse') }}" class="btn btn-secondary">Back to Movies</a>
                </div>
            </div>
            <div class="col-md-4">
                <img src="{{ $movie->image_url }}" class="img-fluid" alt="{{ $movie->title }}">
            </div>
        </div>
        <!-- Display average rating -->
        <h3>Average Rating:</h3>
        @if ($movie->ratings->count() > 0)
            <div>
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $movie->averageRating())
                        <span class="fa fa-star checked"></span>
                    @else
                        <span class="fa fa-star"></span>
                    @endif
                @endfor
                <h6>({{ number_format($movie->averageRating(), 1) }})</h6>
            </div>
        @else
            <p>No ratings yet.</p>
        @endif

        <!-- Display user's rating -->
        @auth
            @php
                $userRating = $movie->ratings()->where('user_id', Auth::id())->first();
            @endphp
            @if ($userRating)
                <p>Your Rating: {{ $userRating->rating }}</p>
            @endif

            <!-- Rating form -->
            <h3>Rate this movie: ( You can do this only once )</h3>
            <form method="POST" action="{{ route('movies.rate', ['id' => $movie->id]) }}">
                @csrf
                <div class="mb-3">
                    <label for="rating" class="form-label">Your Rating (1-5):</label>
                    <input type="number" class="form-control" id="rating" name="rating" min="1" max="5" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit Rating</button>
            </form>

            <!-- Comments section -->
            <h3>Comments:</h3>
            @if ($movie->comments->count() > 0)
                <ul class="list-group mb-4">
                    @foreach ($movie->comments as $comment)
                        <li class="list-group-item">
                            <strong>{{ $comment->user->name }}</strong> ({{ $comment->created_at->format('M d, Y') }}):<br>
                            {{ $comment->comment }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No comments yet.</p>
            @endif

            <!-- Comment form -->
            <h3>Leave a comment:</h3>
            <form method="POST" action="{{ route('movies.comment', ['id' => $movie->id]) }}">
                @csrf
                <div class="mb-3">
                    <label for="comment" class="form-label">Your Comment:</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Comment</button>
            </form>
        @else
            <p>Please <a href="{{ route('login') }}">login</a> to rate and comment.</p>
        @endauth
    </div>
</body>
</html>
