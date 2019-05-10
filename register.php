<!doctype html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrácia | Hodnotenie predmetu</title>
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
                    Hodnotenie predmetu
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="">Domov</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="grade">Hodnotenie</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="agreegrade">Súhlas hodnotenia</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="sendlogininfo">Rozposielanie údajov</a>
                        </li>
                    </ul>
                    <div-- class="my-2 my-lg-0">
                        <a class="btn btn-light" href="login.php" role="button">Prihlásiť sa</a>
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
                                    <h3>Zadaný login alebo email už existuje.</h3>
                                    <br/>Kliknite tu pre <a href='login.php'>prihlásenie</a></div>";
                        form();
                    } else {
                        $query = "INSERT into `users` (login, password, email, created_at, role, type)
                                VALUES ('$username', '$hashed_password', '$email', '$trn_date', 'admin', 'regular')";
                        $result = mysqli_query($conn,$query);
                        if($result){
                            echo "<div class='form'>
                                    <h3>Úspešne ste sa registrovali.</h3>
                                    <br/>Kliknite tu pre <a href='login.php'>prihlásenie</a></div>";
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
                        <div class="card-header">Registrácia administrátora</div>

                        <div class="card-body">
                            <form method="POST">
                                <div class="form-group row">
                                    <label for="username" class="col-md-4 col-form-label text-md-right">Prihlasovacie meno</label>

                                    <div class="col-md-6">
                                        <input id="username" type="text" class="form-control" name="username" placeholder="Prihlasovacie meno" required autocomplete="username" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Heslo</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" placeholder="Heslo" required autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Zadajte heslo znova</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password2" placeholder="Heslo znova " required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <input type="submit" name="submit" class="btn btn-primary" value="Registrovať">
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