<!doctype html>
<html lang="en">

<head>
    <title>le index</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <header>
        @include('components.navbar')
    </header>
    <main>
        <section class="about-bg global-bg d-flex justify-content-center align-items-center">
            <div class="text-center">
                <h1>About Me</h1>
                <p>This is what I do.</p>
            </div>
        </section>
        <section class="content container w-25 py-3">
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis deserunt distinctio odio natus dolore nemo assumenda impedit tempore necessitatibus dolores ducimus, aspernatur eveniet quisquam voluptatibus modi! Reprehenderit cumque perferendis alias?</p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis deserunt distinctio odio natus dolore nemo assumenda impedit tempore necessitatibus dolores ducimus, aspernatur eveniet quisquam voluptatibus modi! Reprehenderit cumque perferendis alias?</p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis deserunt distinctio odio natus dolore nemo assumenda impedit tempore necessitatibus dolores ducimus, aspernatur eveniet quisquam voluptatibus modi! Reprehenderit cumque perferendis alias?</p>
        </section>
    </main>
    <footer>
        @include('components.footer')
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>