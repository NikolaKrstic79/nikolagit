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
        <section class="index-bg global-bg d-flex justify-content-center align-items-center">
            <div class="text-center">
                <h1>Clean Blog</h1>
                <p>A Blog Theme By Start Bootstrap</p>
            </div>
        </section>
        <section class="content container w-25 py-3">
            <h2>Lorem, ipsum.</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam exercitationem nesciunt culpa delectus iste.</p>
            <cite class="text-secondary">Posted by <strong>John Doe</strong></cite>
            <hr>
            <h2>Lorem, ipsum. 2</h2>
            <cite class="text-secondary">Posted by <strong>John Doe</strong> in another boring news</cite>
            <hr>
            <h2>Lorem, ipsum. 3</h2>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quae quibusdam modi maxime deserunt laudantium quisquam, porro hic aperiam, debitis ipsa quas mollitia ipsum ea, dicta eum delectus fugit id eius!</p>
            <cite class="text-secondary">Posted by <strong>Jane Doe</strong></cite>
            <hr>
            <h2>Lorem, ipsum. 4</h2>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
            <cite class="text-secondary">Posted by <strong>Missy Doe</strong></cite>
            <hr>
            <div class="d-flex flex-row-reverse">
                <button class="btn btn-primary">Older posts -></button>
            </div>
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