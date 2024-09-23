<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 15px;
        }

        .login-container {
            background-color: white;
            padding: 0;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            display: flex;
            overflow: hidden;
            flex-direction: column;
        }

        .login-banner {
            display: none;
            background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp');
            background-size: cover;
            background-position: center;
            width: 100%;
            height: 200px;
        }

        @media (min-width: 768px) {
            .login-container {
                flex-direction: row;
                height: auto;
            }

            .login-banner {
                display: block;
                width: 80%;
                height: auto;
            }

            .login-form {
                width: 50%;
            }
        }

        .login-form {
            padding: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%;
        }

        .login-form img {
            display: block;
            margin: 0 auto 20px;
            width: 100px;
        }

        .form-heading {
            text-align: center;
            margin-bottom: 20px;
        }

        .toggle-password {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #6c757d;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 40px;
        }

        .social-login-hr {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 20px 0;
        }

        .social-login-hr hr {
            flex: 1;
            border: 1px solid red;
            height: 1px;
            background: #ddd;
        }

        .social-login-hr span {
            padding: 0 15px;
            color: #999;
        }

        .social-login button {
            width: 100%;
            margin-bottom: 10px;
        }

        .social-login {
            display: flex;
            justify-content: space-between;
        }

        form .form-group {
            position: relative;
        }

        form .form-group label {
            position: absolute;
            top: 10px;
            left: 20px;
            pointer-events: none;
            transition: all 0.3s ease;
            font-size: 14px;
            background: #ffffff;
            color: #6b6b6b;
        }

        form .form-group input:focus+label,
        form .form-group input:not(:placeholder-shown)+label {
            top: -12px;
            left: 10px;
            font-size: 12px;
            color: #46d222;
            z-index: 1000;
            padding: 0 5px;
            font-weight: 600;
        }

        form .form-group input {
            width: 100%;
            padding: 10px 17px;
            color: #46d222;
        }

        form .form-group input:focus,
        form .form-group input:valid {
            color: #46d222;
            border-bottom: 1px solid #46d222;
            border: 1px solid #46d222;
            box-shadow: 0 1px 0 0 #46d222;
        }

        /* Thêm dòng này để áp dụng cho ô input email */
        form .form-group input#email:not(:placeholder-shown) {
            border: 1px solid #46d222;
            /* Hoặc màu bạn muốn */
            box-shadow: 0 1px 0 0 #46d222;
            /* Hoặc màu bạn muốn */
        }

        h4 {
            font-size: 1rem;
        }

        .custom-toast {
            width: auto !important;
            /* Cho phép chiều rộng tự động */
            max-width: 500px;
            /* Bạn có thể điều chỉnh giá trị này theo nhu cầu */
            white-space: nowrap;
            /* Ngăn việc xuống dòng */
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    @include('message')
    <div class="login-container">
        <div class="login-banner"></div>
        <div class="login-form">
            <img src="https://via.placeholder.com/100" alt="Logo">
            <h2 class="form-heading">Đăng Nhập</h2>
            <form id="loginForm" action="" method="post">
                @csrf
                <div class="form-group mb-3">
                    <input value="{{old('email')}}" type="email" name="email" class="form-control" id="email" required placeholder=" ">
                    <label for="email">Nhập email</label>
                </div>
                <div class="form-group mb-3 password-wrapper">
                    <input value="{{old('password')}}" name="password" type="password" class="form-control" id="passwordInput" required
                        placeholder=" ">
                    <label for="passwordInput">Mật khẩu</label>
                    <span class="toggle-password" onclick="togglePassword()">👁️</span>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Đăng Nhập</button>
                </div>
                <div class="social-login-hr">
                    <hr>
                    <span>Sign in with</span>
                    <hr>
                </div>
                <div class="social-login">
                    <button type="button" class="btn btn-outline-danger me-2">
                        <i class="fab fa-google me-2"></i>Google
                    </button>
                    <button type="button" class="btn btn-outline-primary">
                        <i class="fab fa-facebook-f me-2"></i>Facebook
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('passwordInput');
            const toggleIcon = document.querySelector('.toggle-password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.textContent = '🙈';
            } else {
                passwordInput.type = 'password';
                toggleIcon.textContent = '👁️';
            }
        }
    </script>
</body>

</html>
