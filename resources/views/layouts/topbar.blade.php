<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand text-primary font-monospace fs-3 fw-bold" href="{{route('welcome')}}">PACK MATERIAL</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('order.create')}}"><i class="fa-brands fa-wpforms"></i> Transfer Form</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('orders')}}"><i class="fa-solid fa-right-left"></i> All Transfers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('products')}}"><i class="fa-solid fa-list"></i> Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('products.create')}}"><i class="fa-solid fa-add"></i> Create Product</a>
                </li>

            </ul>
           <div class="navbar-nav mb-lg-0">
                <ul class="navbar-nav me-auto px-2">
                    <li class="nav-item">
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary">Logout</button>
                        </form>
                    </li>
                </ul>
               <div class="me-auto">
                <img src="{{asset('assets/images/site/logo_resized.png')}}" alt="" width="60px">
               </div>
           </div>
        </div>
    </div>
</nav>


{{--<li class="nav-item dropdown">--}}
{{--    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--        <i class="fa-solid fa-bars text-primary"></i> Actions--}}
{{--    </a>--}}
{{--    <ul class="dropdown-menu">--}}
{{--        @if (Auth::User()->type === 'admin')--}}
{{--            <li>--}}
{{--                <a class="dropdown-item" href="{{route('admin.dashboard')}}">Dashboard</a>--}}
{{--            </li>--}}
{{--        @endif--}}
{{--        <li><form action="{{route('logout')}}" method="post">--}}
{{--                @csrf--}}
{{--                <button type="submit" class="dropdown-item">Logout</button>--}}
{{--            </form>--}}
{{--        </li>--}}
{{--    </ul>--}}
{{--</li>--}}
