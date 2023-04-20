<?php
  $env = parse_ini_file('.env');

  $server_address = $env["SERVER_ADDRESS"];
  $username = $env["SQL_USERNAME"];
  $password = $env["SQL_PASSWORD"];
  $db_name = $env["DATABASE_NAME"];

  $sql_conn = mysqli_connect($server_address, $username, $password);
  if (!$sql_conn) {
    echo "Failed to connect.";
    //die("Failed to connect to database: " . $sql_conn->connect_error);
  }
  mysqli_select_db($sql_conn, "informatica-site");
  $sql_query = "SELECT username FROM users";
  $query_result = mysqli_query($sql_conn, $sql_query);
  if ($query_result) {
  } else {
    echo "Query error.";
  }
  while ($row = mysqli_fetch_assoc($query_result)) {
    echo "username: " . $row["username"] . "<br>";
  }
  //if ($sql_conn->query($sql_query) === TRUE) {
  //  echo "Query completed.";
  //} else {
  //  echo "Failed to send query.";
  //}

  $sql_conn->close();
?>
