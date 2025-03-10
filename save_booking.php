<?php
$servername = "localhost";
$username = "root"; // Change if needed
$password = ""; // Change if needed
$dbname = "PartyHallDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]));
}

// Get data from frontend
$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    $name = $data['name'];
    $email = $data['email'];
    $phone = $data['phone'];
    $partyType = $data['partyType'];
    $date = $data['date'];
    $message = $data['message'];

    $sql = "INSERT INTO bookings (name, email, phone, party_type, date, message) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $email, $phone, $partyType, $date, $message);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Booking saved!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid data received"]);
}

$conn->close();
?>
