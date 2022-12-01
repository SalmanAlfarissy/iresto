<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="admin, dashboard">
	<meta name="author" content="DexignZone">
	<meta name="robots" content="index, follow">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone=no">

	<!-- PAGE TITLE HERE -->
	<title>iResto : Restoran Indonesia</title>

    <link href="{{ asset('admin/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="{{ asset('admin/images/icook.png') }}">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href="#"><img src="{{ asset('admin/images/icook.png') }}" alt="" width="100px"></a>
									</div>
                                    <h4 class="text-center mb-4">Sign in your account</h4>
                                    <form id="formLogin" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Email</strong></label>
                                            <input type="email" class="form-control" placeholder="hello@example.com" name="email">
                                            <div class="text-danger email-error"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" class="form-control" name="password">
                                            <div class="text-danger password-error"></div>
                                        </div>
                                        <div class="row d-flex justify-content-between mt-4 mb-2">
                                            <div class="mb-3">
                                               <div class="form-check custom-checkbox ms-1">
													<input type="checkbox" class="form-check-input" id="basic_checkbox_1">
													<label class="form-check-label" for="basic_checkbox_1">Remember my preference</label>
												</div>
                                            </div>
                                            <div class="mb-3">
                                                <a href="page-forgot-password.html">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Don't have an account? <a class="text-primary" href="#">Sign up</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('admin/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('admin/js/custom.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    {{-- <script src="{{ asset('admin/js/dlabnav-init.js') }}"></script>
	<script src="{{ asset('admin/js/styleSwitcher.js') }}"></script> --}}
    <script>
        $(document).on('submit', '#formLogin', function (e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                type: "POST",
                url: "{{ route('login-authUser') }}",
                data: form.serialize(),
                success: function (result) {
                    if (result.status) {
                        window.location.href = "{{ route('login') }}";
                    }else{
                        swal("Login Gagal", result.message, "error");
                        $('.email-error').text();
                        $('.password-error').text();
                    }
                },
                error: function (xhr, error) {
                    var message = xhr.responseJSON.errors;
                    var email = message.email ?? '';
                    var password = message.password ?? '';
                    $('.email-error').text(email);
                    $('.password-error').text(password);

                }
            });
        });
    </script>
</body>
</html>
