<?php
header('Content-Type: application/json');

include 'db.php';

$sql = "SELECT * FROM malzemeler";
$result = $conn->query($sql);

$ingredients = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ingredients[] = $row;
    }
}

$conn->close();

echo json_encode($ingredients);
?>
