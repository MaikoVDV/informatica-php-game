<?php
  // Get MySQL credentials
  $env = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/informatica-php-website/.env');

  $server_address = $env["SERVER_ADDRESS"];
  $username = $env["SQL_USERNAME"];
  $password = $env["SQL_PASSWORD"];
  $db_name = $env["DATABASE_NAME"];

  // Connect to MySQL and select the database
  $sql_conn = mysqli_connect($server_address, $username, $password);
  if (!$sql_conn) {
    echo "Failed to connect.";
    //die("Failed to connect to database: " . $sql_conn->connect_error);
  }
  mysqli_select_db($sql_conn, $db_name);
?>
