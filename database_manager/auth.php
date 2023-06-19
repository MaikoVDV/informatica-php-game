<?php
// Lil' convencience function. Thought I'd add more in this file but never really did.
function setCredentials($id, $username, $password)
{
    session_start();
    $_SESSION['user_id'] = $id;
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
}
