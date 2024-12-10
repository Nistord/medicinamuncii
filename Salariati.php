<?php
require('config.php');
$con=new mysqli(MYSQL_HOST,MYSQL_USER,MYSQL_PASS,MYSQL_DB, MYSQL_PORT);
$con->query('SET character_set_client="utf8",character_set_connection="utf8",character_set_results="utf8", character_set_database = "utf8", character_set_server = "utf8";');

if(isset($_REQUEST['ptsql']) && isset($_REQUEST['pagina'])){
    if ($_REQUEST['ptsql']=="S1='Salariatii ATB'"){
        $sql="SELECT * FROM salariati ORDER BY NPren";
    }else{
        $sql="SELECT * FROM salariati WHERE ".$_REQUEST['ptsql']." ORDER BY NPren";       
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

if(isset($_REQUEST['marca_concedii'])){
      $sql="SELECT * FROM concedii WHERE Marca='".$_REQUEST['marca_concedii']."' ORDER BY DStart Desc";
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

if(isset($_REQUEST['marca_boala'])){
      $sql="SELECT * FROM boli WHERE Marca='".$_REQUEST['marca_boala']."' ORDER BY DStart Desc";
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

if(isset($_REQUEST['marca_urgente'])){
      $sql="SELECT * FROM urgente WHERE Marca='".$_REQUEST['marca_urgente']."' ORDER BY Data Desc";
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

if(isset($_REQUEST['marca_fise'])){
      $sql="SELECT * FROM fise WHERE Marca='".$_REQUEST['marca_fise']."' ORDER BY Data_fisa Desc";
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

if(isset($_REQUEST['cauta_diag'])){
       $sql="SELECT * FROM clasificare ORDER BY DenumireCodDiagnostic";
       $tab=mysqli_query($con,$sql);
		     $tabel=[];
   				$cecaut=strtoupper($_REQUEST['cauta_diag']);
       if(mysqli_num_rows($tab)>0){
				     $i1=0;
         for ($i=0;$i<mysqli_num_rows($tab);$i++){
            $a=mysqli_fetch_row($tab);
			$text=strtoupper($a[2]);
			  if (strpos($text,$cecaut)>-1){
                    $tabel[$i1][0]=$a[0];
                    $tabel[$i1][1]=$a[1];
                    $tabel[$i1][2]=$a[2];
                    $tabel[$i1][3]=$a[3];
					$i1=$i1+1;
                if ($i1>=25){break;}
			}
         }
       if (mysqli_error($con)){
                         echo mysqli_error($con);
         }else{echo urlencode(base64_encode(json_encode($tabel)));} 
      }else{echo "Nu exista";  }
}

if(isset($_REQUEST["salveaza_tsb"])){
  $t_boli=json_decode(urldecode(base64_decode($_REQUEST["salveaza_tsb"])));
  $ok=true;
  if ($t_boli[6]!==""){
           $sql="INSERT INTO boli (Marca, CodDiagnostic, DenumireCodDiagnostic, Afectiunea, Aparatul, DStart, DStop) VALUES ('".$t_boli[0]."','".$t_boli[1]."','".$t_boli[2]."','".$t_boli[4]."','".$t_boli[3]."','".$t_boli[5]."','".$t_boli[6]."')";    
  }else{
           $sql="INSERT INTO boli (Marca, CodDiagnostic, DenumireCodDiagnostic, Afectiunea, Aparatul, DStart) VALUES ('".$t_boli[0]."','".$t_boli[1]."','".$t_boli[2]."','".$t_boli[4]."','".$t_boli[3]."','".$t_boli[5]."')"; 
  }

         mysqli_query($con,$sql);
         if (mysqli_error($con)){
                            $ok=false;
                            echo mysqli_error($con);
         }

      if ($ok==true){
           echo "Datele au fost salvate!";
      } 
}

if(isset($_REQUEST["modifica_tsb"]) && isset($_REQUEST["cheie_bo"])){
    $t_boli=json_decode(urldecode(base64_decode($_REQUEST["modifica_tsb"])));
    $ok=true;
    $sql="UPDATE boli SET CodDiagnostic='".$t_boli[1]."' WHERE Cheie='".$_REQUEST["cheie_bo"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    $sql="UPDATE boli SET DenumireCodDiagnostic='".$t_boli[2]."' WHERE Cheie='".$_REQUEST["cheie_bo"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    $sql="UPDATE boli SET Afectiunea='".$t_boli[3]."' WHERE Cheie='".$_REQUEST["cheie_bo"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    $sql="UPDATE boli SET Aparatul='".$t_boli[4]."' WHERE Cheie='".$_REQUEST["cheie_bo"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    $sql="UPDATE boli SET DStart='".$t_boli[5]."' WHERE Cheie='".$_REQUEST["cheie_bo"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    if ($t_boli[6]==""){
         $sql="UPDATE boli SET DStop=NULL WHERE Cheie='".$_REQUEST["cheie_bo"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}      
    }else{
         $sql="UPDATE boli SET DStop='".$t_boli[6]."' WHERE Cheie='".$_REQUEST["cheie_bo"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}   
    }

      if ($ok==true){
           echo "Datele au fost modificate!";
      } 
}


if(isset($_REQUEST["sterge"]) && isset($_REQUEST["cheie_bo"])){
    $ok=true;
    $sql="DELETE FROM boli WHERE Cheie='".$_REQUEST["cheie_bo"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);}
      if ($ok==true){
           echo "Am sters!";
      } 
}



if(isset($_REQUEST["salveaza_tsu"])){
  $t_urgente=json_decode(urldecode(base64_decode($_REQUEST["salveaza_tsu"])));
  $ok=true;
  $sql="INSERT INTO urgente (Marca) VALUES ('".$t_urgente[0]."')";mysqli_query($con,$sql);if (mysqli_error($con)){echo mysqli_error($con);}
  $sql3="SELECT Cheie FROM urgente ORDER BY Cheie DESC LIMIT 1";            
  $tab3=mysqli_query($con,$sql3);
  for ($i=0;$i<mysqli_num_rows($tab3);$i++){
      $a_ch=mysqli_fetch_row($tab3);
  }
  $sql="UPDATE urgente SET Ambulanta='".$t_urgente[1]."' WHERE Cheie='".$a_ch[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
  $sql="UPDATE urgente SET Data='".$t_urgente[2]."' WHERE Cheie='".$a_ch[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
  $sql="UPDATE urgente SET Ora='".$t_urgente[3]."' WHERE Cheie='".$a_ch[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
  $sql="UPDATE urgente SET Observatii='".$t_urgente[4]."' WHERE Cheie='".$a_ch[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
  if ($ok==true){
           echo "Datele au fost salvate!";
  }
}

if (isset($_REQUEST["marca_salariat_pt_poza"])){

}





if(isset($_REQUEST["modifica_tsu"]) && isset($_REQUEST["cheie_u"])){
    $t_urgente=json_decode(urldecode(base64_decode($_REQUEST["modifica_tsu"])));
    $ok=true;
    $sql="UPDATE urgente SET Ambulanta='".$t_urgente[1]."' WHERE Cheie='".$_REQUEST["cheie_u"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    if ($t_urgente[2]==""){
       $sql="UPDATE urgente SET Data=NULL WHERE Cheie='".$_REQUEST["cheie_u"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}      
    }else{
       $sql="UPDATE urgente SET Data='".$t_urgente[2]."' WHERE Cheie='".$_REQUEST["cheie_u"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;} 
    }
    if ($t_urgente[3]==""){
       $sql="UPDATE urgente SET Ora=NULL WHERE Cheie='".$_REQUEST["cheie_u"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}      
    }else{
       $sql="UPDATE urgente SET Ora='".$t_urgente[3]."' WHERE Cheie='".$_REQUEST["cheie_u"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}   
    }
    $sql="UPDATE urgente SET Observatii='".$t_urgente[4]."' WHERE Cheie='".$_REQUEST["cheie_u"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}

      if ($ok==true){
           echo "Datele au fost modificate!";
      } 
}


if(isset($_REQUEST["stergeu"]) && isset($_REQUEST["cheie_u"])){
    $ok=true;
    $sql="DELETE FROM urgente WHERE Cheie='".$_REQUEST["cheie_u"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);}
      if ($ok==true){
           echo "Am sters!";
      } 
}



if(isset($_REQUEST["salveaza_tsf"])){
  $t_fise=json_decode(urldecode(base64_decode($_REQUEST["salveaza_tsf"])));
  $ok=true;
  $sql="INSERT INTO fise (Marca) VALUES ('".$_REQUEST["Marca"]."')";mysqli_query($con,$sql);if (mysqli_error($con)){echo mysqli_error($con);}
  $sql3="SELECT Cheie FROM fise ORDER BY Cheie DESC LIMIT 1";            
  $tab3=mysqli_query($con,$sql3);
  for ($i=0;$i<mysqli_num_rows($tab3);$i++){
      $a_ch=mysqli_fetch_row($tab3);
  }
  $sql="UPDATE fise SET Cal_medicament='".$t_fise[0]."' WHERE Cheie='".$a_ch[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
  $sql="UPDATE fise SET Angajare='".$t_fise[1]."' WHERE Cheie='".$a_ch[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
  $sql="UPDATE fise SET Control_medical='".$t_fise[2]."' WHERE Cheie='".$a_ch[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
  $sql="UPDATE fise SET Adaptare='".$t_fise[3]."' WHERE Cheie='".$a_ch[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
  $sql="UPDATE fise SET Reluarea_muncii='".$t_fise[4]."' WHERE Cheie='".$a_ch[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
  $sql="UPDATE fise SET Supraveghere='".$t_fise[5]."' WHERE Cheie='".$a_ch[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
  $sql="UPDATE fise SET Altele='".$t_fise[6]."' WHERE Cheie='".$a_ch[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
  $sql="UPDATE fise SET Nr_fisa='".$t_fise[7]."' WHERE Cheie='".$a_ch[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
  $sql="UPDATE fise SET An_fisa='".$t_fise[8]."' WHERE Cheie='".$a_ch[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
  //$sql="UPDATE fise SET Marca='".$t_fise[9]."' WHERE Cheie='".$a_ch[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
  $sql="UPDATE fise SET Nume='".$t_fise[9]."' WHERE Cheie='".$a_ch[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
  $sql="UPDATE fise SET Prenume='".$t_fise[10]."' WHERE Cheie='".$a_ch[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
  $sql="UPDATE fise SET CNP='".$t_fise[11]."' WHERE Cheie='".$a_ch[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
  $sql="UPDATE fise SET Functia='".$t_fise[12]."' WHERE Cheie='".$a_ch[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
  $sql="UPDATE fise SET Loc_munca='".$t_fise[13]."' WHERE Cheie='".$a_ch[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
  $sql="UPDATE fise SET Tip_aviz_medical='".$t_fise[14]."' WHERE Cheie='".$a_ch[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
  $sql="UPDATE fise SET R_inaltime='".$t_fise[15]."' WHERE Cheie='".$a_ch[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
  $sql="UPDATE fise SET R_noapte='".$t_fise[16]."' WHERE Cheie='".$a_ch[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
  $sql="UPDATE fise SET R_auto='".$t_fise[17]."' WHERE Cheie='".$a_ch[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
  $sql="UPDATE fise SET Alte_recomandari='".$t_fise[18]."' WHERE Cheie='".$a_ch[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
  $sql="UPDATE fise SET Data_fisa='".$t_fise[19]."' WHERE Cheie='".$a_ch[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
  $sql="UPDATE fise SET Medic_mm='".$t_fise[20]."' WHERE Cheie='".$a_ch[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
  $sql="UPDATE fise SET Data_urm_examen='".$t_fise[21]."' WHERE Cheie='".$a_ch[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
  if ($ok==true){
           echo "Datele au fost salvate!";
  }
}

if(isset($_REQUEST["modifica_tsf"]) && isset($_REQUEST["cheie_f"])){
    $t_fise=json_decode(urldecode(base64_decode($_REQUEST["modifica_tsf"])));
    $ok=true;
    $sql="UPDATE fise SET Cal_medicament='".$t_fise[0]."' WHERE Cheie='".$_REQUEST["cheie_f"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    $sql="UPDATE fise SET Angajare='".$t_fise[1]."' WHERE Cheie='".$_REQUEST["cheie_f"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    $sql="UPDATE fise SET Control_medical='".$t_fise[2]."' WHERE Cheie='".$_REQUEST["cheie_f"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    $sql="UPDATE fise SET Adaptare='".$t_fise[3]."' WHERE Cheie='".$_REQUEST["cheie_f"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    $sql="UPDATE fise SET Reluarea_muncii='".$t_fise[4]."' WHERE Cheie='".$_REQUEST["cheie_f"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    $sql="UPDATE fise SET Supraveghere='".$t_fise[5]."' WHERE Cheie='".$_REQUEST["cheie_f"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    $sql="UPDATE fise SET Altele='".$t_fise[6]."' WHERE Cheie='".$_REQUEST["cheie_f"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    $sql="UPDATE fise SET Nr_fisa='".$t_fise[7]."' WHERE Cheie='".$_REQUEST["cheie_f"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    $sql="UPDATE fise SET An_fisa='".$t_fise[8]."' WHERE Cheie='".$_REQUEST["cheie_f"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    //$sql="UPDATE fise SET Marca='".$t_fise[9]."' WHERE Cheie='".$_REQUEST["cheie_f"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    $sql="UPDATE fise SET Nume='".$t_fise[9]."' WHERE Cheie='".$_REQUEST["cheie_f"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    $sql="UPDATE fise SET Prenume='".$t_fise[10]."' WHERE Cheie='".$_REQUEST["cheie_f"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    $sql="UPDATE fise SET CNP='".$t_fise[11]."' WHERE Cheie='".$_REQUEST["cheie_f"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    $sql="UPDATE fise SET Functia='".$t_fise[12]."' WHERE Cheie='".$_REQUEST["cheie_f"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    $sql="UPDATE fise SET Loc_munca='".$t_fise[13]."' WHERE Cheie='".$_REQUEST["cheie_f"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    $sql="UPDATE fise SET Tip_aviz_medical='".$t_fise[14]."' WHERE Cheie='".$_REQUEST["cheie_f"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    $sql="UPDATE fise SET R_inaltime='".$t_fise[15]."' WHERE Cheie='".$_REQUEST["cheie_f"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    $sql="UPDATE fise SET R_noapte='".$t_fise[16]."' WHERE Cheie='".$_REQUEST["cheie_f"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    $sql="UPDATE fise SET R_auto='".$t_fise[17]."' WHERE Cheie='".$_REQUEST["cheie_f"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    $sql="UPDATE fise SET Alte_recomandari='".$t_fise[18]."' WHERE Cheie='".$_REQUEST["cheie_f"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    $sql="UPDATE fise SET Data_fisa='".$t_fise[19]."' WHERE Cheie='".$_REQUEST["cheie_f"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    $sql="UPDATE fise SET Medic_mm='".$t_fise[20]."' WHERE Cheie='".$_REQUEST["cheie_f"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    $sql="UPDATE fise SET Data_urm_examen='".$t_fise[21]."' WHERE Cheie='".$_REQUEST["cheie_f"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=false;}
    if ($ok==true){
             echo "Datele au fost salvate!";
    }
}

if(isset($_REQUEST["stergef"]) && isset($_REQUEST["cheie_f"])){
    $ok=true;
    $sql="DELETE FROM fise WHERE Cheie='".$_REQUEST["cheie_f"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);}
      if ($ok==true){
           echo "Am sters!";
      } 
}


if(isset($_REQUEST['marca_salariat_pt_poza'])){
    $tokenul="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6ImZhM2NiMzUwLTZiODEtMTFlZi1hYjYxLTQ3MGY2Mzg5NTIzYSIsImNsaWVudCI6eyJ1dWlkIjoiMzU0YTVhOTQtZDJjYS0xMWVkLWFmYTEtMDI0MmFjMTIwMDAyIiwibmFtZSI6IkRpc3BlbnNhciJ9LCJwZXJtcyI6ImNoYXJpc21hLnNpY2tfbGVhdmVzLGFuZ2FqYXQubGlzdF90ZW1wbGF0ZSxhdmF0YXIubGlzdCIsImlhdCI6MTcyNTUzOTE0NiwiZXhwIjo0ODQ3NjAzMTQ2LCJtZXRhIjp7fX0.78s-YPc_AcWiYzxL2QSOyuogffFKx2SXDMUupExyFQo";
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://employee-avatar.antibiotice.ro/avatars/'.$_REQUEST['marca_salariat_pt_poza'].'?format=data',
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
    curl_close($curl);
    echo $response;

    //$imagine = json_decode($response, true);
    //echo $imagine;
}
$con->close();
?>