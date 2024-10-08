<?php
$Name=$_POST['Name'];
$Department=$_POST['Department'];
$College=$_POST['College'];
$Phoneno=$_POST['Phoneno'];
$Email=$_POST['Email'];
$Event=$_POST['Event'];


if(!empty($Name)|| !empty($Department)|| !empty($College)|| !empty($Phoneno)|| !empty($Email)|| !empty($Event))
{
    $host="localhost";
    $dbusername="root";
    $dbpassword="";
    $dbname="registeration";

    $conn = new mysqli('localhost', 'root', $dbpassword, 'registeration');
    if ($conn->connect_errno) {
        die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
    }
    else{
        $SELECT ="SELECT Email From symposium where Email=? Limit 1";
        $INSERT ="INSERT Into symposium(Name,Department,College,Phoneno,Email,Event)values(?,?,?,?,?,?)";
        $stmt=$conn->prepare($SELECT);
        $stmt->bind_param("s",$Email);
        $stmt->execute();
        $stmt->bind_result($Email);
        $stmt->store_result();
        $rnum=$stmt->num_rows;
        if($rnum==0){
            $stmt->close();
            $stmt=$conn->prepare($INSERT);
            $stmt->bind_param("ssssss",$Name,$Department,$College,$Phoneno,$Email,$Event);
            $stmt->execute();
            echo "Your registeration form submitted successfully";
        }
        else{
            echo "Already registered using this Email";
        }
        $stmt->close();
        $conn->close();
    }
}
else{
    echo "All fields are required";
    die();
}
?>