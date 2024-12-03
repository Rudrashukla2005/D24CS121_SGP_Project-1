<?php
require_once 'config.php';

if (isset($_GET['id']) && isset($_GET['file'])) {
    $id = $_GET['id'];
    $fileType = $_GET['file'];

    $sql = "SELECT $fileType FROM faculty WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $fileType . '.pdf"');
        echo $row[$fileType];
        exit;
    } else {
        echo "File not found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}
?>