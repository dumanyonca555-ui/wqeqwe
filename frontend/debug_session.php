<?php
session_start();
echo "Session data:<br>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

echo "GET data:<br>";
echo "<pre>";
print_r($_GET);
echo "</pre>";

echo "POST data:<br>";
echo "<pre>";
print_r($_POST);
echo "</pre>";
?>