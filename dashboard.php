<?php
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit();
}
if (!isset($_SESSION['last_activity'])) {
  $_SESSION['last_activity'] = time();
}

// If last activity time is older than 10 seconds, destroy the session and redirect to login page
if (time() - $_SESSION['last_activity'] > 10) {
  session_destroy();
  header('Location: login.php');
  exit();
}

// Update last activity time
$_SESSION['last_activity'] = time();


?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
</head>

<body>
  <p>Welcome,
    <?php echo $_SESSION['username']; ?>!
  </p>


  <a href="logout.php"><button type="submit" name="logout">Logout</button></a>
  <script>
    setTimeout(function () {
      window.location.href = 'logout.php';
    }, 10000); // 10 seconds in milliseconds
  </script>
</body>

</html>