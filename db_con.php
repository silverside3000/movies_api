<?php
$server_name = "localhost";
$username = "root";
$password = "";
$db_name = "movies";

// Create connection
$connection = new mysqli($server_name, $username, $password, $db_name);

// Check connection
if ($connection->connect_error)
    die("Connection failed: " . $connection->connect_error);


$sql = "CREATE TABLE movies(
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARYKEY,
            Name VARCHAR(30) NOT NULL,
            Description VARCHAR(30) NOT NULL,
            Release_Date VARCHAR(30) NOT NULL,
            Rating INT(1) NOT NULL,
            Ticket_Price VARCHAR(30) NOT NULL,
            Country VARCHAR(30) NOT NULL,
            Genre VARCHAR(30) NOT NULL,
            Photo VARCHAR(500) NOT NULL,
        )";
if ($connection == true)
    echo "movies table created";

else {
    echo "Error creating movies table";
    $connection->close;
}
