<?php
require('config.php');
   if(isset($_GET['code'])){
	       $ras=[];
	       //daca am primit codul atunci fac un post catre ... pt a obtine token-ul
		        //$cod=base64_encode("a188a3b6-b7bd-11eb-8529-0242ac130003").":".base64_encode("DIASfKsnmtYCpWyv");
		    $cod=base64_encode("5a4b7836-216d-11ee-be56-0242ac120002:DIASfKsnmtYCpWyv");  //   354a5a94-d2ca-11ed-afa1-0242ac120002
				$curl = curl_init();
				curl_setopt_array($curl, array(
				CURLOPT_URL => 'https://login.antibiotice.ro/token',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS=>'code='.$_GET['code'].'&grant_type=authorization_code&client_id=5a4b7836-216d-11ee-be56-0242ac120002ac120002&redirect_uri=http://localhost/medicinamuncii/indexlog.php',   //achizitii.antibiotice.ro //localhost/achizitii/
				CURLOPT_HTTPHEADER => array(
						   'Authorization: Basic '.$cod,
						   'Content-Type: application/x-www-form-urlencoded'
					 ),
				));
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
				$response = curl_exec($curl);
				curl_close($curl);

				//preiau tokenul
				$tokenul=substr($response,strpos($response,'":"')+3,strlen($response));
				$tokenul=substr($tokenul,0,strpos($tokenul,'","'));
				//preiau timpul de expirare
				$expira=substr($response,strpos($response,'"expires_in":')+13,strlen($response));
				$expira=substr($expira,0,strpos($expira,',"'));
				//diminuez timpul de expirare cu 16 ore
				$expira=$expira-3600*16;
				$tokenuldecodat=base64_decode($tokenul);
				$marca=substr($tokenuldecodat,strpos($tokenuldecodat,'"marca":')+8,strlen($tokenuldecodat));
				$marca=substr($marca,0,strpos($marca,',"'));
				                       $a=[];
															 
														    $con=new mysqli($host,$utilizator,$parola,$BDInformatiiConfidentiale);//$BDCabinet
																$con->query('SET character_set_client="utf8",character_set_connection="utf8",character_set_results="utf8";');
																$sql="SELECT Marca, NPren, Func FROM salariati WHERE Marca='".$marca."'";    //, Dir, Str, Substr
															 if ($tab=mysqli_query($con,$sql)){
																					 for($i=0;$i<mysqli_num_rows($tab);$i++){
																												$a=mysqli_fetch_row($tab);
																												if(isset($_COOKIE["Marc"])){setcookie("Marc","",time()-time());}
																												if(isset($_COOKIE["Nume"])){setcookie("Nume","",time()-time());}
																												if(isset($_COOKIE["Functia"])){setcookie("Functia","",time()-time());}
																												if(isset($_COOKIE["parolelesuntok"])){setcookie("parolelesuntok","",time()-time());}
																												//if(isset($_COOKIE["Directia"])){setcookie("Directia","",time()-time());}
																												//if(isset($_COOKIE["Structura"])){setcookie("Structura","",time()-time());}
																												//if(isset($_COOKIE["Substructura"])){setcookie("Substructura","",time()-time());}
																												
																												setcookie("Marc",$a[0],time()+$expira);
																												setcookie("Nume",$a[1],time()+$expira);
																												setcookie("Functia",$a[2],time()+$expira);
																												setcookie("parolelesuntok","da",time()+$expira);
																												//setcookie("Directia",$a[3],time()+$expira);
																												//$aaa=base64_encode($a[4]);
																												//setcookie("Structura",$a[4],time()+$expira);
																												//setcookie("Substructura",$a[5],time()+$expira);
																												
																						}
																				
															 }
					                    $con->close();
      header('Location: index.html');
			}
    else{}			

		
if(isset($_REQUEST['stergecookies'])){

                              if(isset($_COOKIE["Marc"])){setcookie("Marc","",time()-time());}
	   						    	if(isset($_COOKIE["Nume"])){setcookie("Nume","",time()-time());}
                              if(isset($_COOKIE["Functia"])){setcookie("Functia","",time()-time());}
                              if(isset($_COOKIE["parolelesuntok"])){setcookie("parolelesuntok","",time()-time());}
                              //if(isset($_COOKIE["Directia"])){setcookie("Directia","",time()-time());}
                              //if(isset($_COOKIE["Structura"])){setcookie("Structura","",time()-time());}
                              //if(isset($_COOKIE["Substructura"])){setcookie("Substructura","",time()-time());}
                        
								 
}

?>
