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
        
            <!-- TU FUNKCIONALITA ><-->
                    <div class="my-2 my-lg-0">
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
                            <input type='submit' name='submit' value='Testujeme' /> 
                        </form>
                    </div>

        
    <?php

        // ako dat povinny parameter select?

        include "../config.php";
    
        if (isset($_POST['submit'])){
             $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } else{
                // echo "pripojene k db";
            }
            mysqli_set_charset($conn,"utf8");        
            
            $year = $_POST['year'];
            $subject = $_POST['subject'];
            $separator = $_POST['delim'];
            $delim = "";

            if($separator == "coma") $delim = ",";
            if($separator == "dotcoma") $delim = ";";

            echo "toto je delim ".$delim;

            echo $subject.$year.$separator;

            // pri kazdom vkladani udajov vymaz tabulku
            mysqli_query($conn,'TRUNCATE TABLE student');

            $filename = $_FILES['userfile']['name'];
            // cela cesta k suboru
            //$path = realpath($filename);
            //echo $path;

            // subor musi byt na servri
            // https://stackoverflow.com/questions/2805427/how-to-extract-data-from-csv-file-in-php
            // CITANIE S CSV    
            if (($handle = fopen($filename, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, $delim)) !== FALSE) {
                   $sql = "INSERT INTO student (id_student, meno, email, heslo, tim) VALUES ($data[0], '".$data[1]."', '".$data[2]."', '".$data[3]."', $data[4])";
                   $result = mysqli_query($conn, $sql);

                }
                fclose($handle);
            }
            

            // VYPISANIE DO TABULIEK
            echo "<div class='my-2 my-lg-0'>";

            $sql2 = "SELECT DISTINCT tim FROM student";
            $result2 = mysqli_query($conn, $sql2);  
            if (mysqli_num_rows($result2) > 0) {
                while($row2 = mysqli_fetch_assoc($result2)) {

                    echo "<h1> Clenovia timu ".$row2['tim']."</h1>";
                    echo "<input type='number' id='body".$row2['tim']."'>";
                    // ZMENA POMOCOU AJAX alebo XMLRPC!!!
                    echo "<input type='submit' name='change' value='Change'>";


                    $sql3 = "SELECT * FROM student WHERE tim=".$row2['tim'];
                    $result3 = mysqli_query($conn, $sql3);  
                    if (mysqli_num_rows($result3) > 0) {
                        echo "<table>
                            <thead><tr><th>ID</th>
                                      <th>Meno</th>
                                      <th>Email</th>
                                      <th>Heslo</th>
                                      <th>Tim</th>
                                    </tr></thead><tbody>";

                        while($row = mysqli_fetch_assoc($result3)) {
                             echo "<tr><td>" . $row['id_student']."</td>
                                       <td>" . $row['meno']."</td>
                                       <td>" . $row['email']."</td>
                                       <td>" . $row['heslo']."</td>
                                       <td>" . $row['tim']."</td></tr>";        
                         }
                        
                         echo "</tbody></table>";
                         
                    } else {
                         echo "you have no records";
                    }

                }
            } else {
                 echo "you have no records";
            }

            echo "</div>";
            
        }
     ?>

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