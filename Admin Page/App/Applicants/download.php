<?php
// Include database connection
include("../../../Database/db.php");

// Check if the file parameter is set
if (isset($_GET['file'])) {
    $file = $_GET['file'];

    // Sanitize the filename to prevent directory traversal attacks
    $filePath = realpath(__DIR__ . '../../../uploads/forms/' . basename($file)); // Adjust path as necessary

    if (file_exists($filePath)) {
        // Set headers to force download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));

        // Clear output buffer and read the file
        ob_clean();
        flush();
        readfile($filePath);
        exit;
    } else {
        echo "File does not exist.";
    }
} else {
    echo "No file specified.";
}
