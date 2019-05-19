<!doctype html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Evaluation of subject</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.png">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</head>

<?php
    include_once 'config.php';
?>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #013f78;">
            <div class="container">
                <a class="navbar-brand" href="/finzad">
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
                            <a class="nav-link" href="../en">Home</a>
						</li>
                    </ul>
                    <div class="my-2 my-lg-0 mr-3">
                        <div class="my-2 my-lg-0">
                            <div class="dropdown">
                                <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="flag-icon flag-icon-gb"></span> EN
                                </a>
                                
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="../sk/login.php"><span class="flag-icon flag-icon-sk"></span> SK</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="my-2 my-lg-0">
                        <div class="my-2 my-lg-0">
                            <a class="btn btn-light" href="login.php" role="button">Log in</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container mt-4">
        <?php
                session_start();
				if (isset($_POST['username']) && $_POST['submitregular']){
			        // removes backslashes
					$username = stripslashes($_REQUEST['username']);
                    $password = stripslashes($_REQUEST['password']);
                    
				    $sql = "SELECT * FROM `users` WHERE login='$username' AND type='regular'";
					$result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    if($row["id"]){
                        if(password_verify($password, $row["password"])) {
                            $_SESSION['username'] = $username;
                            $_SESSION['id'] = $row["id"];
                            $_SESSION['role'] = $row["role"];
                            $query = "INSERT into `history_login` (id_user, datetime_login)
                                        VALUES ('".$row["id"]."', NOW())";
                            mysqli_query($conn,$query);
                            header("Location: /finzad/en/");
                        } else{
                            echo "<div class='form'>
                            <h3>The login or password is incorrect.</h3>
                            <br/>Click here for <a href='login.php'>login</a></div>";
                        }
                    } else{
                        echo "<div class='form'>
                        <h3>The login or password is incorrect.</h3>
                        <br/>Click here for <a href='login.php'>login</a></div>";
                    }
			    }
			    else if (isset($_POST['username']) && $_POST['submitldap']) {
			    	$username = stripslashes($_REQUEST['username']);
					$password = stripslashes($_REQUEST['password']);
					$ldapuid = $username;

					$ldapconn = ldap_connect("ldap.stuba.sk")
					    or die("Could not connect to LDAP server.");

					$dn  = 'ou=People, DC=stuba, DC=sk';
					$ldaprdn  = "uid=$ldapuid, $dn";     

					$set = ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
					$ldapbind = ldap_bind($ldapconn, $ldaprdn, $password);

					// verify binding
					if ($ldapbind) {
                        $sql = "SELECT * FROM `users` WHERE login='$username' AND type='ldap'";
						$result = $conn->query($sql);
						$row = $result->fetch_assoc();
						$id = 0;
					    if($row["id"]){
					    	$query = "INSERT into `history_login` (id_user, datetime_login)
										VALUES ('".$row["id"]."', NOW())";
                            $id = $row["id"];
                            $role = $row["role"];
                            $id_ais = $row["id_ais"];
							mysqli_query($conn,$query);
					    } else {
                            $ldapFilter = array("uid", "uisid");
                            $ldapSearchResult = @ldap_search($ldapconn, $dn, 'uid='.$username, $ldapFilter);
                            
                            $result = @ldap_get_entries($ldapconn, $ldapSearchResult);
                            $ais_user = $result[0]['uid'][0];   
                            $ais_id = $result[0]['uisid'][0];

					    	$query = "INSERT into `users` (login, created_at, type, email, role, id_ais)
								VALUES ('$username', NOW(), 'ldap', '$ais_user@is.stuba.sk', 'student', $ais_id)";
					        $result = mysqli_query($conn,$query);
					        $sql = "SELECT * FROM `users` WHERE login='$username' AND type='ldap'";
							$result2 = $conn->query($sql);
							$row2 = $result2->fetch_assoc();
							$query = "INSERT into `history_login` (id_user, datetime_login)
										VALUES ('".$row2["id"]."', NOW())";
                            $id = $row2["id"];
                            $role = $row2['role'];
                            $id_ais = $row2["id_ais"];
							mysqli_query($conn,$query);
					    }
					    $_SESSION['username'] = $username;
                        $_SESSION['id'] = $id;
                        $_SESSION['role'] = $role;
                        $_SESSION['id_ais'] = $id_ais;
					    header("Location: /finzad/en/");
					} else {
					    echo "<div class='form'>
							<h3>The login or password is incorrect.</h3>
							<br/>Click here for <a href='login.php'>login</a></div>";
					}
			    }
			    else if ($_SESSION['username']) {
					header("Location: /finzad/en/");
			    }
			    else{
			?>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Login</div>

                        <div class="card-body">
                            <form method="POST">
                                <div class="form-group row">
                                    <label for="username" class="col-md-4 col-form-label text-md-right">Login</label>

                                    <div class="col-md-6">
                                        <input id="username" type="text" class="form-control" name="username" required autocomplete="username" autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <input type="submit" name="submitregular" class="btn btn-primary" value="Log in local">
                                        <input type="submit" name="submitldap" class="btn btn-primary" value="Log in via LDAP STUBA">
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
                    <span class="d-block mb-3 text-muted">Made by Denis Žuffa, Anna Skachová, Dominik Raslavský, Balázs Bence Bertalan, Zdenek Pichlík</span>
                </div>

            </div>
            <div class="row mt-4">
                <div class="col-6 col-md">
                    <h5>About website</h5>
                    <ul class="list-unstyled text-small">
                        <li class="text-muted">Source of icons:
                            <a href="https://www.flaticon.com/" title="Flaticon" class="text-muted">www.flaticon.com</a>,
                            <a href="https://www.freepik.com/" class="text-muted">https://material.io</a>
                        </li>
                        <li><a class="text-muted" href="../sk/podstranka.php">Subsite</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>