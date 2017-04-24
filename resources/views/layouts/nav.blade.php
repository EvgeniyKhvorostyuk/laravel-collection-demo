<div class="blog-masthead">
    <div class="container">
        <nav class="nav blog-nav">
            <a class="nav-link active" href="/">Home</a>
            @if (Auth::check())
            <a class="nav-link" href="/sources">Sources</a>
            @endif
            @if (Auth::check())
            <a class="nav-link ml-auto" href="/logout">Logout</a>
            @else
            <a class="nav-link ml-auto" href="/login">Login</a>
            @endif
        </nav>
    </div>
</div>