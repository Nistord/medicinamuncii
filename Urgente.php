<?php

require('config.php');
$con=new mysqli(MYSQL_HOST,MYSQL_USER,MYSQL_PASS,MYSQL_DB, MYSQL_PORT);
$con->query('SET character_set_client="utf8",character_set_connection="utf8",character_set_results="utf8", character_set_database = "utf8", character_set_server = "utf8";');

if(isset($_REQUEST['ptsql']) && isset($_REQUEST['pagina'])){
    $s=substr($_REQUEST['ptsql'],0,29);
    if ($s=="salariati.S1='Salariatii ATB'"){ //$_REQUEST['ptsql']=="S1='Salariatii ATB'"
        $s=substr($_REQUEST['ptsql'],30,strlen($_REQUEST['ptsql']));
        if (strlen($s)==0){
             $sql="SELECT salariati.Cheie, salariati.Marca, salariati.NPren, salariati.CNP, salariati.DNastere, salariati.Sex, salariati.Func, salariati.SitCIM, salariati.S1, salariati.S2, salariati.S3, salariati.S4, salariati.S5, salariati.S6, urgente.Ambulanta, urgente.Data, urgente.Ora, urgente.Observatii FROM (salariati JOIN urgente ON urgente.Marca=salariati.Marca) ORDER BY salariati.NPren";
        }else{
        $s=substr($_REQUEST['ptsql'],34,strlen($_REQUEST['ptsql']));
        $sql="SELECT salariati.Cheie, salariati.Marca, salariati.NPren, salariati.CNP, salariati.DNastere, salariati.Sex, salariati.Func, salariati.SitCIM, salariati.S1, salariati.S2, salariati.S3, salariati.S4, salariati.S5, salariati.S6, urgente.Ambulanta, urgente.Data, urgente.Ora, urgente.Observatii  FROM (salariati JOIN urgente ON urgente.Marca=salariati.Marca) WHERE ".$s." ORDER BY salariati.NPren";
        }
    }else{
        $sql="SELECT salariati.Cheie, salariati.Marca, salariati.NPren, salariati.CNP, salariati.DNastere, salariati.Sex, salariati.Func, salariati.SitCIM, salariati.S1, salariati.S2, salariati.S3, salariati.S4, salariati.S5, salariati.S6, urgente.Ambulanta, urgente.Data, urgente.Ora, urgente.Observatii FROM (salariati JOIN urgente ON urgente.Marca=salariati.Marca) WHERE ".$_REQUEST['ptsql']." ORDER BY salariati.NPren";
        //$sql="SELECT * FROM salariati WHERE ".$_REQUEST['ptsql'];       
    }
      $tab=mysqli_query($con,$sql);
	  $tabel=[];
       if(mysqli_num_rows($tab)>0){
         for ($i=0;$i<mysqli_num_rows($tab);$i++){
            $a=mysqli_fetch_row($tab);
			      for($j=0;$j<count($a);$j++){
			          	$tabel[$i][$j]=$a[$j];
			      }
         }
       if (mysqli_error($con)){
            echo mysqli_error($con);
         }else{echo urlencode(base64_encode(json_encode($tabel)));} 
      }else{echo "Nu exista";}
}


if(isset($_REQUEST['cheie_salariat']) && isset($_REQUEST['pagina'])){
      $sql="SELECT salariati.Cheie, salariati.Marca, salariati.NPren, salariati.CNP, salariati.DNastere, salariati.Sex, salariati.Func, salariati.SitCIM, urgente.Ambulanta, urgente.Data, urgente.Ora,
      urgente.Observatii FROM (salariati JOIN urgente ON urgente.Marca=salariati.Marca) WHERE salariati.Cheie=".$_REQUEST['cheie_salariat']." ORDER BY salariati.NPren";  
      $tab=mysqli_query($con,$sql);
	  $tabel=[];
       if(mysqli_num_rows($tab)>0){
         for ($i=0;$i<mysqli_num_rows($tab);$i++){
            $a=mysqli_fetch_row($tab);
			      for($j=0;$j<count($a);$j++){
			          	$tabel[$i][$j]=$a[$j];
			      }
         }
       if (mysqli_error($con)){
            echo mysqli_error($con);
         }else{echo urlencode(base64_encode(json_encode($tabel)));} 
      }else{echo "Nu exista";}
}
?>