<!doctype html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration | Evaluation of subject</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css" />
    <link rel="shortcut icon" href="img/favicon.png">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</head>

<?php
    include_once 'config.php';  
    session_start(); 
?>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #013f78;">
            <div class="container">
                <a class="navbar-brand" href="../">
                    <img src="img/main-icon.png" width="30" height="30" class="d-inline-block align-top" alt="">
                    Evaluation of subject
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="grade">Grade</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="agreegrade">Agreement of grade</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="sendlogininfo">Sending login info</a>
                        </li>
                    </ul>
                    <div-- class="my-2 my-lg-0">
                        <a class="btn btn-light" href="login.php" role="button">Log in</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container mt-4">
        <?php
                session_start();
				if (isset($_REQUEST['username'])){
                    $username = stripslashes($_REQUEST['username']);
                    $email = stripslashes($_REQUEST['email']);
                    $password = stripslashes($_REQUEST['password']);
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $trn_date = date("Y-m-d H:i:s");
                    $sql = "SELECT COUNT(id) AS count FROM `users` WHERE login = '$username' OR email = '$email'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    if ($row['count'] != 0) {
                        echo "<div class='form'>
                                    <h3>Login or email already exists.</h3>
                                    <br/>Click here for <a href='login.php'>login</a></div>";
                        form();
                    } else {
                        $query = "INSERT into `users` (login, password, email, created_at, role, type)
                                VALUES ('$username', '$hashed_password', '$email', '$trn_date', 'admin', 'regular')";
                        $result = mysqli_query($conn,$query);
                        if($result){
                            echo "<div class='form'>
                                    <h3>You have successfully registered.</h3>
                                    <br/>Click here for <a href='login.php'>login</a></div>";
                        }
                    } 
                } else {
                    form();
                }
            ?>
        <?php function form() {
            echo''
            ?>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Registration of admin</div>

                        <div class="card-body">
                            <form method="POST">
                                <div class="form-group row">
                                    <label for="username" class="col-md-4 col-form-label text-md-right">Login</label>

                                    <div class="col-md-6">
                                        <input id="username" type="text" class="form-control" name="username" placeholder="Login" required autocomplete="username" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" placeholder="Password" required autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password again</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password2" placeholder="Password znova " required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <input type="submit" name="submit" class="btn btn-primary" value="Register">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php }
			?>
        </div>
    </main>
    
    <footer class="mt-4 pt-4 border-top">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md">
                    <img class="mb-2" src="img/favicon.png" alt="" width="24" height="24">
                    <small class="d-block mb-3 text-muted">© 2019</small>
                    <span class="d-block mb-3 text-muted">Vytvorili: Denis Žuffa, Anna Skachová, Dominik Raslavský, Balázs Bence Bertalan, Zdenek Pichlík</span>
                </div>

            </div>
            <div class="row mt-4">
                <div class="col-6 col-md">
                    <h5>O stránke</h5>
                    <ul class="list-unstyled text-small">
                        <li class="text-muted">Zdroje ikon:
                            <a href="https://www.flaticon.com/" title="Flaticon" class="text-muted">www.flaticon.com</a>,
                            <a href="https://www.freepik.com/" class="text-muted">https://material.io</a>
                        </li>
                        <li><a class="text-muted" href="#">Kontakt</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>