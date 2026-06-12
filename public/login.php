<?php
session_start();

require_once "../models/auth.php";

$auth = new Auth();

if (isset($_POST['create'])) {
    $email = $_POST["email"];
    $password = $_POST["password"];



    $user_data = $auth->attemptLogin($email, $password);
    // var_dump($user_data);

    if ($user_data) {
        $auth->login($user_data);
        // echo "login";

        if ($auth->isAdmin()) {
            header("Location: ../admin/deshboard.php");
            // echo "admin";
        } else {
            header("Location:../index.php");
            // echo "user";
        }
        exit();
    } else {
        echo "wrong email and password";
    }
}
?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            /* background:linear-gradient(135deg,#0d6efd,#6610f2); */
            font-family: Arial, sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: #fff;
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .15);
            overflow: hidden;
        }

        .card-header-custom {
            text-align: center;
            padding: 30px 20px;
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            color: #fff;
        }

        .logo {
            width: 70px;
            height: 70px;
            background: #fff;
            color: #0d6efd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            font-weight: bold;
            margin: 0 auto 15px;
        }

        .form-control {
            height: 50px;
            border-radius: 10px;
        }

        .btn-login {
            height: 50px;
            border-radius: 10px;
            font-weight: 600;
        }

        .admin-link {
            text-decoration: none;
            font-weight: 600;
        }

        .admin-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="card login-card">

        <div class="card-header-custom">
            <h3 class="mb-1">Admin login </h3>
        </div>

        <div class="card-body p-4">

            <form action="" method="post">

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input
                        type="email"
                        class="form-control"
                        name="email"
                        placeholder="Enter your email"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input
                        type="password"
                        class="form-control"
                        name="password"
                        placeholder="Enter your password"
                        required>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label">
                            Remember me
                        </label>
                    </div>

                    <a href="../index.php" class="text-decoration-none">
                        BACK HOME
                    </a>
                </div>

                <div class="d-grid">
                    <button type="submit" name="create" class="btn btn-primary btn-login">
                        Login
                    </button>
                </div>

            </form>

        </div>

    </div>

</body>

</html>