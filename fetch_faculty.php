<?php
require_once 'config.php';

$sql = "SELECT id, first_name, last_name, profile_photo, contact_number, email, education, address FROM faculty";
$result = $conn->query($sql);

$facultyList = [];

if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $row['profile_photo'] = base64_encode($row['profile_photo']); // Encode image data
        $facultyList[] = $row;
    }
}

echo json_encode($facultyList);
?>