<?php

if(isset($_REQUEST['luna']) && isset($_REQUEST['anul'])){
   require('config.php');
   $con=new mysqli($host,$utilizator,$parola,$BDCabinet);
   $con->query('SET character_set_client="utf8",character_set_connection="utf8",character_set_results="utf8", character_set_database = "utf8", character_set_server = "utf8";');
   
     
     $boli = array();
     
     $tokenul="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6ImZhM2NiMzUwLTZiODEtMTFlZi1hYjYxLTQ3MGY2Mzg5NTIzYSIsImNsaWVudCI6eyJ1dWlkIjoiMzU0YTVhOTQtZDJjYS0xMWVkLWFmYTEtMDI0MmFjMTIwMDAyIiwibmFtZSI6IkRpc3BlbnNhciJ9LCJwZXJtcyI6ImNoYXJpc21hLnNpY2tfbGVhdmVzLGFuZ2FqYXQubGlzdF90ZW1wbGF0ZSxhdmF0YXIubGlzdCIsImlhdCI6MTcyNTUzOTE0NiwiZXhwIjo0ODQ3NjAzMTQ2LCJtZXRhIjp7fX0.78s-YPc_AcWiYzxL2QSOyuogffFKx2SXDMUupExyFQo";
     
     $curl = curl_init();
   //trebuie sa inlocuiesc cu rul-ul necesar pentru luni diferite si ani diferiti
   
   curl_setopt_array($curl, array(
     CURLOPT_URL => 'https://charisma-collector.antibiotice.ro/sick-leaves?year='.$_REQUEST['anul'].'&month='.$_REQUEST['luna'],  //https://angajat.antibiotice.ro/list/infconf   https://angajat.antibiotice.ro/list/dispensar   
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => '',
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 0,
     CURLOPT_FOLLOWLOCATION => true,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => 'GET',
     CURLOPT_HTTPHEADER => array(
       'Authorization: Bearer '.$tokenul
     ),
   ));
   curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
   curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
   $response = curl_exec($curl);
   //echo $response;
   curl_close($curl);
   $concedii = json_decode($response, true);
    //echo $concedii[0]["_Luna"]." ".$concedii[0]["_Anul"];
   foreach ($concedii as $concediip) {
    $sql="DELETE FROM concedii WHERE Luna='".$concediip["_Luna"]."' AND An='".$concediip["_Anul"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);}
    break;
   }
   foreach ($concedii as $concediip) {
     //intorc informatia privind aparatul din baza de date
     $sql="SELECT Aparatul FROM clasificare WHERE CodDiagnostic='".$concediip["_COD_DIAGNOSTIC"]."'";
      $tab=mysqli_query($con,$sql);
       if(mysqli_num_rows($tab)>0){
         $a=mysqli_fetch_row($tab);         
         $cod=$a[0];
      }
     //$nume_complet=trim($concediip["_NUME"])." ".trim($concediip["_PRENUME"]);
     $sql="INSERT INTO concedii (Marca) VALUES ('".(int)$concediip["_MARCA"]."')"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);}
     $sql="SELECT Cheie FROM concedii ORDER BY Cheie DESC LIMIT 1";
      $tab=mysqli_query($con,$sql);
       if(mysqli_num_rows($tab)>0){
         $a=mysqli_fetch_row($tab);         
         $ch=$a[0];
      }
     $sql="UPDATE concedii SET NPren='".$nume_complet."', CodDiagnostic='".$concediip["_COD_DIAGNOSTIC"]."', Afectiune='".$concediip["_AFECTIUNE"]."', Aparat='".$cod."', TipConcediu='Boala', DStart='".$concediip["data_start"]."', DStop='".$concediip["data_stop"]."', Zile='".$concediip["_zi_calend"]."', Varsta='".$concediip["_Varsta"]."' , Luna='".$concediip["_Luna"]."' , An='".$concediip["_Anul"]."' WHERE Cheie='".$ch."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);}
   }
   
    $con->close(); 
}

 
?>