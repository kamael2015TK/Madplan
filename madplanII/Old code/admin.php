<?php 
echo "hej";
$options = ['cost' => 12,];
$Password =  password_hash("tara0100", PASSWORD_BCRYPT, $options);
echo $Password;