<!doctype html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Subsite | Evaluation of subject</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css" />    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">
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
                <a class="navbar-brand" href="/finzad/en">
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
                            <a class="nav-link" href="/finzad/en">Home</a>
                        </li>
                        <?php
						if(isset($_SESSION['username']))
                        {?>
                        <li class="nav-item">
                            <a class="nav-link" href="grade">Grade</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="agreegrade">Agreement of grade</a>
                        </li>
                        <?php
						if(isset($_SESSION['username']) && $_SESSION['role'] == "admin")
                        {?>
                        <li class="nav-item">
                            <a class="nav-link" href="sendlogininfo">Sending login info</a>
                        </li>
                        <?php } ?>
                        <?php } ?>
                    </ul>
                    <div class="my-2 my-lg-0 mr-3">
                        <div class="my-2 my-lg-0">
                            <div class="dropdown">
                                <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="flag-icon flag-icon-gb"></span> EN
                                </a>
                                
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="../sk/podstranka.php"><span class="flag-icon flag-icon-sk"></span> EN</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="my-2 my-lg-0">
                        <div class="my-2 my-lg-0">
                            <?php if(isset($_SESSION['username'])) { ?>
                            <div class="dropdown">
                                <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="img/user.png" height="25"><?php echo $_SESSION['username']; ?>
                                </a>
                                
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="logout.php">Odhlásiť sa</a>
                                </div>
                            </div>
                            <?php } else { ?>
                            <a class="btn btn-light" href="login.php" role="button">Prihlásiť sa</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container mt-4">
            <div class="row">
                <div class="col overflow-auto">
                    <table class="table">
						<thead>
							<tr>
								<th></th>
								<th colspan=6>Tasks</th>
							</tr>
							<tr>
								<th></th>
								<th>Design of website, basic routing, logging in a registration of users</th>
								<th>Task no. 1</th>
								<th>Task no. 2 - first part</th>
								<th>Task no. 2 - second part</th>
								<th>Task no. 3</th>
								<th>Final edits</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th>Anna Skachová</th>
								<td></td>
								<td><img src="checked.png" alt="Spravené"></td>
								<td></td>
								<td><img src="checked.png" alt="Spravené"></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<th>Dominik Raslavský</th>
								<td></td>
								<td><img src="checked.png" alt="Spravené"></td>
								<td></td>
								<td><img src="checked.png" alt="Spravené"></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<th>Denis Žuffa</th>
								<td><img src="checked.png" alt="Spravené"></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td><img src="checked.png" alt="Spravené"></td>
							</tr>
							<tr>
								<th>Zdenek Pichlík</th>
								<td></td>
								<td></td>
								<td><img src="checked.png" alt="Spravené"></td>
								<td></td>
								<td><img src="checked.png" alt="Spravené"></td>
								<td></td>
							</tr>
							<tr>
								<th>Balázs Bence Bertalan</th>
								<td></td>
								<td></td>
								<td><img src="checked.png" alt="Spravené"></td>
								<td></td>
								<td><img src="checked.png" alt="Spravené"></td>
								<td></td>
							</tr>
						</tbody>
					</table>
                </div>
            </div>
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
                        <li><a class="text-muted" href="../en/podstranka.php">Subsite</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>