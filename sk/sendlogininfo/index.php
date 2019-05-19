<!doctype html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rozposielanie údajov | Hodnotenie predmetu</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/jquery-ui.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../img/favicon.png">
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/script.js"></script>
	
	<!--table sorting-->
	<script src="sort.js"></script>

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
					<div class="my-2 my-lg-0 mr-3">
                        <div class="my-2 my-lg-0">
                            <div class="dropdown">
                                <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="flag-icon flag-icon-sk"></span> SK
                                </a>
                                
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="../../en/sendlogininfo"><span class="flag-icon flag-icon-gb"></span> EN</a>
                                </div>
                            </div>
                        </div>
                    </div>
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
					// Import PHPMailer classes into the global namespace
					use PHPMailer\PHPMailer\PHPMailer;
					use PHPMailer\PHPMailer\Exception;
				
					include "../config.php";
					$conn = new mysqli($servername, $username, $password, $dbname);
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}
					mysqli_set_charset($conn,"utf8");
				
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
						$fileName2 = $_FILES['userfile']['name'];
						
						if($_POST['delim'] == "comma")
							$delimiter2 = ",";
						if($_POST['delim'] == "dotcoma")
							$delimiter2 = ";";
						
						$sendername = $_POST['sendername'];
						$senderpassword = $_POST['senderpass'];
						$senderemail = $_POST['senderemail'];
						$sablonID = $_POST['sablon'];
						$title = $_POST['nazovspravy'];
						//priloha
						$fileName3 = $_FILES['atachment']['name'];
						
						$returning2 = fileupload($fileName2);
						
						if(isset($fileName3))
							fileupload($fileName3);
						prepareMail($fileName2, $delimiter2, $sablonID, $sendername,$senderpassword,$senderemail,$title,$filename3);
					}
				
					if (isset($_POST['submit3'])){
						$fileName2 = $_FILES['userfile']['name'];
						$_SESSION['filename'] = $fileName2;
						
						if($_POST['delim'] == "comma")
							$_SESSION['delimiter'] = ",";
						if($_POST['delim'] == "dotcoma")
							$_SESSION['delimiter'] = ";";
						
						$_SESSION['sendername'] = $_POST['sendername'];
						$_SESSION['senderpassword'] = $_POST['senderpass'];
						$_SESSION['senderemail'] = $_POST['senderemail'];
						$sablonID = $_POST['sablon'];
						$_SESSION['title'] = $_POST['nazovspravy'];
						//priloha
						$fileName3 = $_FILES['atachment']['name'];
						
						$returning2 = fileupload($fileName2);
						
						if(isset($fileName3))
							fileupload($fileName3);
						$sablona = prepareHTML($sablonID);
					}
				
					if (isset($_POST['submit4'])){
						$emailcol=0;
						
						$sendername = $_SESSION['sendername'];
						$senderpassword = $_SESSION['senderpassword'];
						$senderemail = $_SESSION['senderemail'];
						$title = $_SESSION['title'];
						
						if (($handle = fopen($_SESSION['filename'], "r")) !== FALSE) {	
							
							if(($datatypes = fgetcsv($handle, 1000, $_SESSION['delimiter'])) !== FALSE)
							
							while (($data = fgetcsv($handle, 1000, $_SESSION['delimiter'])) !== FALSE) {
								$text = $_POST['texthtml'];
								
								for($i=0; $i<count($data); $i++){
									$text = str_replace("{{".$datatypes[$i]."}}",$data[$i],$text);
									if($datatypes[$i]=="Email")
										$emailcol=$i;
								}
								$text = str_replace("{{sender}}",$sendername,$text);
								
								if($datatypes[$i] == "meno"){
										$meno = $data[$i];
										$datum = date("Y-m-d");			
										$sql2 = "INSERT INTO mail (datum, meno, predmet, id_sablon) VALUES ('". $datum ."', '". $meno ."', '". $title ."', '". $sablonID ."')";
										mysqli_query($conn, $sql2);
								}
								sendHTML($sendername,$senderpassword,$senderemail,$title,$atachment,$text,$data[$emailcol]);
							}
							fclose($handle);
						}
							unlink(getcwd()."/".$_SESSION['filename']);
												
						$_SESSION['filename'] = NULL;					
						$_SESSION['delimiter'] = NULL;
						$_SESSION['sendername'] = NULL;
						$_SESSION['senderpassword'] = NULL;
						$_SESSION['senderemail'] = NULL;
						$_SESSION['title'] = NULL;
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
					
				///////////////////////////////////////////////////////////////////////////////////////////
					function prepareMail($fileName2, $delim, $sablonID,$sendername,$senderpassword,$senderemail,$title,$atachment){
						$emailcol=0;

						if (($handle = fopen($fileName2, "r")) !== FALSE) {	
							
							include "../config.php";
							$conn = new mysqli($servername, $username, $password, $dbname);
							if ($conn->connect_error) {
								die("Connection failed: " . $conn->connect_error);
							}
							mysqli_set_charset($conn,"utf8");
							
							$sql = "SELECT Sablona FROM sablon WHERE ID=".$sablonID;
							$result = mysqli_query($conn, $sql);
							if (mysqli_num_rows($result) > 0) {
								$sablon = mysqli_fetch_assoc($result);
							}
							
							if(($datatypes = fgetcsv($handle, 1000, $delim)) !== FALSE)
							
							while (($data = fgetcsv($handle, 1000, $delim)) !== FALSE) {
								$text = $sablon['Sablona'];
								
								for($i=0; $i<count($data); $i++){
									$text = str_replace("{{".$datatypes[$i]."}}",$data[$i],$text);

									if($datatypes[$i] == "meno"){
										$meno = $data[$i];
										$datum = date("Y-m-d");			
										$sql2 = "INSERT INTO mail (datum, meno, predmet, id_sablon) VALUES ('". $datum ."', '". $meno ."', '". $title ."', '". $sablonID ."')";
										mysqli_query($conn, $sql2);
									}

									if($datatypes[$i]=="Email")
										$emailcol=$i;

								}
								$text = str_replace("{{sender}}",$sendername,$text);
								sendMail($sendername,$senderpassword,$senderemail,$title,$atachment,$text,$data[$emailcol]);
							}
							
							fclose($handle);
							unlink(getcwd()."/".$fileName2);
						}
					}
				
					function prepareHTML($sablonID){
							
							include "../config.php";
							$conn = new mysqli($servername, $username, $password, $dbname);
							if ($conn->connect_error) {
								die("Connection failed: " . $conn->connect_error);
							}
							mysqli_set_charset($conn,"utf8");
							
							$sql = "SELECT Sablona FROM sablon WHERE ID=".$sablonID;
							$result = mysqli_query($conn, $sql);
							if (mysqli_num_rows($result) > 0) {
								$sablon = mysqli_fetch_assoc($result);
							}
							
						return $sablon['Sablona'];
					}
					
					/////////////////////////////////////////////////////////////////////////////////////////
					function sendMail($sendername,$senderpassword,$senderemail,$title,$atachment,$text,$sendto){
						
						// Load Composer's autoloader
						require '../vendor/autoload.php';

						// Instantiation and passing `true` enables exceptions
						$mail = new PHPMailer(true);
						$mail->Encoding = 'base64';
						$mail->CharSet = 'utf-8';
						
						$mail->isSMTP(); // Set mailer to use SMTP
						$mail->Host = 'mail.stuba.sk';
						$mail->SMTPAuth   = true; // Enable SMTP authentication
						$mail->Username   = $senderemail; // SMTP username
						$mail->Password   = $senderpassword; // SMTP password
						$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
						$mail->Port       = 587; // TCP port to connect to
						
						$mail->setFrom($senderemail, $sendername);
						$mail->addAddress($sendto); 
						$mail->Subject = $title;
						$mail->Body = $text;
						if(isset($atachment))
							$mail->addAttachment($atachment);
						$mail->send();

						if(isset($atachment))
							unlink(getcwd()."/".$atachment);
					}
						
					function sendHTML($sendername,$senderpassword,$senderemail,$title,$atachment,$text,$sendto){
						
						// Load Composer's autoloader
						require '../vendor/autoload.php';

						// Instantiation and passing `true` enables exceptions
						$mail = new PHPMailer(true);
						$mail->Encoding = 'base64';
						$mail->CharSet = 'utf-8';
						
						$mail->isSMTP(); // Set mailer to use SMTP
						$mail->Host = 'mail.stuba.sk';
						$mail->SMTPAuth   = true; // Enable SMTP authentication
						$mail->Username   = $senderemail; // SMTP username
						$mail->Password   = $senderpassword; // SMTP password
						$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
						$mail->Port       = 587; // TCP port to connect to
						
						$mail->setFrom($senderemail, $sendername);
						$mail->addAddress($sendto);
						$mail->isHTML(true);   
						$mail->Subject = $title;
						$mail->Body = $text;
						if(isset($atachment))
							$mail->addAttachment($atachment);
						$mail->send();

						if(isset($atachment))
							unlink(getcwd()."/".$atachment);
					}
					/////////////////////////////////////////////////////////////////////////////////
					
					// MAIN
					if(isset($_SESSION['username']) && $_SESSION['role'] == "admin" && !isset($_POST['submit3'])){
						echo "<br><h5>Generovanie hesiel</h5>";
						echo "	<form enctype='multipart/form-data' action='index.php' method='POST'>
									
									<label> Vyberte súbor </label> <input type='file' name='userfile' accept='.csv' required /> <br>
									<label> Oddeľovač </label> 
									<label><input type='radio' name='delim' value='coma' required> čiarka </label>
									<label><input type='radio' name='delim' value='dotcoma' required> bodkočiarka </label> <br>
									<input type='submit' name='submit1' value='Import' /> 
								</form>";
						echo $returning1."<hr>";
						echo "<h5>Rozposlanie údajov</h5>";
						echo "	<form enctype='multipart/form-data' action='index.php' method='POST'>
									<label> Vyberte súbor </label> <input type='file' name='userfile' accept='.csv' required /> <br>
									<label> Oddeľovač </label> 
									<label><input type='radio' name='delim' value='coma' required> čiarka </label>
									<label><input type='radio' name='delim' value='dotcoma' required> bodkočiarka </label> 
									<br>
									<h6>Odosielatel</h6>
									<label> Meno <input type='text' name='sendername' required></label> <br>
									<label> Heslo <input type='password' name='senderpass' required></label> <br>
									<label> Email <input type='text' name='senderemail' required></label> <br>";
									
						echo "<h6>Správa</h6>
							<label>Šablóna: <select name=\"sablon\">";
							
							$sql = "SELECT ID,name FROM sablon WHERE 1";
							$result = mysqli_query($conn, $sql);
							while ($row = $result->fetch_assoc()) {
								echo "<option value=\"".$row['ID']."\">".$row['name']."</option>";
							}
  										
						echo "</select></label><br>
								<label>Názov správy: <input type='text' name='nazovspravy' required></label><br>
								<label>Príloha: <input type='file' name='atachment'/> </label> <br>
								<input type='submit' name='submit2' value='Poslať ako plain text'>
								<input type='submit' name='submit3' value='Poslať ako html'>
							</form>";
						echo $returning2."<hr>";
						
						echo "<h5>Odoslané maily</h5>";
						$sql3 = "Select datum, meno, predmet, id_sablon from mail";
						$result3 = mysqli_query($conn, $sql3);
						
						echo "<table class=\"sortable\"><tr><th>Dátum</th><th>Meno</th><th>Predmet správy</th><th>Šablón</th></tr>";
						
						while($rowstat = $result3->fetch_assoc()){
							echo "<tr><td>".$rowstat['datum']."</td><td>".$rowstat['meno']."</td><td>".$rowstat['predmet']."</td><td>".$rowstat['id_sablon']."</td></tr>";
						}
						
						echo "</table>";
						
					}	
					if(isset($_SESSION['username']) && $_SESSION['role'] == "admin" && isset($_POST['submit3'])){
						echo "<form enctype='multipart/form-data' action='index.php' method='POST'>";
						echo "<script type=\"text/javascript\" src=\"http://js.nicedit.com/nicEdit-latest.js\"></script> 
						<script type=\"text/javascript\"> bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });</script><textarea name=\"texthtml\" cols=\"100\" rows=\"10\">";
						echo $sablona;
						echo "</textarea><br>";
						echo "<input type='submit' name='submit4' value='Poslať'></form>";
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