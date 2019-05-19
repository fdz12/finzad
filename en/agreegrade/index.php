<!doctype html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agreement of grade | Evaluation of subject</title>
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
</head>

<?php
    include_once '../config.php';
    session_start();
?>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #013f78;">
            <div class="container">
                <a class="navbar-brand" href="../">
                    <img src="../img/main-icon.png" width="30" height="30" class="d-inline-block align-top" alt="">
                    Evaluation of subject
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../grade">Grade</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="../agreegrade">Agreement of grade</a>
						</li>
						<?php
						if(isset($_SESSION['username']) && $_SESSION['role'] == "admin")
						{?>
                        <li class="nav-item">
                            <a class="nav-link" href="../sendlogininfo">Sending login info</a>
						</li>
						<?php } ?>
					</ul>
					<div class="my-2 my-lg-0 mr-3">
                        <div class="my-2 my-lg-0">
                            <div class="dropdown">
                                <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="flag-icon flag-icon-gb"></span> EN
                                </a>
                                
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="../../sk/agreegrade"><span class="flag-icon flag-icon-sk"></span> SK</a>
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
                                    <a class="dropdown-item" href="../logout.php">Log out</a>
                                </div>
                            </div>
                            <?php } else { ?>
                            <a class="btn btn-light" href="../login.php" role="button">Log in</a>
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
				<div class="col">
					<h4>Agreement of grade</h4>
				</div>
			</div>
			<div class="row">
				<div class="col">
				
				<?php
					// ak je session urobená a je adminom
					if(isset($_SESSION['username']) && $_SESSION['role'] == "admin")
					{
						?>	
					<h5>Import</h5>
					<form enctype='multipart/form-data' action='index.php' method='POST'>
						<div class="form-group">
							<label for="year">School year</label>
							<select class="form-control" name="year" id="year" required>
								<option value='2018/2019'>2018/2019</option>
								<option value='2017/2018'>2017/2018</option>
								<option value='2016/2017'>2016/2017</option>
								<option value='2015/2016'>2015/2016</option>
								<option value='2014/2015'>2014/2015</option>
							</select>
						</div>
						<div class="form-group">
							<label for="subject">Subject name</label>
							<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject name" required>
						</div>
						<div class="form-group">
							<label for="userfile">Choose a file</label>
							<input type="file" class="form-control" name="userfile" id="userfile" required>
						</div>
						<label>
							Separator
						</label>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="delim" id="coma" value="coma" required>
							<label class="form-check-label" for="coma">
								comma
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="delim" id="dotcoma" value="coma" required>
							<label class="form-check-label" for="dotcoma">
								semicolon
							</label>
						</div>
						<input type='submit' name='submit' class="btn btn-primary mt-3" value='Import'> 
					</form>
				</div>
			</div>
			<div class="row my-5">
				<div class="col">
					<h5>View grade</h5>
					<?php
						
						function uploadFile($userfile){
						
							$uploadfile = getcwd()."/". $userfile;
							
							if (file_exists($uploadfile)){
								  echo "File with name $uploadfile exists\n";
								} 
							  else{
								  if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $uploadfile)) {
									  echo "File was uploaded to directory Files\n";
								  } else{
									  echo "Error while uploading a file!\n";
								  }
							  }
							echo "userfile".$uploadfile;

						}

						
						if (isset($_POST['submit'])){
							   
					
							$year = $_POST['year'];
							$subject = $_POST['subject'];
							$separator = $_POST['delim'];
							$delim = "";

							if($separator == "coma") $delim = ",";
							if($separator == "dotcoma") $delim = ";";

							//echo "toto je delim ".$delim;
							//echo $subject.$year.$separator;

							// pri kazdom vkladani udajov vymaz tabulku
							//mysqli_query($conn,'TRUNCATE TABLE student');

							$filename = $_FILES['userfile']['name'];
							uploadfile($filename);
							// cela cesta k suboru
							//$path = realpath($filename);
							//echo $path;

							// subor musi byt na servri
							// https://stackoverflow.com/questions/2805427/how-to-extract-data-from-csv-file-in-php
							// CITANIE S CSV    
							if (($handle = fopen($filename, "r")) !== FALSE) {
								//echo "<br>otvoril subor<br>";
								$idPridanehoTimu = array();
								while (($data = fgetcsv($handle, 1000, $delim)) !== FALSE) {
									
									//ak neexistuje tím s daným id tak ho vytvor
									$sqlTim = "select id_timu from team where cislo_timu=$data[4] AND predmet= '" .$_POST['subject'] . "' AND rok= '$year'"; 
									$resultTim = mysqli_query($conn, $sqlTim);
									if (mysqli_num_rows($resultTim) == 0) {
										$sqlTim = "INSERT INTO team (cislo_timu, predmet, rok) VALUES ($data[4], '" . $_POST['subject'] . "', '$year')";
										mysqli_query($conn, $sqlTim);
										
										$sqlIdTimu = "select id_timu from team where cislo_timu=$data[4] AND predmet= '" .$_POST['subject'] . "' AND rok= '$year'"; 
										$resultID = mysqli_query($conn, $sqlIdTimu);  
										$pomID = mysqli_fetch_assoc($resultID);
										$idTimu = $pomID['id_timu'];
										array_push($idPridanehoTimu, $idTimu);
										
										//vytvor riadok v tabulke student
										$pom = (int) filter_var($data[0], FILTER_SANITIZE_NUMBER_INT); //toto tu je lebo inak nevedelo pridať prvý záznam z .csv do tabuľky
										//$sql = "INSERT INTO student (id_student, meno, email, heslo, tim) VALUES ($pom, '".$data[1]."', '".$data[2]."', '".$data[3]."', $data[4])";
										$sql = "INSERT INTO student (id_student, tim) VALUES ($pom, $idTimu)";
										$result = mysqli_query($conn, $sql);
								   
										//vytvor uzivatela
										$timestamp = date('Y-m-d H:i:s');
										$sqlUzivatel = "";
										$pieces = explode("@", $data[2]);
										if($data[3] != "NULL")
										{
											$hashed_password = password_hash($data[3], PASSWORD_DEFAULT);
											$sqlUzivatel = "INSERT INTO users (id_ais, login, name, email, password, type, role, created_at) VALUES ($pom, '".$pieces[0]."', '".$data[1]."', '".$data[2]."', '".$hashed_password."', 'regular', 'student', '$timestamp')";
										}
										else
											$sqlUzivatel = "INSERT INTO users (id_ais, login, name, email, type, role, created_at) VALUES ($pom, '".$pieces[0]."', '".$data[1]."', '".$data[2]."', 'ldap', 'student', '$timestamp')";
									
										$result = mysqli_query($conn, $sqlUzivatel);
									}
									else if (mysqli_num_rows($resultTim) == 1)
									{
										$pomID = mysqli_fetch_assoc($resultTim);								
										$idTimu = $pomID['id_timu'];
										$pieces = explode("@", $data[2]);
										if(in_array($idTimu, $idPridanehoTimu))
										{
											//vytvor riadok v tabulke student
											$pom = (int) filter_var($data[0], FILTER_SANITIZE_NUMBER_INT); //toto tu je lebo inak nevedelo pridať prvý záznam z .csv do tabuľky
											//$sql = "INSERT INTO student (id_student, meno, email, heslo, tim) VALUES ($pom, '".$data[1]."', '".$data[2]."', '".$data[3]."', $data[4])";
											$sql = "INSERT INTO student (id_student, tim) VALUES ($pom, $idTimu)";
											$result = mysqli_query($conn, $sql);
								   
											//vytvor uzivatela
											$timestamp = date('Y-m-d H:i:s');
											$sqlUzivatel = "";
											if($data[3] != "NULL")
											{
												$hashed_password = password_hash($data[3], PASSWORD_DEFAULT);
												$sqlUzivatel = "INSERT INTO users (id_ais, login, name, email, password, type, role, created_at) VALUES ($pom, '".$pieces[0]."', '".$data[1]."', '".$data[2]."', '".$hashed_password."', 'regular', 'student', '$timestamp')";
											}
											else
												$sqlUzivatel = "INSERT INTO users (id_ais, login, name, email, type, role, created_at) VALUES ($pom, '".$pieces[0]."', '".$data[1]."', '".$data[2]."', 'ldap', 'student', '$timestamp')";
									
											$result = mysqli_query($conn, $sqlUzivatel);
										}
									}
								   
								}
								fclose($handle);
							}
						unlink(getcwd()."/".$filename);    // odstran subor po precitani

						}	
						
						if(isset($_POST['change'])) //ak boli nastavené body
						{
							$sqlPridajBody = "UPDATE team SET body='$_POST[body]' WHERE id_timu='$_POST[idTimu]'";
							mysqli_query($conn, $sqlPridajBody);
						}
						
						if(isset($_POST['suhlas'])) //ak bol stlačený úhlas tak to odsúhlasí
						{
							$sqlNastavSuhlas = "UPDATE team SET odsuhlasene='Áno' WHERE id_timu='$_POST[idTimu]'";
							mysqli_query($conn, $sqlNastavSuhlas);
						}
						
						if(isset($_POST['nesuhlas'])) //ak bol stlačený nesúhlas tak resetuje body i súhlasy
						{
							$sqlNastavSuhlas = "UPDATE team SET odsuhlasene='Nie' WHERE id_timu='$_POST[idTimu]'";
							mysqli_query($conn, $sqlNastavSuhlas);
						}
						
						//Ak existujú záznamy pre nejaký predmet ukáž tlačidlo na ich zobrazenie.
						$predmet = "";
						$rok = "";
						$existujePredmet = "false";
						$sqlPredmety = "Select distinct predmet, rok from team";
						$resultPredmety = mysqli_query($conn, $sqlPredmety);
						if (mysqli_num_rows($resultPredmety) > 0) 
						{		
							$existujePredmet = "true";
							echo "<div class='mb-4'><form enctype='multipart/form-data' action='index.php' method='GET'>";
							echo "<div class='form-group'><select name='predmet' class='form-control' required>";
							while($rowP = mysqli_fetch_assoc($resultPredmety)) 
							{
								if ($rowP['predmet'] == $_GET['predmet']){
									echo "<option value=". $rowP['predmet'] ."-" . $rowP['rok'] . " selected>". $rowP['predmet'] . ", " . $rowP['rok'] . "</option>";
								} else {
									echo "<option value=". $rowP['predmet'] ."-" . $rowP['rok'] . ">". $rowP['predmet'] . ", " . $rowP['rok'] . "</option>";
								}
								$predmet = $rowP['predmet'];
								$rok = $rowP['rok'];
							}
							echo "</select></div>";
							echo "<input type='submit' value='Show teams' class='btn btn-primary'> ";
							echo "</form></div>";					
						}
											
					
						if (isset($_GET['predmet']))
						{
							// VYPISANIE DO TABULIEK	
							$pomocna = explode('-', $_GET['predmet']);
							$predmet = $pomocna[0];
							$rok = $pomocna[1];
						}
						
						if ($existujePredmet == "true")
						{
							echo "<h2><u>" . $predmet .", " . $rok . "</u></h2>";
							$sql2 = "SELECT * FROM team where predmet='" . $predmet ."' AND rok='" . $rok . "'";
							$result2 = mysqli_query($conn, $sql2);  
							if (mysqli_num_rows($result2) > 0) {
								while($row2 = mysqli_fetch_assoc($result2)) {
									$nastaveneBody = "false";
									$rozdeleneBody = "true";
									$odsuhlaseneBody = "true";
									$odsuhlaseneBodyAdminom = "none";
									$body = 0;
									if(is_numeric($row2['body']))
									{
										$body = $row2['body'];
										$nastaveneBody = "true";
									}
									if($row2['odsuhlasene'] == "Áno")
										$odsuhlaseneBodyAdminom = "true";								 
										 
									if($row2['odsuhlasene'] == "Nie")
										$odsuhlaseneBodyAdminom = "false";
										 
									
									if ($nastaveneBody == "true")
										echo "<h3> Members of team no. ".$row2['cislo_timu']." with " . $body . " points</h3>";
									else
										echo "<h3> Members of team no. ".$row2['cislo_timu']."</h3>";
									
									$sql3 = "select * from student join users on id_student=id_ais WHERE tim=".$row2['id_timu'];
									$result3 = mysqli_query($conn, $sql3);  
									if (mysqli_num_rows($result3) > 0) {
										echo "<div class='overflow-auto'><table class='table'>
											<thead><tr><th>ID</th>
													  <th>Name</th>
													  <th>Email</th>
													  <th>Score</th>
													  <th>Agreement</th>
													</tr></thead><tbody>";

										while($row = mysqli_fetch_assoc($result3)) {
											 echo "<tr><td>" . $row['id_student']."</td>
													   <td>" . $row['name']."</td>
													   <td>" . $row['email']."</td>";  
											 if(is_numeric($row['body']))
												 echo "<td>" . $row['body'] . "</td>";
											 else 
											 {
												 echo "<td></td>";
												 $rozdeleneBody = "false";
											 }
											 if ($row['odsuhlasenie'] == "Nie") {
												 echo "<td>Disagreed</td></tr>";
											 } else if ($row['odsuhlasenie'] == "Áno") {
												echo "<td>Agreed</td></tr>";
											} else {
												echo "<td>Without agreement</td></tr>";
											}
											 if ($row['odsuhlasenie'] != "Áno")
												 $odsuhlaseneBody = "false";
										 }
								
										 echo "</tbody></table></div>";
										
										//echo "<br>$nastaveneBody<br>";
										if($nastaveneBody == "false") //ak nemá nastavené body tak ukáže formulár na nastavenie
										{
											echo "<form enctype='multipart/form-data' action='index.php?predmet=".$predmet. "-" . $rok . "' method='POST'>";
											echo "<div class='form-group'><input type='number' id='body".$row2['id_timu']."' class='form-control' name='body'></div>";
											echo "<input type='hidden' name='idTimu' value=" . $row2['id_timu'] . ">";
											// ZMENA POMOCOU AJAX alebo XMLRPC!!!
											echo "<input type='submit' name='change' class='btn btn-primary' value='Change'>";
											echo "</form>";
										}
										
										if($rozdeleneBody == "true" && $odsuhlaseneBody == "true" && $odsuhlaseneBodyAdminom == "none")
										{
											echo "<form enctype='multipart/form-data' action='index.php?predmet=".$predmet. "-" . $rok . "' method='POST'>";
											echo "<input type='hidden' name='idTimu' value=" . $row2['id_timu'] . ">";									
											echo "<input type='submit' name='suhlas' value='I agree'>";
											echo "</form>";
											
											echo "<form enctype='multipart/form-data' action='index.php?predmet=".$predmet. "-" . $rok . "' method='POST'>";
											echo "<input type='hidden' name='idTimu' value=" . $row2['id_timu'] . ">";									
											echo "<input type='submit' name='nesuhlas' value='I disagree'>";
											echo "</form>";
										}
										else if($odsuhlaseneBodyAdminom == "true")
										{
											echo "Splitting of points was agreed.<br>";
											// ked su rozdelene aj odsulasene body mozme ich exportovat
											//echo $row2['id_timu'];
											//echo "<form enctype='multipart/form-data' action='index.php?predmet=".$predmet."&tim=".$row2['id_timu']."' method='POST'>";
											echo "<input type='button' name='export' value='Export' onclick='exportData(".$row2['id_timu'].")'>";
											//echo "</form>";

										}
										else if($odsuhlaseneBodyAdminom == "false")
										{
											echo "Splitting of points was disagreed..<br>";
											// ked su rozdelene aj odsulasene body mozme ich exportovat
											//echo "<form enctype='multipart/form-data' action='index.php?predmet=".$predmet."&tim=".$row2['id_timu']."' method='POST'>";
											echo "<input type='button' name='export' value='Export' onclick='exportData(".$row2['id_timu'].")'>";
											// echo "</form>";
										}
									} else {
										 echo "you have no records";
									}

								}
							} else {
								 echo "you have no records";
							}
						

							// -------------------------------------- KU GRAFU S TEAMS -----------------------------------
							$pocetTimov = 0; $uzavrete=0; $vyjadritsa=0; $studNevyj = 0;
							$sql4 = "SELECT COUNT(*) as pocet FROM team where predmet='" . $predmet ."' AND rok='" . $rok . "'";
							$result4 = mysqli_query($conn, $sql4);  
							if (mysqli_num_rows($result4) > 0) {
								$row = mysqli_fetch_assoc($result4);
								$pocetTimov = $row['pocet'];
							}

							// uzavrety tim
							$sql4 = "SELECT Count(*) as pocet FROM team WHERE (odsuhlasene='Áno' OR odsuhlasene='Nie') AND predmet='" . $predmet ."' AND rok='" . $rok . "'";
							$result4 = mysqli_query($conn, $sql4);  
							if (mysqli_num_rows($result4) > 0) {
								$row = mysqli_fetch_assoc($result4);
								$uzavrete = $row['pocet'];
							}

							// treba sa vyjadrit
							// SELECT id_timu FROM team WHERE odsuhlasene='Nevyjadril' AND predmet='Webtech'
							// SELECT odsuhlasenie FROM student WHERE tim=22
							$timyID = array();
							$sql4 = "SELECT id_timu FROM team WHERE odsuhlasene='Nevyjadril' AND predmet='" . $predmet ."' AND rok='" . $rok . "'";
							$result4 = mysqli_query($conn, $sql4);  
							if (mysqli_num_rows($result4) > 0) {
								
								while($row = mysqli_fetch_assoc($result4)) {
									array_push($timyID, $row["id_timu"]);
								}								
							}

							
							foreach($timyID as $val) {
								$studentiVyjadrenie = array();
								$sql4 = " SELECT odsuhlasenie FROM student WHERE tim=$val";
								$result4 = mysqli_query($conn, $sql4);   
								if (mysqli_num_rows($result4) > 0) {
									while($row = mysqli_fetch_assoc($result4)) {
										array_push($studentiVyjadrenie, $row["odsuhlasenie"]);
									}	
								}
								if(in_array("Nevyjadril", $studentiVyjadrenie)) $studNevyj++;
								else $vyjadritsa++;
							}

							echo "<div class='my-4 overflow-auto'><table class='table'>
											<thead><tr><th>Number of teams</th>
													  <th>Number of closed teams</th>
													  <th>Number of teams to which it is necessary to comment</th>
													  <th>Number of teams in which students didn't make a decision</th>
											</tr></thead>
								<tbody>
											<tr><td>$pocetTimov</td>
											<td>$uzavrete</td>
											<td>$vyjadritsa</td>
											<td>$studNevyj</td></tr>
								</tbody></table></div>";


							$dataPoints = array( 
								array("label"=>"closed", "y"=>($uzavrete/$pocetTimov)*100),
								array("label"=>"necessary to comment", "y"=>($vyjadritsa/$pocetTimov)*100),
								array("label"=>"didn't make a decision", "y"=>($studNevyj/$pocetTimov)*100)
							);

							// --------------------------------------------- KU GRAFU STUDENTI -------------------------------------
							$pocetStudentov = 0; $anoStud = 0; $nieStud = 0; $nevieStud = 0;
							$timyID2 = array();
							$sql5 = "SELECT id_timu FROM team WHERE predmet='".$predmet."' AND rok='" . $rok . "'";
							$result5 = mysqli_query($conn, $sql5);  
							if (mysqli_num_rows($result5) > 0) {
									while($row = mysqli_fetch_assoc($result5)) {
									array_push($timyID2, $row["id_timu"]);								
								}
							}

							foreach($timyID2 as $val) {
								$sql4 = " SELECT * FROM student WHERE tim=$val";
								$result4 = mysqli_query($conn, $sql4);   
								if (mysqli_num_rows($result4) > 0) {
									while($row = mysqli_fetch_assoc($result4)) {
										$pocetStudentov++;
										if($row["odsuhlasenie"] == "Áno") $anoStud++;
										if($row["odsuhlasenie"] == "Nie") $nieStud++;
										if($row["odsuhlasenie"] == "Nevyjadril") $nevieStud++;
									}	
								}
							}
							
							echo "<div class='my-4 overflow-auto'><table class='table'>
											<thead><tr><th>Number of students in the subject</th>
													  <th>Number of students with agreement</th>
													  <th>Number of students with disagreement</th>
													  <th>Number of students which didn't make a decision</th>
											</tr></thead>
								<tbody>
											<tr><td>$pocetStudentov</td>
											<td>$anoStud</td>
											<td>$nieStud</td>
											<td>$nevieStud</td></tr>
								</tbody></table></div>";

							$dataPoints2 = array( 
								array("label"=>"students, which agreed", "y"=>($anoStud/$pocetStudentov)*100),
								array("label"=>"students, which didn't agreed", "y"=>($nieStud/$pocetStudentov)*100),
								array("label"=>"students without agreement", "y"=>($nevieStud/$pocetStudentov)*100)
							);

							
						}
					}else /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
					if(isset($_SESSION['username']) && $_SESSION['role'] == "student"){
						
						include "../config.php";
						
						$conn = new mysqli($servername, $username, $password, $dbname);
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
						}
						mysqli_set_charset($conn,"utf8");  
						
						//get information about current student
						$sql= "SELECT id_ais FROM users WHERE login=\"".$_SESSION['username']."\"";
						$result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result) > 0) {
								$row = mysqli_fetch_assoc($result);
								$ais_id = $row['id_ais'];
						}						
						
						//POST//////////////////////////////////////////////////////////////////////////////////////////
						if (isset($_POST['submit'])){
							$k = 0;
							$sucet = 0;
							while(isset($_POST['body'][$k])){
								$sucet += $_POST['body'][$k];
								$k++;
							}
							$sql = "SELECT body FROM team WHERE id_timu =".$_POST['team'];
							$result = mysqli_query($conn, $sql);
							$row = $result->fetch_assoc();
							if(is_null($row['body']))
								echo "<p style=\"color:red\">You don't have set points yet.</p>";
							else{
								if($sucet !=$row['body'])
								echo "<p style=\"color:red\">Súčet individuálnych bodov sa musí rovnať bodom tímu!</p>";
								else{
									$sql = "SELECT id_student FROM student WHERE tim=".$_POST['team'];
									$result = mysqli_query($conn, $sql);
									$j=0;
									while ($members = $result->fetch_assoc()) {
										$sql = "UPDATE student SET body =".$_POST['body'][$j]." WHERE id_student=".$members['id_student']." AND tim=".$_POST['team'];
										$j++;
										mysqli_query($conn, $sql);
									}
								}
							}
						}
						
						if (isset($_POST['suhlas'])){
							$sql = "UPDATE student SET odsuhlasenie=\"Áno\" WHERE id_student=".$ais_id." AND tim=".$_POST['team'];
							mysqli_query($conn, $sql);
						}
						
						if (isset($_POST['odmietnutie'])){
							$sql = "UPDATE student SET odsuhlasenie=\"Nie\" WHERE id_student=".$ais_id." AND tim=".$_POST['team'];
							mysqli_query($conn, $sql);
						}
							
							
						////////////////////////////////////////////////////////////////////////////////////////////////
						
						// get teams
						$sql = "SELECT tim FROM student WHERE id_student =".$ais_id;
						$resultedteams = mysqli_query($conn, $sql);
						
						if (mysqli_num_rows($resultedteams) > 0) {
							
							while ($team = $resultedteams->fetch_assoc()) {
								
								$sql = "SELECT predmet,body,odsuhlasene,cislo_timu FROM team WHERE id_timu =".$team['tim'];
								$resultedteam = mysqli_query($conn, $sql);
								
								if (mysqli_num_rows($resultedteam) > 0) {
									$rowteam = $resultedteam->fetch_assoc();
									
									echo "<form enctype='multipart/form-data' action='index.php' method='POST'><table class='table'><tr><th colspan=\"4\">Predmet: ".$rowteam['predmet']. ", " . $rowteam['rok'] ."</th></tr>";
									echo "<tr><th>Tím: ".$rowteam['cislo_timu']."</th><th>Celkové body: ".$rowteam['body']."</th> <th colspan=\"2\">";
									if($rowteam['odsuhlasene']=="Áno") echo "Set points accepted.";
									if($rowteam['odsuhlasene']=="Nie") echo "Set points wasn't accepted.";
									echo "</th></tr>";
									echo "<tr><th>Email</th><th>Name</th><th>Body</th><th>Agreement</th></tr>";
									
									$sql = "SELECT student.body, student.odsuhlasenie, users.name, users.email, users.id_ais FROM student JOIN users ON student.id_student = users.id_ais WHERE student.tim=".$team['tim'];
									$result= mysqli_query($conn, $sql);
									$i=0;
									if (mysqli_num_rows($result) > 0) {
										while($row = $result->fetch_assoc()){
											echo "<tr><td>".$row['email']."</td><td>".$row['name']."</td><td>";
											if(is_null($row['body'])){
												echo "<div class='form-group mb-0'><input name=\"body[".$i."]\" type=\"number\" class='form-control' placeholder='Score' required></div>";
												$i++;
											}
											else 
												echo $row['body'];
											echo "</td><td>";
											
											if(!is_null($row['body']) and $row['odsuhlasenie']=="Nevyjadril" and $ais_id == 	$row['id_ais'])

												echo "<input type=\"hidden\" name=\"team\" value=\"".$team['tim']."\">
													<input type='submit' name='suhlas' value='I agree' class='btn btn-success'>
												<input type='submit' name='odmietnutie' value='I disagree' class='btn btn-danger'>";
											else{
												
												if($row['odsuhlasenie']=="Nie")
													echo "Disagreed";
												
												if($row['odsuhlasenie']=="Áno")
													echo "Agreed";
											
												if($row['odsuhlasenie']=="Nevyjadril")
													echo "Didn't make a decision";	
												
											}
																							
											echo "</td></tr>";
											if($row['body']===NULL){
												$rozdel = 0;
											}
											else
												$rozdel = 1;
										}
									}
									if($rozdel == 0){
										echo "<input type=\"hidden\" name=\"team\" value=\"".$team['tim']."\">";
										echo "<tr><td colspan=\"4\"><input type='submit' name='submit' value='Divide points' class='btn btn-primary'></td></tr>";
									}
									echo "</table></form>";
								}
								
    						}
							
						}
						
					}
				
				
					if(isset($_SESSION['username']) && $_SESSION['role'] == "admin")
					{?>
						<!-- > /////////////////////////////////////// KOLACOVE GRAFY ///////////////////////////////////////////////////// <-->
					<div id="chartContainer" style="height: 370px; width: 100%;"></div>
					<div id="chartContainer2" style="height: 370px; width: 100%;"></div>
					
					<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
					<script>
						// --------------------------------------- export --------------------------------
						function exportData(tim){
								/* var xhttp = new XMLHttpRequest();
							xhttp.onreadystatechange = function() {
								if (this.readyState == 4 && this.status == 200) {
								alert( this.responseText );
								}
							};
							xhttp.open("GET", "export.php", true);
							xhttp.send();*/

								var url = 'export.php?';
									var query = 'tim=' + tim;

									window.location.href = url + query;
						}

						// https://canvasjs.com/php-charts/pie-chart/
						window.onload = function() {
								
						var chart = new CanvasJS.Chart("chartContainer", {
							animationEnabled: true,
							title: {
								text: "Statistics of teams"
							},
							subtitles: [{
								text: "<?php echo $_GET['predmet'] ?>"
							}],
							data: [{
								type: "pie",
								yValueFormatString: "#,##0.00\"%\"",
								indexLabel: "{label} ({y})",
								dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
							}]
						});
						chart.render();

						var chart2 = new CanvasJS.Chart("chartContainer2", {
							animationEnabled: true,
							title: {
								text: "Statistics of students"
							},
							subtitles: [{
								text: "<?php echo $_GET['predmet'] ?>"
							}],
							data: [{
								type: "pie",
								yValueFormatString: "#,##0.00\"%\"",
								indexLabel: "{label} ({y})",
								dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
							}]
						});
						chart2.render();
						
						}
					</script>

   
	
	 
			<?php } ?>
				</div>
			</div>
        </div>
    </main>
	
	<footer class="mt-4 pt-4 border-top">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md">
                    <img class="mb-2" src="../img/favicon.png" alt="" width="24" height="24">
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
                        <li><a class="text-muted" href="../../sk/podstranka.php">Subsite</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
	
</body>

</html>