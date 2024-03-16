<?php
// Check if the form is submitted and all required fields are set
if ($_SERVER["REQUEST_METHOD"] == "POST" && 
    isset($_POST["firstname"], $_POST["surname"], $_POST["section"], $_POST["course"], $_POST["email"], $_POST["number"], $_POST["message"])) {

    // Establish connection to your database
    $servername = "localhost"; // Change this to your database server
    $username = "id20466229_sccis"; // Change this to your database username
    $password = "Sccinv24!"; // Change this to your database password
    $dbname = "id20466229_sccinventory"; // Change this to your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve the form data
    $firstname = $_POST["firstname"];
    $surname = $_POST["surname"];
    $section = $_POST["section"];
    $course = $_POST["course"];
    $email = $_POST["email"];
    $number = $_POST["number"];
    $message = $_POST["message"];

    // Prepare SQL statement to insert data into the database
    $sql = "INSERT INTO tickets (firstname, surname, section, course, email, number, message)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $firstname, $surname, $section, $course, $email, $number, $message);

    // Execute the statement
    if ($stmt->execute()) {
        // If insertion is successful, redirect to the next HTML page
        header("Location: 7ticket.php");
        exit();
    } else {
        // If insertion fails, show an alert and redirect back to the form page
        echo "<script>alert('Failed to submit the form. Please try again.');</script>";
        echo "<script>window.location.href = '10ticket.php';</script>";
        exit();
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
