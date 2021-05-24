<?php
	$host="localhost";
	$dbnome="gelateria";
	$username="root";
	$password="";
	
	$conn = new mysqli ($host, $username, $password, $dbnome);
    
	if($conn->connect_errno){ 
		echo "Accesso al database non riuscito: " .$conn->connect_error."/n";
		exit;
	}

?>