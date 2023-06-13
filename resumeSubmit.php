<?php
// Include the database connection file
require_once 'db_connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $name = $_POST['name'];
    $cgpa = $_POST['cgpa'];
    $degree = $_POST['degree'];
    $graduationYear = $_POST['graduationYear'];
    $university = $_POST['university'];
    $skill = $_POST['skill'];

    // Perform validation if needed
    // ...

    // Insert the data into the database
    $query = "INSERT INTO resumedata(name, cgpa, degree, graduation_year, university, skill) 
              VALUES ('$name', '$cgpa', '$degree', '$graduationYear', '$university', '$skill')";
    $result = mysqli_query($connection, $query);

    // Check if the insertion was successful
    if ($result) {
        echo 'Data inserted successfully.';
    } else {
        echo 'Error: ' . mysqli_error($connection);
    }

    // Check if a file was uploaded successfully
    if (isset($_FILES['cvFile']) && $_FILES['cvFile']['error'] === UPLOAD_ERR_OK) {
        // Retrieve the file details
        $fileTmpPath = $_FILES['cvFile']['tmp_name'];
        $fileName = $_FILES['cvFile']['name'];

        // Set the upload directory
        $uploadDirectory = 'uploads/'; // Choose the directory where you want to store the uploaded files

        // Generate a unique filename to avoid overwriting existing files
        $uniqueFileName = uniqid() . '_' . $fileName;

        // Build the file's destination path
        $destination = $uploadDirectory . $uniqueFileName;

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($fileTmpPath, $destination)) {
            // Insert the file path into the database
            $cvQuery = "UPDATE resumedata SET cv_path = '$destination' WHERE name = '$name'";
            $cvResult = mysqli_query($connection, $cvQuery);

            if ($cvResult) {
                echo 'CV uploaded and stored in the database successfully.';
            } else {
                echo 'Error: ' . mysqli_error($connection);
            }
        } else {
            echo 'Error uploading the CV file.';
        }
    }
}
?>

