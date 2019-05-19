<?php

//header('Location: index.php');

include "../config.php";

$conn = new mysqli($servername, $username, $password, $dbname);
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } else{
                                // echo "pripojene k db";
                            }
                            mysqli_set_charset($conn,"utf8");  

if (isset($_GET['tim'])){

    $cislo_tim;
    $sql5="SELECT cislo_timu FROM team WHERE id_timu=".$_GET['tim'];
    $result5 = mysqli_query($conn, $sql5);
    if (mysqli_num_rows($result5) > 0) {
        $row = mysqli_fetch_assoc($result5); 
        $cislo_tim = $row['cislo_timu'];
    }  

    $filename = "dataTim".$cislo_tim;

    header('Content-Type: text/csv; charset=utf-8');  
    header("Content-Disposition: attachment; filename=$filename.csv");  
    $output = fopen("php://output", "w");  
    

    //fputcsv($output, array('ID', 'Name', 'Points'));  
    //fputcsv($output, array('123', 'Bla bla', '12'));
    
    $sql6 = "SELECT users.id_ais as ID, users.name as Name, student.body as Points FROM student JOIN users ON student.id_student = users.id_ais WHERE student.tim=".$_GET['tim']; 
    $result6 = mysqli_query($conn, $sql6);   
    while($row = mysqli_fetch_assoc($result6))  {  
        fputcsv($output, $row);     // This method formats a line (passed as a fields array) as CSV and write it (terminated by a newline) to the specified file.
    }  


    fclose($output);

}


?>
