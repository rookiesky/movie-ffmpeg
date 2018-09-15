<!-- nav start -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-5 header-menu-nav">
            <li class="nav-item active">
                <a class="nav-link" href="/">首頁</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">檢索</button>
        </form>
        <ul class="navbar-nav ml-auto">
            @guest
            <li class="nav-item">
                <a class="nav-link" href="/login">登陸</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/sign-up">註冊</a>
            </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="/member">會員中心</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">登出</a>
                </li>
            @endguest
        </ul>
    </div>
</nav>
<!-- end nav -->