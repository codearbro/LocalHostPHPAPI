<?php

// Include database connection
include_once '../config/DbConnect.php';
$objDb = new DbConnect;
$conn = $objDb->connect();

// Get the HTTP request method
$method = $_SERVER['REQUEST_METHOD'];

// Get the request URI to determine the correct action
$path = explode('/', $_SERVER['REQUEST_URI'],);

switch($method) {
    case "GET":
        if (isset($path[3]) && is_numeric($path[3])) {
            // Fetch a specific booking
            $sql = "SELECT * FROM booking WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $path[3]);
            $stmt->execute();
            $booking = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($booking);
        } else {
            // Fetch all bookings
            $sql = "SELECT * FROM booking";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($bookings);
        }
        break;

    // Additional cases for POST, PUT, DELETE would be added here
}
