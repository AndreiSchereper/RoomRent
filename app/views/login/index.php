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
                            <label for="email">Email Address</label>
                            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    include __DIR__ . '/../footer.php';
    ?>