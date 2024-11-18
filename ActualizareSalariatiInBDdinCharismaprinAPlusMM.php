<?php
require('config.php');
$con=new mysqli($host,$utilizator,$parola,$BDCabinet);
$con->query('SET character_set_client="utf8",character_set_connection="utf8",character_set_results="utf8", character_set_database = "utf8", character_set_server = "utf8";');

  
  $salariati = array();

	$cod=base64_encode("a188a3b6-b7bd-11eb-8529-0242ac130003:DIASfKsnmtYCpWyv");
	$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => 'https://login.antibiotice.ro/apptoken', //
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 5,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'POST',
	CURLOPT_HTTPHEADER => array(
						   'Authorization: Basic '.$cod,
							'Content-Type: application/json'
		),
	));
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
	$response = curl_exec($curl);

	//preiau tokenul
	$tokenul=substr($response,strpos($response,'":"')+3,strlen($response));
	$tokenul=substr($tokenul,0,strpos($tokenul,'","'));
  
  $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://angajat.antibiotice.ro/list/dispensar',  //https://angajat.antibiotice.ro/list/infconf      
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
$salariati = json_decode($response, true);
foreach ($salariati as $salariatp) {
  //verific existenta marcii
  $sql="SELECT * FROM salariati WHERE Marca='".$salariatp["marca"]."'";
              if($tab=mysqli_query($con,$sql)) {
                      if(mysqli_num_rows($tab)>=1){
                       //daca exista deja marca atunci am ce fetch-ui, in caz contrar, nu am 
                         $a=mysqli_fetch_row($tab);
                               $sql="UPDATE salariati SET NPren='".$salariatp["nume_complet"]."', CNP='".$salariatp["cnp"]."', DNastere='".$salariatp["data_nastere"]."', Sex='".$salariatp["sex"]."', Func='".$salariatp["functie"]."', SitCIM='".$salariatp["contract_state"]."', FlotaLung='".$salariatp["mobil"]."', TelPersonal='".$salariatp["personal"]."', Nume='".$salariatp["nume"]."', Prenume='".$salariatp["prenume"]."' WHERE Marca='".$salariatp["marca"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);}
                               if (count($salariatp["department_path"])>0){
                                   for ($i=0;$i<count($salariatp["department_path"]);$i++){
                                       $i1=$i+1;
                                       if ($salariatp["department_path"][$i]["name"]!==""){
                                           $sql="UPDATE salariati SET S".$i1."='".$salariatp["department_path"][$i]["name"]."' WHERE Marca='".$salariatp["marca"]."'";
                                           mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);}
                                       }                                
                                   }                                
                               }
                               
                               //verific daca exista diferente intre ce exista in baza de date si ceea ce este actual
                               $ok=false;
                               if ($salariatp["nume_complet"]!==$a[2] || $salariatp["functie"]!==$a[6] || $salariatp["contract_state"]!==$a[7])
                               {$ok=true;}
                               if (count($salariatp["department_path"])>0){

                                   for ($i=0;$i<count($salariatp["department_path"]);$i++){
                                       if ($salariatp["department_path"][$i]["name"]!==$a[$i+11]){
                                           $ok=true;
                                       }
                                   }
                                //caut pana unde este informatie in $a
                                     for ($g=11;$g<count($a);$g++){
                                        if ($a[$g]==null || $a[$g]==""){
                                          break;
                                        }
                                     }
                                     if ($g-11>count($salariatp["department_path"])){ //era -10
                                             //verific daca nu cumva sunt si informatii mai departe de lungimea $salariatp["department_path"]
                                             for ($i=count($salariatp["department_path"])+1;$i<=$g-11;$i++){ //  fara -1   aici rtrebuie sa sterg pentru situatiile in care au existat informatii pe substructuri mai numeroase ex: exista informatie pe S6 dar conform noii organigrame informatia se opreste acum la S4
                                                           //$i1=$i+1;
                                                           if ($a[$i+11]!==""){
                                                                   $sql="UPDATE salariati SET S".$i."=NULL WHERE Marca='".$salariatp["marca"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);}
                                                           }                                
                                             }                                         
                                     }
                                
                               }
                               //daca exista modificari atunci inserez marca, caut ultima inregistrare si preiau cheia deoarece aceeasi marca poate fi de mai multe ori in tabelul cu modifiari
                               if($ok==true){
                                   $data=date('Y-m-d H:i:s');
                                   $sql="INSERT INTO modificarisalariati (Marca,DataSalvare) VALUES('".$salariatp["marca"]."', '".$data."')";
                                   mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);}
                                   //cauta si intoarce cheia ultimului camp introdus
                                   $sql="SELECT Cheie FROM modificarisalariati ORDER BY Cheie DESC LIMIT 1";mysqli_query($con,$sql);
                                     if($tab=mysqli_query($con,$sql)) {
                                        if(mysqli_num_rows($tab)>=1){
                                           $b=mysqli_fetch_row($tab);
                                                   if ($salariatp["nume_complet"]!==$a[2]){
                                                   $sql="UPDATE modificarisalariati SET NPren='".$a[2]."' WHERE Cheie='".$b[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);}
                                                   }
                                                   if ($salariatp["functie"]!==$a[6]){
                                                   $sql="UPDATE modificarisalariati SET Func='".$a[6]."' WHERE Cheie='".$b[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);}
                                                   }
                                                   if ($salariatp["contract_state"]!==$a[7]){
                                                   $sql="UPDATE modificarisalariati SET SitCIM='".$a[7]."' WHERE Cheie='".$b[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);}
                                                   }
                                                   
                                                   if (count($salariatp["department_path"])>0){
                                                       for ($i=0;$i<count($salariatp["department_path"]);$i++){
                                                           $i1=$i+1;
                                                           if ($salariatp["department_path"][$i]["name"]!==""){
                                                               if ($salariatp["department_path"][$i]["name"]!==$a[$i+11]){
                                                                   $sql="UPDATE modificarisalariati SET S".$i1."='".$a[$i+11]."' WHERE Cheie='".$b[0]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);}
                                                               }
                                                           }                                
                                                       }

                                                   }                                           
                                        }
                                     }
                               }
                       }
                         else {
                          
                               $sql="INSERT INTO salariati (Marca, NPren, Nume, Prenume) VALUES('".$salariatp["marca"]."', '".$salariatp["nume_complet"]."', '".$salariatp["nume"]."', '".$salariatp["prenume"]."')";
                               mysqli_query($con,$sql);
                               $sql="UPDATE salariati SET CNP='".$salariatp["cnp"]."', DNastere='".$salariatp["data_nastere"]."', Sex='".$salariatp["sex"]."', Func='".$salariatp["functie"]."', SitCIM='".$salariatp["contract_state"]."' WHERE Marca='".$salariatp["marca"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);}
                               $sql="UPDATE salariati SET FlotaLung='".$salariatp["mobil"]."', TelPersonal='".$salariatp["personal"]."' WHERE Marca='".$salariatp["marca"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);}
                               //inserez nou salariat si in baza de date cu modificari
                               $data=date('Y-m-d H:i:s');
                               $sql="INSERT INTO modificarisalariati (Marca, SalariatNou, DataSalvare) VALUES('".$salariatp["marca"]."', '1', '".$data."')";
                               mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);}
                               $sql="UPDATE modificarisalariati SET NPren='".$salariatp["nume_complet"]."', Func='".$salariatp["functie"]."', SitCIM='".$salariatp["contract_state"]."' WHERE Marca='".$salariatp["marca"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);}
                               
                               if (count($salariatp["department_path"])>0){
                                   for ($i=0;$i<count($salariatp["department_path"]);$i++){
                                       $i1=$i+1;
                                       if ($salariatp["department_path"][$i]["name"]!==""){
                                           $sql="UPDATE salariati SET S".$i1."='".$salariatp["department_path"][$i]["name"]."' WHERE Marca='".$salariatp["marca"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);}
                                           $sql="UPDATE modificarisalariati SET S".$i1."='".$salariatp["department_path"][$i]["name"]."' WHERE Marca='".$salariatp["marca"]."'"; mysqli_query($con,$sql); if (mysqli_error($con)){echo mysqli_error($con);}
                                       }                                
                                   }                                
                               }
                              }
           }
           mysqli_error($con);
}
echo ("S-a finalizat de actualizat baza de date!");
 $con->close();
 
?>
