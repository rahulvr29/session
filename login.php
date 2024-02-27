<?php
session_start();
$error = ""; // Initialize the $error variable

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Check username and password (you should implement your authentication logic here)
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Open the file for reading
    $file = fopen("users.txt", "r");

    // Check if the file was opened successfully
    if ($file) {
        // Loop through each line in the file
        while (!feof($file)) {
            $line = fgets($file); // Read a line from the file

            // Ensure the line is not empty
            if ($line !== false) {
                $splits = explode(":", $line); // Split the line into username and password

                // Check if the username and password match
                if (trim($splits[0]) == $username && trim($splits[1]) == $password) {
                    $_SESSION['logged_in'] = true;
                    $_SESSION['username'] = $username;
                    fclose($file);
                    header('Location: dashboard.php');
                    exit();
                }
            }
        }

        // fclose($file);
    } else {
        // Error handling if the file couldn't be opened
        $error = 'Error: Unable to open the user database.';
    }

    // If the loop completes without successful login, set error message
    $error = 'Invalid username or password';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Session File</title>
</head>

<body>

    <form class="form" action="" method="post">
        <p id="heading">Login</p>
        <?php if (!empty($error)): ?>
            <p style="color: red;">
                <?php echo $error; ?>
            </p>
        <?php endif; ?>
        <div class="field">
            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                viewBox="0 0 16 16">
                <path
                    d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z">
                </path>
            </svg>
            <input autocomplete="off" placeholder="Username" class="input-field" type="text" name="username">
        </div>
        <div class="field">
            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                viewBox="0 0 16 16">
                <path
                    d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z">
                </path>
            </svg>
            <input placeholder="Password" class="input-field" type="password" name="password">
        </div>
        <div class="btn">
            <button class="button1" name="submit">Login</button>
            <a href="./register.php">
                <span class="button2" name="register">Register</span>
            </a>

    </form>

</body>

</html>