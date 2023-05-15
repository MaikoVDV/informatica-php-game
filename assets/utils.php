<?php
  function redirect($redirect_url) {
    // Redirect the client to another page.
    header("Location: $redirect_url");
    die();
  }
  function redirect_error($redirect_url, $error) {
    // Redirect the client to another page with an error URL parameter.
    header("Location: $redirect_url?error='$error'");
    die();
  }
?>
