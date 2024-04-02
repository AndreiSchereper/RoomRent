<?php
    include __DIR__ . '/../header.php';
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4 mt-5">
                <div class="register-panel">
                    <div class="register-header text-center mb-4">
                        <h2>Register</h2>
                    </div>
                    <?php
                    if (isset($_SESSION['errorMessage'])) {
                        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['errorMessage'] . '</div>';
                        unset($_SESSION['errorMessage']);
                    }
                    ?>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" name="firstName" class="form-control" id="firstName" placeholder="Enter first name">
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Enter last name">
                        </div>
                        <div class="form-group">
                            <label for="emailRegister">Email address</label>
                            <input type="email" name="email" class="form-control" id="emailRegister" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="passwordRegister">Password</label>
                            <input type="password" name="password" class="form-control" id="passwordRegister" placeholder="Password">
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