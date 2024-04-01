<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="app\public\css\styles.css">
</head>

<body>
    <?php
    include __DIR__ . '/../header.php';
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4 mt-5">
                <div class="login-panel">
                    <div class="login-header text-center mb-4">
                        <h2>Log in</h2>
                    </div>
                    <?php
                    if (isset($_SESSION['errorMessage'])) {
                        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['errorMessage'] . '</div>';
                        unset($_SESSION['errorMessage']);
                    }
                    ?>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                        <div class="login-footer mt-4 text-center">
                            <a href="#">Forgot Password?</a> | <a href="#">Register</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <?php
    include __DIR__ . '/../footer.php';
    ?>