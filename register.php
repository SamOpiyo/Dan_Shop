<?php
$conn = new mysqli("localhost", "root", "", "donesshop");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$full_name = $_POST['full_name'] ?? '';
$orders = isset($_POST['order']) ? implode(", ", $_POST['order']) : '';
$location = $_POST['location'] ?? '';
$phonenumber = $_POST['phone'] ?? ''; // <-- corrected this line

// Basic validation
if (empty($phonenumber)) {
    die("Phone number is required.");
}

$stmt = $conn->prepare("INSERT INTO Orders (full_name, orders, location, phonenumber) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $full_name, $orders, $location, $phonenumber);

if ($stmt->execute()) {
  echo "Form submitted successfully!";
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
