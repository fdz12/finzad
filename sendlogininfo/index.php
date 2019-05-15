<!doctype html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rozposielanie údajov | Hodnotenie predmetu</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/jquery-ui.min.css" />
    <link rel="shortcut icon" href="../img/favicon.png">
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/script.js"></script>
</head>

<?php
    include_once 'config.php';
    session_start(); 
?>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #013f78;">
            <div class="container">
                <a class="navbar-brand" href="">
                    <img src="../img/main-icon.png" width="30" height="30" class="d-inline-block align-top" alt="">
                    Hodnotenie predmetu
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../">Domov</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../grade">Hodnotenie</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="../agreegrade">Súhlas hodnotenia</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="../sendlogininfo">Rozposielanie údajov</a>
                        </li>
                    </ul>
                    <div class="my-2 my-lg-0">
                        <div class="my-2 my-lg-0">
                            <?php if(isset($_SESSION['username'])) { ?>
                            <div class="dropdown">
                                <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="../img/user.png" height="25"><?php echo $_SESSION['username']; ?>
                                </a>
                                
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="../logout.php">Odhlásiť sa</a>
                                </div>
                            </div>
                            <?php } else { ?>
                            <a class="btn btn-light" href="../login.php" role="button">Prihlásiť sa</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container mt-4">
            <section>
                <h4>Rozposielanie údajov</h4>
            </section>
			<section>
				<?php
					// POST //////////////
					if (isset($_POST['submit1'])){
						//get delimiter
						if($_POST['delim'] == "comma")
							$delimiter1 = ",";
						if($_POST['delim'] == "dotcoma")
							$delimiter1 = ";";
						//get file
						$filename1 = $_FILES['userfile']['name'];
						//upload file
						$returning1 = fileupload($filename1);
						//generate passwords
						$returning1 .= passgenerate($filename1, $delimiter1);
					}
					///////
					if (isset($_POST['submit2'])){
						
					}
				
					//file upload ///////////////////////////////////////////////////////////////////
					function fileupload($userfile){
						$uploadfile = getcwd()."/". $userfile;
						//echo $uploadfile;
						
						if (file_exists($uploadfile))
							  unlink(getcwd()."/".$userfile);

						if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $uploadfile)) {
								  return ("Súbor bol úspešne pridaný\n");
						} else{
								  return "Chyba pri nahrávaní súboru!\n";
						}
					}
					/////////////////////////////////////////////////////////////////////////////////
				
					//generate passwords ////////////////////////////////////////////////////////////
					function passgenerate($filename, $delim){
						chmod($filename, 0777);
						$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						$first=0;
						
						//read
						$newCsvData = array();
						if (($handle = fopen($filename, "r")) !== FALSE) {
							
							while (($data = fgetcsv($handle, 1000, $delim)) !== FALSE) {
								if($first==0){
									$data[] = 'heslo';
									$first=1;
								}
								else{
									$randstring = '';
									for ($i = 0; $i < 15; $i++) {
        								$randstring .= $characters[rand(0, strlen($characters))];
    								}
									$data[] = $randstring;
								}
								$newCsvData[] = $data;
							}
							fclose($handle);
					
						}

						//write
						$handle = fopen($filename, 'w');

						foreach ($newCsvData as $line) {
						   fputcsv($handle, $line, $delim);
						}

						fclose($handle);
						return "<br><a href=".$filename.">Stiahnutie</a>";
					}
					/////////////////////////////////////////////////////////////////////////////////
					
					// MAIN
					if(isset($_SESSION['username']) && $_SESSION['role'] == "admin"){
						echo "<br><h5>Generovanie hesiel</h5>";
						echo "	<form enctype='multipart/form-data' action='index.php' method='POST'>
									<label> Oddeľovač </label> 
									<label> Vyberte súbor </label> <input type='file' name='userfile' accept='.csv' required /> <br>
									<label><input type='radio' name='delim' value='coma' required> čiarka </label>
									<label><input type='radio' name='delim' value='dotcoma' required> bodkočiarka </label> <br>
									<input type='submit' name='submit1' value='Import' /> 
								</form>";
						echo $returning1."<hr>";
						echo "<h5>Rozposlanie údajov</h5>";
					}	
				?>
			</section>
        </div>
    </main>
    
    <footer class="mt-4 pt-4 border-top">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md">
                    <img class="mb-2" src="../img/favicon.png" alt="" width="24" height="24">
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