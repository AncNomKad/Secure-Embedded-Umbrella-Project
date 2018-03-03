<?php

echo "Hello there<br>";
$salt = "1D7CWOQU7kxUFu5wAKygI5QhwG2AO7";
$salt = base64_encode($salt);
$hash = crypt("$password", $salt);

echo "Salt is: ".$salt."<br>";
echo "Hash is: ".$hash."<br>";


?>
