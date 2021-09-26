<?php

$id = $_GET['id'];
$flag = $_GET['flag'];

function check_error($r,$m)
{
    if(!$r){
        die("Error " . $m);
}
}

function redirect($url)
{

}

function edit()
{
    global $id, $db_conn;
    $query = "SELECT * FROM contacts WHERE id = '$id'";
    $result = pg_query($db_conn,$query);

    check_error($result,"editing '$id'");
    
    $row = 0;
    $firstname = pg_result($result,$row,'fullname');
    $phone = pg_result($result,$row,'phone');
    $email = pg_result($result,$row,'email');

    echo '<script type ="text/javascript"> 
console.log("from editing php");
let db_show = document.getElementById("show_db");
db_show.style.visibility = "hidden";

document.getElementById("register").value = "1";
document.getElementById("fullname").value = "'.$firstname.'";
document.getElementById("phone").value = "'.$phone.'";
document.getElementById("email").value = "'.$email.'";
document.getElementById("contact_id").value = "'.$id.'";

</script>';
}

function delete()
{
    global $id, $db_conn;
    $query = "DELETE FROM contacts WHERE id = '$id'";
    $result = pg_query($db_conn,$query);

    check_error($result,"deleting '$id'");

    echo '<script type="text/javascript"> window.location = "index.html/"</script>';
}

if(isset($id))
{
    switch($flag){

        case '0':
            edit();
            break;
        case '1':
            delete();
            break;
        default:
            break;
}}

?>
