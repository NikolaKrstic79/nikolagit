<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{route('index');}}">Blog</a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar items -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->route()->getName() === 'index' ? 'active' : '' }}" aria-current="page" href="{{route('index');}}">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->route()->getName() === 'about' ? 'active' : '' }}" href="{{route('about');}}">ABOUT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->route()->getName() === 'post' ? 'active' : '' }}" href="{{route('post');}}">SAMPLE POST</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->route()->getName() === 'contact' ? 'active' : '' }}" href="{{route('contact');}}">CONTACT</a>
                </li>
            </ul>
        </div>
    </div>
</nav>