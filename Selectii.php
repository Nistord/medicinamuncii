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


    if(isset($_REQUEST['dencod'])){
          $sql="SELECT * FROM clasificare";
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
    

    if(isset($_REQUEST['selectii'])){
          $sql="SELECT * FROM clasificare ORDER BY DenumireCodDiagnostic";
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
    
    
    if(isset($_REQUEST['aparatul'])){
          $sql="SELECT DISTINCT Aparatul FROM clasificare";
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