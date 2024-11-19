<?php
require('config.php');
$con=new mysqli(MYSQL_HOST,MYSQL_USER,MYSQL_PASS,MYSQL_DB, MYSQL_PORT);
$con->query('SET character_set_client="utf8",character_set_connection="utf8",character_set_results="utf8", character_set_database = "utf8", character_set_server = "utf8";');

if(isset($_REQUEST['cheie_f'])){
      $sql="SELECT * FROM fise WHERE Cheie='".$_REQUEST['cheie_f']."'";
      $tab=mysqli_query($con,$sql);
	  $tabel=[];
       if(mysqli_num_rows($tab)>0){
         for ($i=0;$i<mysqli_num_rows($tab);$i++){
            $a=mysqli_fetch_row($tab);
			      for($j=0;$j<count($a);$j++){
			          	$tabel[$j]=$a[$j];
			      }
         }
       if (mysqli_error($con)){
            echo mysqli_error($con);
         }else{echo urlencode(base64_encode(json_encode($tabel)));} 
      }else{echo "Nu exista";}
}
?>