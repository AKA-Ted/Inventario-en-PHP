<?php
	$servername = "localhost";
        $username = "root" ;
        $password = "123456";
        $DB = "inventarios";
        try{
            $cnx = new PDO("mysql:host=$servername;dbname=$DB", $username, $password );
            $cnx ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $cnx ->setAttribute(PDO::ATTR_EMULATE_PREPARES, true );
        } catch (Exception $ex) {
            print "¡Error!: " . $ex->getMessage() . "<br/>";
            die();  
        }
?>