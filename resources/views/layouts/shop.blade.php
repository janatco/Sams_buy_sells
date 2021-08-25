<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/product.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="/home">{{ config('app.name', 'Laravel') }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="/home">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{url('/home')}}">All Categories</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                @foreach(config('values.categories') as $cat)
                                <li><a class="dropdown-item" href="{{url('/search/'.$cat)}}">{{$cat}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{url('/addProduct')}}">Post Auction</a></li>
                    </ul>
                    <form class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">hi {{ Auth::user()->name }}</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{('/userDashboard')}}">My Account</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                
                                <li><a class="dropdown-item" href="{{('/logout')}}">Logout</a></li>
                                
                            </ul>
                        </li>
                    </ul>
                        
                    </form>

                    
                </div>
            </div>
        </nav>
        
        <main class="py-4">
            @yield('content')
        </main>
        <!-- Footer-->
        <footer class="py-5 bg-danger">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Batch-15 2021</p></div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
</body>
</html>