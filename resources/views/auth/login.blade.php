@extends('layouts.auth')

@section('title')

    <title>Login</title>

@endsection

@section('content')

    <section class="sign-in-page bg-white">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-sm-6 align-self-center">
                    <div class="sign-in-from">
                        <h1 class="mb-0">Sign in</h1>
                        <form class="mt-4" id="form-login">
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control mb-0" name="email" id="email"
                                    placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control mb-0" name="password" id="password"
                                    placeholder="Password">
                            </div>
                            <div class="d-inline-block w-100">
                                <button type="submit" class="btn btn-primary float-right">
                                    <span class="spinner-border spinner-border-sm mr-1" id="spinner"></span> Sign in
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6 text-center">
                    <div class="sign-in-detail text-white"
                        style="background: url(assets/images/login/2.jpg) no-repeat 0 0; background-size: cover;">
                        <a class="sign-in-logo mb-5" href="#"><img src="assets/images/logo-white.png" class="img-fluid"
                                alt="logo"></a>
                        <div class="owl-carousel" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true"
                            data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1"
                            data-items-mobile-sm="1" data-margin="0">
                            <div class="item">
                                <img src="assets/images/login/1.png" class="img-fluid mb-4" alt="logo">
                                <h4 class="mb-1 text-white">Manage your orders</h4>
                                <p>It is a long established fact that a reader will be distracted by the readable content.
                                </p>
                            </div>
                            <div class="item">
                                <img src="assets/images/login/1.png" class="img-fluid mb-4" alt="logo">
                                <h4 class="mb-1 text-white">Manage your orders</h4>
                                <p>It is a long established fact that a reader will be distracted by the readable content.
                                </p>
                            </div>
                            <div class="item">
                                <img src="assets/images/login/1.png" class="img-fluid mb-4" alt="logo">
                                <h4 class="mb-1 text-white">Manage your orders</h4>
                                <p>It is a long established fact that a reader will be distracted by the readable content.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')

    <script>

        var access_token = localStorage.getItem('access_token');
        
        $(function() {

            $('#spinner').hide();

            $('#form-login').validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                },
                messages: {
                    email: {
                        required: 'Please enter your email',
                        email: 'Please enter a valid email address'
                    },
                    password: {
                        required: 'Please provide a password'
                    }
                },
                submitHandler: (form, event) => {
                    event.preventDefault();

                    $('#spinner').show();

                    const data = Object.fromEntries(new FormData(form).entries());

                    $.ajax({
                        type: 'POST',
                        url: '/api/login',
                        contentType: 'application/json',
                        data: JSON.stringify(data),
                    }).done(res => {

                        localStorage.setItem('current_user', JSON.stringify(res.data.user));
                        localStorage.setItem('access_token', res.data.token);

                        $('#spinner').hide();

                        window.location.href = '/';

                    }).fail(err => {

                        $('#spinner').hide();

                        const message = err.responseJSON.message;

                        const key = Object.keys(message)[0]

                        swal2Toast({
                            icon: 'error',
                            message: message[key][0]
                        });

                    });
                }
            });

        });
    </script>

@endsection
