<?php
require_once "ALL_PHP/db.php";

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $first_name   = $_POST['name'] ?? '';
    $last_name    = $_POST['lastname'] ?? '';
    $phone_number = $_POST['number'] ?? '';
    $email        = $_POST['email'] ?? '';
    $location     = $_POST['location'] ?? '';
    $help_message = $_POST['help'] ?? '';

    $sql = "INSERT INTO submissions 
           (first_name, last_name, phone_number, email, location, help_message)
            VALUES (:first_name, :last_name, :phone_number, :email, :location, :help_message)";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':first_name'   => $first_name,
            ':last_name'    => $last_name,
            ':phone_number' => $phone_number,
            ':email'        => $email,
            ':location'     => $location,
            ':help_message' => $help_message
        ]);

        $success_message = "Thank you for contacting us! Your information has been saved.";

    } catch (PDOException $e) {
        $error_message = "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="new3.css" />
  <title>Contact</title>
</head>
<body>

<?php if (!empty($success_message)): ?>
    <div style="text-align:center; margin-top:20px; color:green;">
        <h3><?= $success_message ?></h3>
    </div>
<?php endif; ?>

<?php if (!empty($error_message)): ?>
    <div style="text-align:center; margin-top:20px; color:red;">
        <h3><?= $error_message ?></h3>
    </div>
<?php endif; ?>
