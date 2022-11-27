<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logosumbar.png') }}">

    <link rel="stylesheet" href="{{ asset('login/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('login/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('login/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css">
    <link href="{{ asset('admin/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('login/css/style.css') }}">

    <title>Login</title>
  </head>
  <body>
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="{{ asset('login/images/undraw_remotely_2j6y.svg') }}" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <center><h3>Selamat Datang</h3></center>
            </div>
                <form  method="post" id="auth-user">
                    @csrf
                    <div class="form-group first">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username">
                    </div>
                    <span class="error-text text-danger username-error"></span>
                    <div class="form-group last">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" id="password">
                            <span toggle="#password-field" class="input-group-text border-0 bg-transparent bi bi-eye  toggle-password"></span>
                        </div>
                    </div>
                    <span class="error-text text-danger password-error"></span>
                    <div style="padding: 10px"></div>
                    <button type="submit" class="btn btn-block btn-primary">Login</button>
                </form>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>

    <script src="{{ asset('login/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('login/js/popper.min.js') }}"></script>
    <script src="{{ asset('login/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('login/js/main.js') }}"></script>
    <script src="{{ asset('admin/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>

    <script>
        $(document).on('click', '.toggle-password', function() {
            $(this).toggleClass("bi-eye bi-eye-slash");
            var input = $("#password");
            input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
        });

        $(document).on('submit', '#auth-user', function(e)
        {
            e.preventDefault()
            var form = $(this)
            $.ajax({
                type: "POST",
                url: "{{ route('auth-user') }}",
                data: form.serialize(),
                success: function (result) {

                    $('.username-error').hide();
                    $('.password-error').hide();

                    if (result.status) {
                        window.location.href = "{{ route('dashboard') }}";
                    }else {
                        sweetAlert("Wrong", result.message, "error");
                    }

                },
                error: function (xhr, error){
                    var message = xhr.responseJSON.errors;
                    var erruser = message.username ?? '';
                    var errpass = message.password ?? '';
                    $('.username-error').text(erruser);
                    $('.password-error').text(errpass);
                }
            });
        });

    </script>
  </body>
</html>
