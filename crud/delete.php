<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "crud";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Use a prepared statement to prevent SQL injection
    $sql = "DELETE FROM clients WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id); // 'i' for integer

    // Execute the query and check for errors
    if ($stmt->execute()) {
        // Successfully deleted
        header("Location: /crud/index.php");
        exit;
    } else {
        // Error handling: log the error and show a friendly message
        echo "Error deleting record: " . $stmt->error;
    }

    // Close the prepared statement and the connection
    $stmt->close();
    $connection->close();

} else {
    // If no ID is set in the URL, redirect to the index page
    header("Location: /crud/index.php");
    exit;
}
?>
