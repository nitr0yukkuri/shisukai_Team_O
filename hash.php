<?php
$password = "0001"; // ← change this to any password you want
$hash = password_hash($password, PASSWORD_DEFAULT);

echo $hash;
