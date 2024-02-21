@extends('layouts.guest')

@section('content')
    <section class="bg-body-secondary">
        <div class="container pt-3">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card shadow-lg border-0 overflow-hidden">
                        <div class="row g-0">
                            <div class="col-md-4 col-lg-5 d-none d-md-block">
                                <img class="img-fluid object-fit-cover h-100" style="filter: grayscale();"
                                     src="{{ URL::asset('assets/images/site/login.jpg') }}"/>
                            </div>
                            <div class="col-md-8 col-lg-7 d-flex align-items-center justify-content-center">
                                <div class="p-4 p-lg-5 w-100">
                                    <div class="text-center pb-3">
                                        <img src="{{ URL::asset('assets/images/site/logo_resized.png') }}"
                                             alt="login form" class="img-fluid ms-lg-5 ms-md-4 pe-md-1" width="300px"/>
                                    </div>
                                    <form class="py-2 px-lg-4 px-md-3" method="POST" action="{{route('login')}}">
                                        @csrf

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="email"><i class="fa-solid fa-envelope"></i>
                                                Email address</label>

                                            <input id="email" type="email" class="form-control form-control-lg
                                                   @error('email') is-invalid @enderror" name="email"
                                                   value="admin@test.co.za"
                                                   required autocomplete="email" autofocus>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="password"><i class="fa-solid fa-key"></i>
                                                Password
                                            </label>
                                            <div class="input-group">
                                                <input id="password" type="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       name="password" required autocomplete="current-password"
                                                       value="Cookie!2023">
                                                <span class="input-group-text">
                                                <i class="fa fa-eye" id="togglePassword" style="cursor: pointer"></i>
                                            </span>
                                            </div>

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                             </span>
                                            @enderror
                                        </div>
                                        <div class="pt-1 mb-4 text-center">
                                            <button class="btn btn-primary btn-lg btn-block" type="submit">
                                                Login <i class="fa-solid fa-sign-in"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function () {

            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            // toggle the eye icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>

@endsection
