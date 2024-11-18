<?php
require('config.php');
$con=new mysqli($host,$utilizator,$parola,$BDCabinet);
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

      //$sql="SELECT salariati.NPren, modificarisalariati.Cheie, modificarisalariati.Marca, modificarisalariati.NPren, modificarisalariati.Func, modificarisalariati.SitCIM, modificarisalariati.Rezolvat, modificarisalariati.S1,
      //modificarisalariati.S2, modificarisalariati.S3, modificarisalariati.S4, modificarisalariati.S5, modificarisalariati.S6, modificarisalariati.S7,
      //modificarisalariati.S8, modificarisalariati.S9, modificarisalariati.S10, modificarisalariati.S11, modificarisalariati.S12, modificarisalariati.SalariatNou, modificarisalariati.DataSalvare
      //FROM (modificarisalariati JOIN salariati ON modificarisalariati.Marca=salariati.Marca) WHERE modificarisalariati.Rezolvat 
if(isset($_REQUEST['modificari_tip'])){
    if(isset($_REQUEST['marca'])){$marca=$_REQUEST['marca'];}else{$marca=$_REQUEST['marca'];}
    if ($_REQUEST['modificari_tip']=="Nerezolvate"){
      $sql="SELECT salariati.NPren, modificarisalariati.* FROM (modificarisalariati JOIN salariati ON modificarisalariati.Marca=salariati.Marca) WHERE modificarisalariati.Rezolvat IS NULL";
      }      
    if (is_numeric($marca)){
                    if ($_REQUEST['modificari_tip']=="Rezolvate"){
                      $sql="SELECT salariati.NPren, modificarisalariati.* FROM (modificarisalariati JOIN salariati ON modificarisalariati.Marca=salariati.Marca) WHERE modificarisalariati.Rezolvat = '1' AND salariati.Marca='".$marca."' ORDER BY Cheie DESC LIMIT 500";
                      }
                
        }else{
                    if ($_REQUEST['modificari_tip']=="Rezolvate"){
                      $sql="SELECT salariati.NPren, modificarisalariati.* FROM (modificarisalariati JOIN salariati ON modificarisalariati.Marca=salariati.Marca) WHERE modificarisalariati.Rezolvat = '1'";
                      }                    
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

if(isset($_REQUEST["cheie_m"]) && isset($_REQUEST["tip"])){
    $ok=false;
    if($_REQUEST["tip"]=="Rezolvate"){
        $sql="UPDATE modificarisalariati SET Rezolvat=NULL WHERE Cheie='".$_REQUEST["cheie_m"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=true;}       
    }
    if($_REQUEST["tip"]=="Nerezolvate"){
        $val=1;
        $sql="UPDATE modificarisalariati SET Rezolvat='".$val."' WHERE Cheie='".$_REQUEST["cheie_m"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);$ok=true;}
    }

      if ($ok==true){
           echo "Datele au fost modificate!";
      } 
}


if(isset($_REQUEST["cheie_m"]) && isset($_REQUEST["marca"])){
      $sql="SELECT Marca, NPren, Func, SitCIM, S1, S2, S3, S4, S5, S6 FROM salariati WHERE Marca='".$_REQUEST["marca"]."'";
      $tab=mysqli_query($con,$sql);
	  $tabel=[];
       if(mysqli_num_rows($tab)>0){
            $a=mysqli_fetch_row($tab);
			      for($j=0;$j<count($a);$j++){
			          	$tabel[$j]=$a[$j];
			      }
       if (mysqli_error($con)){
            echo mysqli_error($con);
         }else{echo urlencode(base64_encode(json_encode($tabel)));} 
      }else{echo "Nu exista";}
}


if(isset($_REQUEST['alerte_fise'])){
      date_default_timezone_set ('Europe/Bucharest');
      $date=date('Y-m-d');
      $data_minus_sapte = date('Y-m-d', strtotime($date . ' - 7 days'));

      $date=date('Y-m-d');
      $data_plus_sapte = date('Y-m-d', strtotime($date . ' + 7 days'));

      $sql="SELECT * FROM fise WHERE Data_urm_examen >='".$data_minus_sapte."' and Data_urm_examen <='".$data_plus_sapte."' ORDER BY Data_urm_examen";
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