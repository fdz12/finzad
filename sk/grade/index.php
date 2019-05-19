<!doctype html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hodnotenie | Hodnotenie predmetu</title>
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
                <a class="navbar-brand" href="../finzad">
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
						<?php
						if(isset($_SESSION['username']))
                        {?>
                        <li class="nav-item active">
                            <a class="nav-link" href="../grade">Hodnotenie</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../agreegrade">Súhlas hodnotenia</a>
						</li>
						<?php
						if(isset($_SESSION['username']) && $_SESSION['role'] == "admin")
                        {?>
                        <li class="nav-item">
                            <a class="nav-link" href="sendlogininfo">Rozposielanie údajov</a>
                        </li>
						<?php } ?>
						<?php } ?>
					</ul>
					<div class="my-2 my-lg-0 mr-3">
                        <div class="my-2 my-lg-0">
                            <div class="dropdown">
                                <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="flag-icon flag-icon-sk"></span> SK
                                </a>
                                
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="../../en/grade"><span class="flag-icon flag-icon-gb"></span> EN</a>
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
            <div class="row">
				<div class="col">
					<h4>Grade</h4>
				</div>
            </div>
			<div class="row mt-3 mb-5">
				<div class="col">
					<?php
						// ak je session urobená a je adminom
						if(isset($_SESSION['username']) && $_SESSION['role'] == "admin")
						{
					?>	
					<h5>Import</h5>
					<form enctype='multipart/form-data' action='index.php' method='POST'>
						<div class="form-group">
							<label for="year">Školský rok</label>
							<select class="form-control" name="year" id="year" required>
								<option value='2018/2019'>2018/2019</option>
								<option value='2017/2018'>2017/2018</option>
								<option value='2016/2017'>2016/2017</option>
								<option value='2015/2016'>2015/2016</option>
								<option value='2014/2015'>2014/2015</option>
							</select>
						</div>
						<div class="form-group">
							<label for="subject">Názov predmetu</label>
							<input type="text" class="form-control" name="subject" id="subject" placeholder="Názov predmetu" required>
						</div>
						<div class="form-group">
							<label for="userfile">Vyberte súbor</label>
							<input type="file" class="form-control" name="userfile" id="userfile" required>
						</div>
						<label>
							Oddelovač
						</label>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="delim" id="coma" value="coma" required>
							<label class="form-check-label" for="coma">
								čiarka
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="delim" id="dotcoma" value="dotcoma" required>
							<label class="form-check-label" for="dotcoma">
								bodkočiarka
							</label>
						</div>
						<input type='submit' name='submit' class="btn btn-primary mt-3" value='Importovať'> 
					</form>
				</div>
			</div>
			<div class="row my-5">
				<div class="col">
					<h5>Zobrazenie hodnotení</h5>
					<?php
							function uploadFile($userfile){
							
								$uploadfile = getcwd()."/". $userfile;
								
								if (file_exists($uploadfile)){
									echo "Súbor s nazvom $uploadfile uz existuje\n";
									} 
								else{
									if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $uploadfile)) {
										echo "Súbor bol úspešne pridaný do priečninku Files\n";
									} else{
										echo "Chyba pri nahrávaní súboru!\n";
									}
								}
								echo "userfile".$uploadfile;

							}
		
							if (isset($_POST['zmaz']))
							{
								$sqlZmaz = "DELETE from grade where predmet = '". $_POST['predmet'] ."' and rok = '". $_POST['rok'] ."'";
								mysqli_query($conn, $sqlZmaz);
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
									//vyriešenie hlavičky
									$data = fgetcsv($handle, 1000, $delim); //data je poľom s udajmi hlavičky								
									$hlavicka = implode("!", $data); //serializujeme ho do stringu na ulozenie do db
									$hlavicka = str_replace('"','',$hlavicka);
									$hlavicka = str_replace("\xEF\xBB\xBF",'',$hlavicka); //zmaze znak FEFF, ktorý sa tam ktovie prečo objavuje a kazí sql
									//echo "<br>" . $data[0] . "<br>";
									
									while (($data = fgetcsv($handle, 1000, $delim)) !== FALSE) {
										
										//ak neexistuje tím s daným id tak ho vytvor
										$id_student = $data[0];
										$meno_student = $data[1];
										//odstranime id a meno z pola
										array_splice($data, 0, 1); // odstráni prvok na pozícii 0 a preindexuje
										array_splice($data, 0, 1); // odstráni prvok na pozícii 0 a preindexuje
										$hodnoty = implode("!", $data);
										//echo "<br>" . $hodnoty . "<br>";
										$sqlGrade = "INSERT INTO grade (id_student, meno, predmet, rok, hlavicka, hodnoty) VALUES ('". $id_student ."', '". $meno_student ."', '". $subject ."', '". $year ."', '". $hlavicka ."', '". $hodnoty ."')";
										//echo "<br>" . $sqlGrade . "<br>";
										mysqli_query($conn, $sqlGrade);			
									}
									fclose($handle);
								}
								unlink(getcwd()."/".$filename);    // odstran subor po precitani

							}
							
							
							$predmet = "";
							$rok = "";
							$existujePredmet = "false";
							$sqlPredmety = "Select distinct predmet, rok from grade";
							$resultPredmety = mysqli_query($conn, $sqlPredmety);
							if (mysqli_num_rows($resultPredmety) > 0) 
							{		
								$existujePredmet = "true";
							?>
								<form enctype='multipart/form-data' action='index.php' method='GET'>
									<div class="form-group">
										<label for="PredmetN">Zvoľte predmet a ak. rok</label>
										<select class="form-control" id="PredmetN" name="PredmetN" required>
							<?php
								while($rowP = mysqli_fetch_assoc($resultPredmety)) 
								{
									if ($rowP['predmet'] ."!". $rowP['rok'] != $_GET['PredmetN']) {
										echo "<option value='". $rowP['predmet'] ."!". $rowP['rok'] ."'>". $rowP['predmet'] . ", " . $rowP['rok'] ."</option>";
									} else {
										echo "<option value='". $rowP['predmet'] ."!". $rowP['rok'] ."' selected>". $rowP['predmet'] . ", " . $rowP['rok'] ."</option>";
									}
									$predmet = $rowP['predmet'];
								}
							?>
										</select>
									</div>
									<input type='submit' name='zobraz' value="Zobraz hodnotenia" class="btn btn-info">
							</form>
							<?php		
							}	
							
							if (isset($_GET['zobraz']))
							{
								// vymaz vsetko zo suboru
								//open file to write
								$fp = fopen("content.txt", "w+");
								// clear content to 0 bits
								ftruncate($fp, 0);

								//echo "<br> Predmet i rok boli zvolene<br>";
								$hlavicka = "";
								$line = "";
								$headerT = array();	
								$hodnoty = explode("!", $_GET['PredmetN']);
								echo "<h3>" . $hodnoty[0] . " z roku " . $hodnoty[1] . "</h3>";
								$sqlZobraz = "Select * from grade where predmet = '". $hodnoty[0] ."' and rok = '". $hodnoty[1] ."'";
								$resultZobraz = mysqli_query($conn, $sqlZobraz);
								if (mysqli_num_rows($resultZobraz) > 0) 
								{	
									//echo "<br>Sql prebehlo a má výsledky<br>";
									while($rowZobraz = mysqli_fetch_assoc($resultZobraz)) 
									{
										if($rowZobraz['hlavicka'] != $hlavicka)
										{
											if($hlavicka != "")
											{
												echo "</tbody></table>";
											}
											$hlavicka = $rowZobraz['hlavicka'];
											echo "<div class='overflow-auto'><table class='table'><thead><tr>";
											$pole = explode('!', $hlavicka);
											foreach ($pole as $hodnota) {
												echo "<th>" . $hodnota . "</th>";
												array_push($headerT, $hodnota);
											}
											echo "</tr></thead><tbody>";										
											$pole = explode('!', $rowZobraz['hodnoty']);
											
											// HODNOTY V BODY
											// zapis  do suboru
											$line .= $rowZobraz['id_student'].";".$rowZobraz['meno'];
																			
											echo "<tr>";
											echo "<td> " . $rowZobraz['id_student'] . "</td>";
											echo "<td> " . $rowZobraz['meno'] . "</td>";
											foreach ($pole as $hodnota) {
												echo "<td>" . $hodnota . "</td>";
												$line .= ";".$hodnota;
											}
											echo "</tr>";
											
											$line .= "\n";										
										}
										else
										{
																					
											$pole = explode('!', $rowZobraz['hodnoty']);
											
											// HODNOTY V BODY
											// zapis  do suboru
											$line .= $rowZobraz['id_student'].";".$rowZobraz['meno'];

											echo "<tr>";
											echo "<td> " . $rowZobraz['id_student'] . "</td>";
											echo "<td> " . $rowZobraz['meno'] . "</td>";
											foreach ($pole as $hodnota) {
												echo "<td>" . $hodnota . "</td>";
												$line .= ";".$hodnota;
											}
											echo "</tr>";	
											$line .= "\n";			
										}
									}

									$qData = http_build_query(array('data' => $headerT));

									echo "</tbody></table></div>";
									echo "<br>";
									echo "<form enctype='multipart/form-data' action='index.php' method='POST'>
										<input type='hidden' name='predmet' value='". $hodnoty[0] ."'>
										<input type='hidden' name='rok' value='". $hodnoty[1] ."'>
										<input type='submit' name='zmaz' value='Zmaž hodnotenia' class='btn btn-danger'>
										<input type='button' name='printPDF' value='Tlač do PDF' class='btn' onclick=\"window.location.href='table.php?$qData'\">
										</form>";

									//echo $qData;
								}
								// zapis do suboru
								file_put_contents("content.txt",$line);	
								//close file
								fclose($fp);
							}
							
							
						}
						else if(isset($_SESSION['username']) && $_SESSION['role'] == "student")
						{
							$id_student = "";
							
							$sqlID = "Select id_ais from users where id = '". $_SESSION['id'] ."'";
							$resultID = mysqli_query($conn, $sqlID);
							if (mysqli_num_rows($resultID) > 0) 
							{
								$row = mysqli_fetch_assoc($resultID);
								$id_student = $row['id_ais'];
							}
							$sqlZobraz = "Select * from grade where id_student = '". $id_student ."'";
							//echo "<br> $sqlZobraz <br>";
							$resultZobraz = mysqli_query($conn, $sqlZobraz);
							if (mysqli_num_rows($resultZobraz) > 0) 
							{
								while($rowZobraz = mysqli_fetch_assoc($resultZobraz)) 
								{
									echo "<div class='mb-3'><h4>" . $rowZobraz['predmet'] . " z roku " . $rowZobraz['rok'] . "</h4>";
									echo "<div class='mb-1'>".$rowZobraz['meno']."</div>";
									echo "<div class='overflow-auto'><table class='table'><thead><tr>";
									$pole = explode('!', $rowZobraz['hlavicka']);
									foreach ($pole as $hodnota) {
										if ($hodnota != "Meno") {
											echo "<th>" . $hodnota . "</th>";
										}
									}
									echo "</tr></thead><tbody>";										
									$pole = explode('!', $rowZobraz['hodnoty']);
										
									echo "<tr>";
									echo "<td> " . $rowZobraz['id_student'] . "</td>";
									foreach ($pole as $hodnota) {
										echo "<td>" . $hodnota . "</td>";
									}
									echo "</tr>";
									echo "</tbody></table></div></div>";								
								}
							}
							
						}
					?>
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