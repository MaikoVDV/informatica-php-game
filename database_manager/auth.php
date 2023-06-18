<?php

function setCredentials($id, $username, $password)
{
    session_start();
    $_SESSION['user_id'] = $id;
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
}
