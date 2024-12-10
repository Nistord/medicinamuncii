<?php
require('config.php');
$con=new mysqli(MYSQL_HOST,MYSQL_USER,MYSQL_PASS,MYSQL_DB, MYSQL_PORT);
$con->query('SET character_set_client="utf8",character_set_connection="utf8",character_set_results="utf8", character_set_database = "utf8", character_set_server = "utf8";');


if(isset($_REQUEST['ecm']) && isset($_REQUEST['pagina'])){
    $sql="SELECT * FROM utilizatoridrepturi WHERE Marca='".$_REQUEST['ecm']."' AND DenumirePg='".$_REQUEST['pagina']."'";
    $ok=true;
    if($tab=mysqli_query($con,$sql)){
        if(mysqli_num_rows($tab)>0){

        }else{$ok=false;}
    }else{$ok=false;}
    if($ok==true){echo "Exista dreptul.";}
}

?>
