<?php
include 'db_con.php';

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

if ($method == 'POST') {
    $Name = $input['Name'];
    $Description = $input['Description'];
    $Rating = $input['Rating'];

    $Ticket_Price = $input['Ticket_Price'];
    $Country = $input['Country'];
    $Genre = $input['Genre'];
    $Photo = $input['Photo'];
    if ($Rating >= 1 && $Rating <= 5) {
        $conn->query("INSERT INTO movies (Name, Description, Rating, Ticket_Price, Country, Genre, Photo) 
                VALUES ('$Name', '$Description', $Rating, '$Ticket_Price', '$Country', '$Genre', '$Photo')");
        echo json_encode(["message" => "Movie added successfully"]);
    } else
        echo json_encode(["message" => "Movie ratings should be within 1 and 5"]);
} elseif ($method == 'GET') {
    if (isset($_GET['id'])) {
        //gets a particular movie ID
        $id = $_GET['id'];
        $result = $conn->query("SELECT * FROM movies WHERE id=$id");
        $data = $result->fetch_assoc();
        echo json_encode($data);
    } else {
        //Gets all movies
        $result = $conn->query("SELECT * FROM movies");
        $movies = [];
        while ($row = $result->fetch_assoc()) {
            $movies[] = $row;
        }
        echo json_encode($movies);
    }
} elseif ($method == 'PUT') {
    //Update movies
    $id = $_GET['id'];
    $Name = $input['Name'];
    $Description = $input['Description'];
    $Rating = $input['Rating'];
    $Ticket_Price = $input['Ticket_Price'];
    $Country = $input['Country'];
    $Genre = $input['Genre'];
    $Photo = $input['Photo'];
    $conn->query("UPDATE movies SET Name='$Name', Description='$Description', Rating=$Rating,
                     Ticket_Price='$Ticket_Price', Country=$Country, Genre='$Genre', Photo=$Photo
                     WHERE id=$id");
    echo json_encode(["message" => "Movie updated successfully"]);
} elseif ($method == 'DELETE') {
    $id = $_GET['id'];
    $conn->query("DELETE FROM users WHERE id=$id");
    echo json_encode(["message" => "Movie deleted successfully"]);
} else
    echo json_encode(["message" => "Invalid request method"]);

$conn->close();
