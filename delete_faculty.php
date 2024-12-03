<?php
require_once 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the SQL DELETE statement
    $sql = "DELETE FROM faculty WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the faculty list page or a confirmation page
        header("Location: index.php?message=Faculty_deleted_successfully");
        exit;
    } else {
        echo "Error deleting faculty.";
    }
} else {
    echo "Invalid faculty ID.";
}
?>
