<?php

function filter_name($name)
{
    $name = filter_var(trim($name),FILTER_SANITIZE_STRING);
    
    if(filter_var($name,FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z]+\s[a-zA-Z]+$/")))){
        return $name;
}else
{
return FALSE;
}
}

function filter_email($email){
    $email = filter_var(trim($email),FILTER_SANITIZE_EMAIL);

    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
        return $email;
}else
{
return FALSE;
}
}

function filter_phone($number){
    $number = filter_var(trim($number),FILTER_SANITIZE_STRING);

    if(filter_var($number,FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^[0-9]+$/")))){
        return $number;
}else
{
return FALSE;
}
}

$message_success = $message_error = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{

$fullname = ($_POST["fullname"]);
$phone = $_POST["phone"];
$email = $_POST["email"];

$state =  $_POST["register"];
$contact_id = $_POST["contact_id"];

if(empty($fullname)){
    $message_error = "Please enter your name.";
}else
{
    $fullname = filter_name($fullname);
    if($fullname == FALSE){
        $message_error = "Please enter a valid name.";
}
}

if(empty($phone)){
    $message_error = "Please enter your phone number.";
}else
{
    $phone = filter_phone($phone);
    if($phone == FALSE){
        $message_error = "Please enter a valid number.";
}
}

if(empty($email)){
    $message_error = "Please enter your email.";
}else
{
    $email = filter_email($email);
    if($email == FALSE){
        $message_error = "Please enter a valid email.";
}
}

if($message_error == "")
{

switch($state){
case 0:
$response = pg_query($db_conn,"insert into contacts(fullname,phone,email) values('$fullname','$phone','$email')");
if(!$response){
die("An error ocurred <br>");
}

$message_success = "Contact added successfully";

break;

case 1:

$query = "UPDATE contacts SET fullname = '$fullname', phone = '$phone', email = '$email' WHERE id = '$contact_id'";

$response = pg_query($db_conn,$query);

if(!$response)
{
die ("An error ocurred while editing<br>");
}

$message_success = "Contact edited successfully";

break;

}
}

}
?>
