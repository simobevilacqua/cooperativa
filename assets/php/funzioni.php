<?php

    //funzione per la connessione al database
    function connection() {
        $dbHost = "localhost";
        $dbUser = "root";
        $dbPass = "";

        $conn = mysqli_connect($dbHost, $dbUser, $dbPass);
        if(!$conn) {
            die("Connessione fallita: " . mysqli_error($conn));
        }
        
        $dbName = "federazione";
        mysqli_select_db($conn, $dbName);

        return $conn;
    }

?>