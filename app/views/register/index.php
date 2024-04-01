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
                <div class="register-panel">
                    <div class="register-header text-center mb-4">
                        <h2>Sign Up</h2>
                    </div>
                    <form>
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" placeholder="Enter first name">
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" placeholder="Enter last name">
                        </div>
                        <div class="form-group">
                            <label for="emailRegister">Email address</label>
                            <input type="email" class="form-control" id="emailRegister" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="passwordRegister">Password</label>
                            <input type="password" class="form-control" id="passwordRegister" placeholder="Password">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    include __DIR__ . '/../footer.php';
    ?>