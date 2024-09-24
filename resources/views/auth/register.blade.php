<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>{{$pageName}} - {{$siteName}}</title>
    <style>
        .gradient-custom {
            /* fallback for old browsers */
            background: #454B1B;
        }
    </style>
</head>
<body>
<section class="gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card text-white" style="border-radius: 1rem;background-color:#023020;">
                    <div class="card-body p-5 text-center">

                        <div class="mb-md-5 mt-md-4 pb-5">
                            <h2 class="fw-bold mb-2 text-uppercase">{{$pageName}}</h2>
                            <p class="text-white-50 mb-5">Fill up the form to register</p>
                            <form method="post" action="{{route('auth.register')}}">
                                @include('templates.notification')
                                @csrf
                                <div class="row">
                                    <div class="form-outline form-white mb-4 col-md-6">
                                        <input type="text" id="name" class="form-control form-control-lg"
                                               name="name" value="{{old('name')}}"/>
                                        <label class="form-label" for="typeEmailX">Name</label>
                                    </div>
                                    <div class="form-outline form-white mb-4 col-md-6">
                                        <input type="text" id="usernames" class="form-control form-control-lg"
                                               name="username" value="{{old('username')}}"/>
                                        <label class="form-label" for="username">Username</label>
                                    </div>
                                    <div class="form-outline form-white mb-4 col-md-6">
                                        <input type="email" id="typeEmailX" class="form-control form-control-lg"
                                               name="email" value="{{old('email')}}"/>
                                        <label class="form-label" for="typeEmailX">Email</label>
                                    </div>
                                    <div class="form-outline form-white mb-4 col-md-6" style="display:none;">
                                        <input type="tel" id="phone" class="form-control form-control-lg"
                                               name="phone" value="{{old('phone')}}"/>
                                        <label class="form-label" for="phone">Phone</label>
                                    </div>
                                    <div class="form-outline form-white mb-4 col-md-6">
                                        <input type="password" id="typePasswordX" class="form-control form-control-lg"
                                               name="password"/>
                                        <label class="form-label" for="typePasswordX">Password</label>
                                    </div>
                                    <div class="form-outline form-white mb-4 col-md-6" style="display:none">
                                        <input type="password" id="typePasswordX" class="form-control form-control-lg"
                                               name="password_confirmation"/>
                                        <label class="form-label" for="typePasswordX">Repeat Password</label>
                                    </div>
                                    <div class="form-outline form-white mb-4 col-md-12">
                                        <input type="text" id="username" class="form-control form-control-lg"
                                               name="referral" value="{{old('referral')}} {{$referral}}"/>
                                        <label class="form-label" for="username">Referral</label>
                                    </div>
                                </div>

                                <button class="btn btn-outline-light btn-lg px-5"
                                        type="submit">
                                    Sign Up
                                </button>
                            </form>
                        </div>

                        <div>
                            <p class="mb-0">Already have an account?
                                <a href="{{route('login')}}" class="text-white-50 fw-bold">Sign In</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>
