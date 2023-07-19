<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'mpesa');
try {
  $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
    echo "Connection failed";
  }
} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}
