<?php
  function redirect($redirect_url) {
    // Redirect the client to another page.
    header("Location: $redirect_url");
    die();
  }
?>
