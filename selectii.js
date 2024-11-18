    
    if (document.getElementById("navbarMedicinaMuncii")) {
       codb=[];
       ap=[];
       
       div=document.createElement("div");div.id="div_filtre";div.style.position="relative"; div.className = "div_in_linie";div.style.width = "500px";document.body.appendChild(div); // div.style.left = document.getElementById("div_arbore").offsetWidth+ "px";
       
       tabel=document.createElement('TABLE');tabel.id="optiuni_filtre";tabel.name="optiuni_filtre";tabel.style.textAlign="center";document.getElementById("div_filtre").appendChild(tabel);
       tr=document.createElement("TR");tr.id="tr_filtre_[0]";tr.name="tr_filtre_[0]";tr.className = "tabel_header_f";document.getElementById("optiuni_filtre").appendChild(tr);
       td=document.createElement("TD");td.id="[0]_[0]_fil";td.innerHTML="Sex";document.getElementById("tr_filtre_[0]").appendChild(td);
       td=document.createElement("TD");td.id="[0]_[1]_fil";td.innerHTML="Varsta (ani)";document.getElementById("tr_filtre_[0]").appendChild(td);
       td=document.createElement("TD");td.id="[0]_[2]_fil";td.innerHTML="Sit. CIM";document.getElementById("tr_filtre_[0]").appendChild(td);
       td=document.createElement("TD");td.id="[0]_[3]_fil";td.innerHTML="Perioada";document.getElementById("tr_filtre_[0]").appendChild(td);
       td=document.createElement("TD");td.id="[0]_[4]_fil";td.innerHTML="Cod diag.";document.getElementById("tr_filtre_[0]").appendChild(td);
       
       
   
       tr=document.createElement("TR");tr.id="tr_filtre_[1]";tr.name="tr_filtre_[1]";tr.className = "tabel_header_f";document.getElementById("optiuni_filtre").appendChild(tr);
       td=document.createElement("TD");td.id="[1]_[0]_fil";document.getElementById("tr_filtre_[1]").appendChild(td);
           a=document.createElement("select");a.id="sex";document.getElementById("[1]_[0]_fil").appendChild(a);
           a=document.createElement("option");a.value="";a.innerHTML="";document.getElementById("sex").appendChild(a);
           a=document.createElement("option");a.value="M";a.innerHTML="M";document.getElementById("sex").appendChild(a);
           a=document.createElement("option");a.value="F";a.innerHTML="F";document.getElementById("sex").appendChild(a);
           
       td=document.createElement("TD");td.id="[1]_[1]_fil";document.getElementById("tr_filtre_[1]").appendChild(td);
           a=document.createElement("input");a.type="text";a.id="Varsta_incepand_cu";a.style.width="30px"; document.getElementById("[1]_[1]_fil").appendChild(a);
           document.getElementById("[1]_[1]_fil").innerHTML=document.getElementById("[1]_[1]_fil").innerHTML+" - ";
           a=document.createElement("input");a.type="text";a.id="Varsta_pana_la";a.style.width="30px"; document.getElementById("[1]_[1]_fil").appendChild(a);
       td=document.createElement("TD");td.id="[1]_[2]_fil";document.getElementById("tr_filtre_[1]").appendChild(td);
           a=document.createElement("select");a.id="CIM";document.getElementById("[1]_[2]_fil").appendChild(a);
           a=document.createElement("option");a.value="";a.innerHTML="";document.getElementById("CIM").appendChild(a);
           a=document.createElement("option");a.value="Activ";a.innerHTML="Activ";document.getElementById("CIM").appendChild(a);  
       td=document.createElement("TD");td.id="[1]_[3]_fil";document.getElementById("tr_filtre_[1]").appendChild(td);
           a=document.createElement("input");a.type="date";a.id="Perioada_incepand_cu"; document.getElementById("[1]_[3]_fil").appendChild(a);
           document.getElementById("[1]_[3]_fil").innerHTML=document.getElementById("[1]_[3]_fil").innerHTML+" - ";
           a=document.createElement("input");a.type="date";a.id="Perioada_pana_la"; document.getElementById("[1]_[3]_fil").appendChild(a);       
   
       td=document.createElement("TD");td.id="[1]_[4]_fil";document.getElementById("tr_filtre_[1]").appendChild(td);
           a=document.createElement("select");a.id="coduriboli";
           a.onchange=function(){
                                   document.getElementById("DenumireCodDiagnostic").options[0].selected=true;
                                   document.getElementById("aparate").options[0].selected=true;
                                };
           document.getElementById("[1]_[4]_fil").appendChild(a);
           
       tabel=document.createElement('TABLE');tabel.id="optiuni_filtre_2";tabel.name="optiuni_filtre_2";document.getElementById("div_filtre").appendChild(tabel);
       tr=document.createElement("TR");tr.id="tr_filtre_[2]";tr.name="tr_filtre_[2]";tr.className = "tabel_header_f";document.getElementById("optiuni_filtre_2").appendChild(tr);
       td=document.createElement("TD");td.id="[2]_[0]_fil";td.innerHTML="Denumire Cod Diagnostic";document.getElementById("tr_filtre_[2]").appendChild(td);
   
       tr=document.createElement("TR");tr.id="tr_filtre_[3]";tr.name="tr_filtre_[3]";tr.className = "tabel_header_f";document.getElementById("optiuni_filtre_2").appendChild(tr);
       td=document.createElement("TD");td.id="[3]_[0]_fil";document.getElementById("tr_filtre_[3]").appendChild(td);
           a=document.createElement("select");a.id="DenumireCodDiagnostic";a.style.width="490px";
           a.onchange=function(){
                                   document.getElementById("coduriboli").options[0].selected=true;
                                   document.getElementById("aparate").options[0].selected=true;
                                };
           document.getElementById("[3]_[0]_fil").appendChild(a);
           
       tabel=document.createElement('TABLE');tabel.id="optiuni_filtre_3";tabel.name="optiuni_filtre_3";document.getElementById("div_filtre").appendChild(tabel);
       tr=document.createElement("TR");tr.id="tr_filtre_[4]";tr.name="tr_filtre_[4]";tr.className = "tabel_header_f";document.getElementById("optiuni_filtre_3").appendChild(tr);
       td=document.createElement("TD");td.id="[4]_[1]_fil";td.innerHTML="Aparatul";document.getElementById("tr_filtre_[4]").appendChild(td);
   
       tr=document.createElement("TR");tr.id="tr_filtre_[5]";tr.name="tr_filtre_[5]";tr.className = "tabel_header_f";document.getElementById("optiuni_filtre_3").appendChild(tr);
       td=document.createElement("TD");td.id="[5]_[2]_fil";document.getElementById("tr_filtre_[5]").appendChild(td);
           a=document.createElement("select");a.id="aparate";
           a.onchange=function(){
                                   document.getElementById("coduriboli").options[0].selected=true;
                                   document.getElementById("DenumireCodDiagnostic").options[0].selected=true;
                                };
           document.getElementById("[5]_[2]_fil").appendChild(a);
           
       td=document.createElement("TD");td.id="[5]_[3]_fil";document.getElementById("tr_filtre_[5]").appendChild(td);
    
       
       
       
           var x0=new XMLHttpRequest();
           x0.onreadystatechange=function(){
              if (x0.readyState==4 && x0.status==200){
                    codb=JSON.parse(atob(decodeURIComponent(x0.responseText)));
                    a=document.createElement("option");a.value="";a.innerHTML="";document.getElementById("coduriboli").appendChild(a);                 
                    for (i=0;i<codb.length;i++){
                                 a=document.createElement("option");a.value=codb[i][1];a.innerHTML=codb[i][1];document.getElementById("coduriboli").appendChild(a);  
                           }
              }
           };                                                             
           x0.open("POST","Selectii.php",true);
           x0.setRequestHeader("Content-type", "application/x-www-form-urlencoded");                                                                 
           x0.send("dencod=orice");
           
           var x=new XMLHttpRequest();
           x.onreadystatechange=function(){
              if (x.readyState==4 && x.status==200){
                    denb=JSON.parse(atob(decodeURIComponent(x.responseText)));
                    a=document.createElement("option");a.value="";a.innerHTML="";document.getElementById("DenumireCodDiagnostic").appendChild(a);                 
                    for (i=0;i<denb.length;i++){
                                 a=document.createElement("option");a.value=denb[i][2];a.innerHTML=denb[i][2];document.getElementById("DenumireCodDiagnostic").appendChild(a);  
                           }
              }
           };                                                             
           x.open("POST","Selectii.php",true);
           x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");                                                                 
           x.send("selectii=orice");
           
           var x1=new XMLHttpRequest();
           x1.onreadystatechange=function(){
              if (x1.readyState==4 && x1.status==200){
                    ap=JSON.parse(atob(decodeURIComponent(x1.responseText)));
                    a=document.createElement("option");a.value="";a.innerHTML="";document.getElementById("aparate").appendChild(a);                 
                    for (i=0;i<ap.length;i++){
                                 a=document.createElement("option");a.value=ap[i][0];a.innerHTML=ap[i][0];document.getElementById("aparate").appendChild(a);  
                           }
              }
           };                                                             
           x1.open("POST","Selectii.php",true);
           x1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");                                                                 
           x1.send("aparatul=orice");       
    }


                                                          
 

