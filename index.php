<?php 

/*try{
    //connect with the database
    $dsn = 'mysql:host=localhost; dbname=cmpt304';
    $db_conn = new PDO($dsn,"root","mmljar");
    $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connection Successful";

   

} */ 

$q = $_GET['q']; 
//echo $q."Bryson"; 
$con = new mysqli("localhost", "root", "mmljar","cmpt304"); 

mysqli_select_db($con,"dictionary"); 

if ($con->connect_error){ 
    die("connection failed".$con->connect_error); 
}
//echo"connected succesfully:"; 

//$sql="SELECT * FROM words WHERE correct='smile'";  
$sql="SELECT * FROM words WHERE correct='$q'"; 
$sql2="SELECT * FROM words WHERE mutation ='$q'"; 

//$sql="SELECT * FROM words WHERE correct='smile'"; 
//$sql2="SELECT * FROM words WHERE mutation ='bmile'";  


$result=mysqli_query($con, $sql);  
$result2=mysqli_query($con, $sql2); 

while ($row =mysqli_fetch_assoc($result)){ // Creates array for correct spellings of words 
    $array[]=$row;  
    //echo"this works 1"; 
    
} 

while ($row2 =mysqli_fetch_assoc($result2)){ // Creates an array of the misspelt words 
    $array2[]=$row2;  
    //echo"this works 2"; 
} 


if (empty($array2)==false){   // Checks if the query for the misspelt words is not null 
    header('Content-Type: application/json'); 
    //echo json_encode($array2); 
    echo json_encode(false); 
    //break;
    

}

if (empty($array)==false){ // Checks if the array of the query of the correctly spelt words is not null 
    header('Content-Type: application/json'); 
    //echo json_encode($array); 
    echo json_encode(true);  
    
}  

/*else { 
    echo json_encode("neither "); 
}*/  

 if (empty($array)==true && empty($array2)==true){  // If neither array gets filled by the query, it returns a string so that the JS knows its neither
    header('Content-Type: application/json');
    echo json_encode("neither"); 
}



//echo "here"; 
//print_r($array); 
//header('Content-Type: application/json'); 
//echo json_encode($array); 
//echo $data; 

//echo $result; 







?> 