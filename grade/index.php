<!doctype html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hodnotenie | Hodnotenie predmetu</title>
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
                        <li class="nav-item active">
                            <a class="nav-link" href="../grade">Hodnotenie</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../agreegrade">Súhlas hodnotenia</a>
                        </li>
                        <li class="nav-item">
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
                <h4>Hodnotenie</h4>
            </section>
			<section>
				<form enctype='multipart/form-data' action='index.php' method="POST">
        			<label> Školský rok </label>
                	<select name="year" required>
                    	<option value="1819">2018/2019</option>
                    	<option value="1718">2017/2018</option>
                    	<option value="1617">2016/2017</option>
                    	<option value="1516">2015/2016</option>
                    	<option value="1415">2014/2015</option>
               	 </select> <br>
                	<label> Názov predmetu </label> <input type="text" name="subject" required> <br>
                	<label> Vyberte súbor </label> <input type="file" name="userfile" accept=".csv" required /> <br>
                	<label> Oddeľovač </label> 
                    	<input type="radio" name="delim" value="coma" required> čiarka 
                    	<input type="radio" name="delim" value="dotcoma" required> bodkočiarka <br>
                	<input type='submit' name='submit' value='Import' /> 
            	</form>
				<br>
			</section>
			<section>
			<?php

        // ako dat povinny parameter select?


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

                include "../config.php";
				
				$conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    } else{
                        // echo "pripojene k db";
                    }
                    mysqli_set_charset($conn,"utf8");  
					
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
                        while (($data = fgetcsv($handle, 1000, $delim)) !== FALSE) {
							
							//ak neexistuje tím s daným id tak ho vytvor
							$sqlTim = "select id from team where id=$data[4]"; 
							$resultTim = mysqli_query($conn, $sqlTim);
							if (mysqli_num_rows($result2) == 0) {
								$sqlTim = "INSERT INTO team (id, predmet) VALUES ($data[4], '" . $_POST['subject'] . "')";
								mysqli_query($conn, $sqlTim);
							}
							
							//vytvor riadok v tabulke student
							$pom = (int) filter_var($data[0], FILTER_SANITIZE_NUMBER_INT); //toto tu je lebo inak nevedelo pridať prvý záznam z .csv do tabuľky
							//$sql = "INSERT INTO student (id_student, meno, email, heslo, tim) VALUES ($pom, '".$data[1]."', '".$data[2]."', '".$data[3]."', $data[4])";
						   $sql = "INSERT INTO student (id_student, tim) VALUES ($pom, $data[4])";
                           $result = mysqli_query($conn, $sql);
						   
						   //vytvor uzivatela
						   $timestamp = date('Y-m-d H:i:s');
						   $sqlUzivatel = "";
						   if($data[3] != "NULL")
						   {
							   $hashed_password = password_hash($data[3], PASSWORD_DEFAULT);
								$sqlUzivatel = "INSERT INTO users (id_ais, login, name, email, password, type, role, created_at) VALUES ($pom, '".$data[2]."', '".$data[1]."', '".$data[2]."', '".$hashed_password."', 'regular', 'student', '$timestamp')";
						   }
							else
								$sqlUzivatel = "INSERT INTO users (id_ais, login, name, email, type, role, created_at) VALUES ($pom, '".$data[2]."', '".$data[1]."', '".$data[2]."', 'ldap', 'student', '$timestamp')";
							
						   $result = mysqli_query($conn, $sqlUzivatel);
						   
						   
                        }
                        fclose($handle);
                    }
                unlink(getcwd()."/".$filename);    // odstran subor po precitani

        		include "../config.php";
				
				$conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    } else{
                        // echo "pripojene k db";
                    }
                    mysqli_set_charset($conn,"utf8");  
					
                if (isset($_POST['submit'])){
                       
            
                    $year = $_POST['year'];
                    $subject = $_POST['subject'];
                    $separator = $_POST['delim'];
                    $delim = "";

                    if($separator == "coma") $delim = ",";
                    if($separator == "dotcoma") $delim = ";";

                    echo "toto je delim ".$delim;

                    echo $subject.$year.$separator;

                    // pri kazdom vkladani udajov vymaz tabulku
                    //mysqli_query($conn,'TRUNCATE TABLE student');

                    $filename = $_FILES['userfile']['name'];
                    // cela cesta k suboru
                    //$path = realpath($filename);
                    //echo $path;

                    // subor musi byt na servri
                    // https://stackoverflow.com/questions/2805427/how-to-extract-data-from-csv-file-in-php
                    // CITANIE S CSV    
                    if (($handle = fopen($filename, "r")) !== FALSE) {
						//echo "<br>otvoril subor<br>";
                        while (($data = fgetcsv($handle, 1000, $delim)) !== FALSE) {
							
							//ak neexistuje tím s daným id tak ho vytvor
							$sqlTim = "select id from team where id=$data[4]"; 
							$resultTim = mysqli_query($conn, $sqlTim);
							if (mysqli_num_rows($result2) == 0) {
								$sqlTim = "INSERT INTO team (id, predmet) VALUES ($data[4], '" . $_POST['subject'] . "')";
								mysqli_query($conn, $sqlTim);
							}
							
							//vytvor riadok v tabulke student
							$pom = (int) filter_var($data[0], FILTER_SANITIZE_NUMBER_INT); //toto tu je lebo inak nevedelo pridať prvý záznam z .csv do tabuľky
							//$sql = "INSERT INTO student (id_student, meno, email, heslo, tim) VALUES ($pom, '".$data[1]."', '".$data[2]."', '".$data[3]."', $data[4])";
						   $sql = "INSERT INTO student (id_student, tim) VALUES ($pom, $data[4])";
                           $result = mysqli_query($conn, $sql);
						   
						   //vytvor uzivatela
						   $timestamp = date('Y-m-d H:i:s');
						   $sqlUzivatel = "";
						   if($data[3] != "NULL")
						   {
							   $hashed_password = password_hash($data[3], PASSWORD_DEFAULT);
								$sqlUzivatel = "INSERT INTO users (id_ais, login, name, email, password, type, role, created_at) VALUES ($pom, '".$data[2]."', '".$data[1]."', '".$data[2]."', '".$hashed_password."', 'regular', 'student', '$timestamp')";
						   }
							else
								$sqlUzivatel = "INSERT INTO users (id_ais, login, name, email, type, role, created_at) VALUES ($pom, '".$data[2]."', '".$data[1]."', '".$data[2]."', 'ldap', 'student', '$timestamp')";
							
						   $result = mysqli_query($conn, $sqlUzivatel);
						   
						   
                        }
                        fclose($handle);
                    }
            



				}	
				
				if(isset($_POST['change'])) //ak boli nastavené body
				{
					$sqlPridajBody = "UPDATE team SET body='$_POST[body]' WHERE id='$_POST[idTimu]'";
					mysqli_query($conn, $sqlPridajBody);
				}
				
				if(isset($_POST['suhlas'])) //ak bol stlačený úhlas tak to odsúhlasí
				{
					$sqlNastavSuhlas = "UPDATE team SET odsuhlasene='Áno' WHERE id='$_POST[idTimu]'";
					mysqli_query($conn, $sqlNastavSuhlas);
				}
				
				if(isset($_POST['nesuhlas'])) //ak bol stlačený nesúhlas tak resetuje body i súhlasy
				{
					$sqlNastavSuhlas = "UPDATE student SET odsuhlasenie='Nevyjadril', body =NULL WHERE tim='$_POST[idTimu]'";
					mysqli_query($conn, $sqlNastavSuhlas);
				}
				
                    // VYPISANIE DO TABULIEK
            
                    $sql2 = "SELECT DISTINCT tim FROM student";
                    $result2 = mysqli_query($conn, $sql2);  
                    if (mysqli_num_rows($result2) > 0) {
                        while($row2 = mysqli_fetch_assoc($result2)) {


							$sqlBodyTimu = "SELECT body, odsuhlasene from team where id=".$row2['tim'];
							$nastaveneBody = "false";
							$rozdeleneBody = "true";
							$odsuhlaseneBody = "true";
							$odsuhlaseneBodyAdminom = "false";
							$body = 0;
							$resultBody = mysqli_query($conn, $sqlBodyTimu);  
                            if (mysqli_num_rows($resultBody) > 0) {   								
                                while($row = mysqli_fetch_assoc($resultBody)) {
									if(is_numeric($row['body']))
									{
										$body = $row['body'];
										$nastaveneBody = "true";
									}
									if($row['odsuhlasene'] == "Áno")
										$odsuhlaseneBodyAdminom = "true";
                                 }
							}
							
							if ($nastaveneBody == "true")
								echo "<h1> Členovia tímu č. ".$row2['tim']." s " . $body . " bodmi</h1>";
							else
								echo "<h1> Členovia tímu č. ".$row2['tim']."</h1>";
							
                            $sql3 = "select * from student join users on id_student=id_ais WHERE tim=".$row2['tim'];
                            $result3 = mysqli_query($conn, $sql3);  
                            if (mysqli_num_rows($result3) > 0) {
                                echo "<table>
                                    <thead><tr><th>ID</th>
                                              <th>Meno</th>
                                              <th>Email</th>
                                              <th>Tim</th>
											  <th>Počet bodov</th>
											  <th>Súhlas</th>
                                            </tr></thead><tbody>";



							$sqlBodyTimu = "SELECT body, odsuhlasene from team where id=".$row2['tim'];
							$nastaveneBody = "false";
							$rozdeleneBody = "true";
							$odsuhlaseneBody = "true";
							$odsuhlaseneBodyAdminom = "false";
							$body = 0;
							$resultBody = mysqli_query($conn, $sqlBodyTimu);  
                            if (mysqli_num_rows($resultBody) > 0) {   								
                                while($row = mysqli_fetch_assoc($resultBody)) {
									if(is_numeric($row['body']))
									{
										$body = $row['body'];
										$nastaveneBody = "true";
									}
									if($row['odsuhlasene'] == "Áno")
										$odsuhlaseneBodyAdminom = "true";
                                 }
							}
							
							if ($nastaveneBody == "true")
								echo "<h1> Členovia tímu č. ".$row2['tim']." s " . $body . " bodmi</h1>";
							else
								echo "<h1> Členovia tímu č. ".$row2['tim']."</h1>";
							
                            $sql3 = "select * from student join users on id_student=id_ais WHERE tim=".$row2['tim'];
                            $result3 = mysqli_query($conn, $sql3);  
                            if (mysqli_num_rows($result3) > 0) {
                                echo "<table>
                                    <thead><tr><th>ID</th>
                                              <th>Meno</th>
                                              <th>Email</th>
                                              <th>Tim</th>
											  <th>Počet bodov</th>
											  <th>Súhlas</th>
                                            </tr></thead><tbody>";


                                while($row = mysqli_fetch_assoc($result3)) {
                                     echo "<tr><td>" . $row['id_student']."</td>
                                               <td>" . $row['name']."</td>
                                               <td>" . $row['email']."</td>
                                               <td>" . $row['tim']."</td>";  
									 if(is_numeric($row['body']))
										 echo "<td>" . $row['body'] . "</td>";
									 else 
									 {
										 echo "<td></td>";
										 $rozdeleneBody = "false";
									 }
									 echo "<td> " . $row['odsuhlasenie'] . "</td></tr>";
									 if ($row['odsuhlasenie'] != "Áno")
										 $odsuhlaseneBody = "false";
                                 }
                        
                                 echo "</tbody></table>";
								
								//echo "<br>$nastaveneBody<br>";
								if($nastaveneBody == "false") //ak nemá nastavené body tak ukáže formulár na nastavenie
								{
									echo "<form enctype='multipart/form-data' action='index.php' method='POST'>";
									echo "<input type='number' id='body".$row2['tim']."' name='body'>";
									echo "<input type='hidden' name='idTimu' value=" . $row2['tim'] . ">";
									// ZMENA POMOCOU AJAX alebo XMLRPC!!!
									echo "<input type='submit' name='change' value='Change'>";
									echo "</form>";
								}
								
								if($rozdeleneBody == "true" && $odsuhlaseneBody == "true" && $odsuhlaseneBodyAdminom == "false")
								{
									echo "<form enctype='multipart/form-data' action='index.php' method='POST'>";
									echo "<input type='hidden' name='idTimu' value=" . $row2['tim'] . ">";									
									echo "<input type='submit' name='suhlas' value='Súhlasím'>";
									echo "</form>";
									
									echo "<form enctype='multipart/form-data' action='index.php' method='POST'>";
									echo "<input type='hidden' name='idTimu' value=" . $row2['tim'] . ">";									
									echo "<input type='submit' name='nesuhlas' value='Nesúhlasím'>";
									echo "</form>";
								}
								else if($odsuhlaseneBodyAdminom == "true")
								{
									echo "Body boli odsúhlasené.";
								}
                            } else {
                                 echo "you have no records";
                            }

                        }
                    } else {
                         echo "you have no records";
                    }


                    // -------------------------------------- KU GRAFU S TEAMS -----------------------------------
                    $pocetTimov = 0; $ano=0; $nie=0; $nevie = 0;
                    $sql4 = "SELECT COUNT(*) as pocet FROM team";
                    $result4 = mysqli_query($conn, $sql4);  
                    if (mysqli_num_rows($result4) > 0) {
                        $row = mysqli_fetch_assoc($result4);
                        $pocetTimov = $row['pocet'];
                    }

                    $sql4 = "SELECT Count(*) as pocet FROM team WHERE odsuhlasene='Nevyjadril'";
                    $result4 = mysqli_query($conn, $sql4);  
                    if (mysqli_num_rows($result4) > 0) {
                        $row = mysqli_fetch_assoc($result4);
                        $nevie = $row['pocet'];
                    }

                    $sql4 = "SELECT Count(*) as pocet FROM team WHERE odsuhlasene='Áno'";
                    $result4 = mysqli_query($conn, $sql4);  
                    if (mysqli_num_rows($result4) > 0) {
                        $row = mysqli_fetch_assoc($result4);
                        $ano = $row['pocet'];
                    }

                    $sql4 = "SELECT Count(*) as pocet FROM team WHERE odsuhlasene='Nie'";
                    $result4 = mysqli_query($conn, $sql4);  
                    if (mysqli_num_rows($result4) > 0) {
                        $row = mysqli_fetch_assoc($result4);
                        $nie = $row['pocet'];
                    }

                    echo "pocet timov".$pocetTimov." ".$ano." ".$nie." ".$nevie;

                    $dataPoints = array( 
                        array("label"=>"súhlasili", "y"=>($ano/$pocetTimov)),
                        array("label"=>"nesúhlasili", "y"=>($nie/$pocetTimov)),
                        array("label"=>"nevyjadrili sa", "y"=>($nevie/$pocetTimov))
                    );

            

     ?>
			</section>
        </div>
    </main>
    

    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    

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


     <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
     <script>
        // https://canvasjs.com/php-charts/pie-chart/
        window.onload = function() {
                 
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title: {
                text: "Vyjadrenie tímov"
            },
            subtitles: [{
                text: "November 2017"
            }],
            data: [{
                type: "pie",
                yValueFormatString: "#,##0.00\"%\"",
                indexLabel: "{label} ({y})",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
         
        }
    </script>

</body>

</html>