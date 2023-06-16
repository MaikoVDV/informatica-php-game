<?php
  session_start();
  $env = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/informatica-php-website/.env');

  $server_address = $env["SERVER_ADDRESS"];
  $username = $env["SQL_USERNAME"];
  $password = $env["SQL_PASSWORD"];
  $db_name = $env["DATABASE_NAME"];
  $sql_conn = mysqli_connect($server_address, $username, $password);
  //$sql_conn = mysqli_connect($server_address, "informatica-site", "welkom2020");
  if (!$sql_conn) {
    echo "Failed to connect.";
    //die("Failed to connect to database: " . $sql_conn->connect_error);
  }
  //$_SESSION['sql_conn'] = $sql_conn;
  mysqli_select_db($sql_conn, "informatica-site");
?>
