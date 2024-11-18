

  //identific din cooki-uri marca persoanei care s-a logat
  ecm=document.cookie;
  ecm=ecm.substr(ecm.indexOf("Marc")+5,ecm.length);
  ecm=ecm.substr(0,ecm.indexOf(";"));
  

     //verific drepturile persoanei
     //mai intai verific ecm-ul - daca persoana s-a logat
    var xdrept=new XMLHttpRequest();
    xdrept.onreadystatechange=function(){
       if (xdrept.readyState==4 && xdrept.status==200){
             if(xdrept.responseText=="Exista dreptul."){
                //preia informatii privind salariatii si genereaza arborele
                var xstr=new XMLHttpRequest();
                xstr.onreadystatechange=function(){
                    if (xstr.readyState==4 && xstr.status==200) {
                       ts=[];
                       ts=JSON.parse(atob(decodeURIComponent(xstr.responseText)));
                       if (ts.length>1) {
                          
                          generez_arbore(ts);
                       }
                       //generez div-urile pt arbore 
                    }
                };                
                xstr.open("POST","desenarearbore.php",true);
                xstr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xstr.send("structuri=orice");

             }else{alert("La momentul actual nu aveti access pe pagina " + document.title + "!");}
       }
    };                                                             
    xdrept.open("POST","desenarearbore.php",true);
    xdrept.setRequestHeader("Content-type", "application/x-www-form-urlencoded");                                                                 
    xdrept.send("ecm="+ecm+"&pagina="+document.title);   //verific daca are drepturi pe pagina   



function generez_arbore(ts) {
    div=document.createElement("div");div.id="div_meniu_lateral";div.className = "div_in_linie";div.style.position = "absolute";div.style.left = "0px";div.style.top = "0px";div.style.zIndex = "999";div.style.width = "56px";div.style.height = "56px";
   
    div.onclick=function(){
          if (document.getElementById("div_arbore").style.display === "none" || document.getElementById("div_arbore").display === "") {
              document.getElementById("div_arbore").style.display = "block"; // Afisam div-ul
              document.getElementById("div_tabel").style.position = "relative";
              //in functie de pagina in care se afla va lua diferite dimensiuni
              document.getElementById("div_tabel").style.left = document.getElementById("div_arbore").offsetWidth+ "px";
              //if (document.title=="Concedii medicale") {document.getElementById("div_tabel").style.top = "-200px";}
              //if (document.title=="Boli cronice") {document.getElementById("div_tabel").style.top = "-200px";}
              //if (document.title=="Urgente") {document.getElementById("div_tabel").style.top = "-70px";}
          } else {
              document.getElementById("div_arbore").style.display = "none"; // Ascundem div-ul
              document.getElementById("div_tabel").style.position = "relative";
              document.getElementById("div_tabel").style.left = "0px";
          }
          if (document.getElementById("div_filtre")) {
              if (document.getElementById("div_filtre").style.display === "none" || document.getElementById("div_arbore").display === "") {
                  document.getElementById("div_filtre").style.display = "block"; // Afisam div-ul
              } else {
                  document.getElementById("div_filtre").style.display = "none"; // Ascundem div-ul
              }
          }
      };

      document.body.appendChild(div);
      
    //div=document.createElement("div");div.id="div_reactualizare_BD";div.className = "div_in_linie";div.style.position = "absolute";div.style.left = "56px";div.style.top = "0px";div.style.zIndex = "999";div.style.width = "56px";div.style.height = "56px";document.body.appendChild(div);
    //a=document.createElement("input");a.type="submit";a.id="Actualizeaza_BD";a.className="button0";a.value="Actualizeaza BD";
    //a.onclick=function(){
    //  
    //};
    //document.getElementById("div_reactualizare_BD").appendChild(a);
    
    div=document.createElement("div");div.id="div_arbore";div.className = "div_in_linie"; div.style.width = "500px";document.body.appendChild(div);
    div=document.createElement("div");div.id="div_tabel";div.style.position="relative";div.style.left = document.getElementById("div_arbore").offsetWidth+ "px";div.className = "div_in_linie"; document.body.appendChild(div);
    
    //la nivelul div-ului abore definesc si caut
    //introduc butonul de refres a bazei de date
    
    //introduc modul de cautare dupa nume
    a=document.createElement("label");a.id="label_nume";a.innerHTML="&nbsp&nbspCauta dupa nume:&nbsp&nbsp";a.style.fontWeight="bold";document.getElementById("div_arbore").appendChild(a);
    a=document.createElement("input");a.type="text";a.id="nume";a.style.width=document.getElementById("div_arbore").clientWidth-10+'px';a.onkeyup=function(){intoarce_salariat_nume_settime();};document.getElementById("div_arbore").appendChild(a);
    
    //definesc prima lista - cea generala care va contine toate directiile
    u=document.createElement("ul");u.id="structuri";document.getElementById("div_arbore").appendChild(u);
    
    //adaug primul li care ii va da comanda sa afiseze toti salariatii
      l=document.createElement("li");l.className="box";l.id="l_Salariatii ATB";l.style.boxShadow = "none";l.innerHTML="Afiseaza toti salariatii";
      l.onclick=function(ev){
        genereaza_tabel(event.target.id);
        ev.target.querySelector(".nested").classList.toggle("active");
        ev.target.classList.toggle("check-box"); //era:  this.classList.toggle("caret-down");
      };
      document.getElementById("structuri").appendChild(l);
          u=document.createElement("ul");u.id="u_tot";u.className="nested";document.getElementById("l_Salariatii ATB").appendChild(u);
    //adaug prima directie

    //adaug directiile ca elemente dar
    //si directiile ca liste
    
    for (i=0;i<ts.length;i++) {
      if (i>0) {
       if (ts[i][0]!==ts[i-1][0]) {
          l=document.createElement("li");l.className="box";l.id="l_"+ts[i][0];l.style.boxShadow = "none";l.innerHTML=ts[i][0];
          l.onclick=function(ev){
            genereaza_tabel(event.target.id);
            ev.target.querySelector(".nested").classList.toggle("active");
            ev.target.classList.toggle("check-box"); //era:  this.classList.toggle("caret-down");
            };
          document.getElementById("structuri").appendChild(l);
          u=document.createElement("ul");u.id="u_"+ts[i][0];u.className="nested";document.getElementById("l_"+ts[i][0]).appendChild(u);
       }        
      }else{
          l=document.createElement("li");l.className="box";l.id="l_"+ts[i][0];l.style.boxShadow = "none";l.innerHTML=ts[i][0];
          l.onclick=function(ev){
            genereaza_tabel(event.target.id);
            ev.target.querySelector(".nested").classList.toggle("active");
            ev.target.classList.toggle("check-box"); //era:  this.classList.toggle("caret-down");
            };
          
          document.getElementById("structuri").appendChild(l);
          u=document.createElement("ul");u.id="u_"+ts[i][0];u.className="nested";document.getElementById("l_"+ts[i][0]).appendChild(u);        
      }

        id_l0="l_"+ts[i][0];      
        id_u0="u_"+ts[i][0];
        for (j=1;j<ts[i].length;j++) {
                id_l=id_l0+"_"+ts[i][j];            
                id_u=id_u0+"_"+ts[i][j];               
            if (ts[i][j]!==null) { //filtrez astfel incat sa se intoarca strict campurile cu informatii   ts[i][j]!=="" && 
            //daca nu exista element cu id-ul respectiv, il generez si automat si lista atasata acestuia
               if (!document.getElementById(id_l)) {// 
                    l=document.createElement("li");l.id=id_l;l.className="box";l.style.boxShadow = "none";l.innerHTML=ts[i][j];
                    l.onclick=function(ev){
                                        ev.target.stopPropagation();
                                        genereaza_tabel(event.target.id); //aceasta functie se va regasi in fiecare pagina Salariati etc.
                                        ev.target.querySelector(".nested").classList.toggle("active");
                                        ev.target.classList.toggle("check-box"); //era:  this.classList.toggle("caret-down");
                                        genereaza_pt_CSV();
                                        

                    };document.getElementById(id_u0).appendChild(l); //generez elementul              
                    u=document.createElement("ul");u.id=id_u;u.className="nested";document.getElementById(id_l).appendChild(u); //generez o lista pe care o leg de li -ul anterior realizat                      
               }
                id_u0=id_u0+"_"+ts[i][j];
                id_l0=id_l0+"_"+ts[i][j]; 
            }else{break;} 
        }      
    }
}


function intoarce_salariat_nume_settime() {
                if(typeof exista_timp2=="undefined" || exista_timp2==false){exista_timp2 = true; setTimeout(function(){intoarce_salariat_nume();},600);}
}
       
function intoarce_salariat_nume(){
              exista_timp2 = false;
              bo=document.getElementById("nume").getBoundingClientRect();//bottom
              le=document.getElementById("nume").getBoundingClientRect().left;
              if (document.getElementById("tabel_intoarce_cautari")) {document.getElementById("tabel_intoarce_cautari").remove();}              
              if (document.getElementById("nume").value.length>2) {

                var xsal=new XMLHttpRequest();
                xsal.onreadystatechange=function(){
                    if (xsal.readyState==4 && xsal.status==200) {
                       tabela_salariati=[];
                       tabela_salariati=JSON.parse(atob(decodeURIComponent(xsal.responseText)));
                       a=document.createElement("TABLE");a.id="tabel_intoarce_cautari";a.style.position="absolute";a.style.left=le;document.body.appendChild(a);
                       var linie; var celula;
                       for (i=0;i<tabela_salariati.length;i++) {
                               linie=document.getElementById("tabel_intoarce_cautari").insertRow(-1);
                               celula=linie.insertCell(0);celula.innerHTML=tabela_salariati[i][2];celula.style.background="white";
                               celula.onmouseover=function(){
                                  //decolorez toate celulele
                                  for (i=0;i<document.getElementById("tabel_intoarce_cautari").rows.length;i++) {
                                    document.getElementById("tabel_intoarce_cautari").rows[i].cells[0].style.background="white";
                                  }
                                  nrlinie=event.target.parentElement.rowIndex;
                                  //identific celula si o colorez
                                  document.getElementById("tabel_intoarce_cautari").rows[nrlinie].cells[0].style.background="#cccccc";
                                };
                                celula.onmouseout=function(){
                                  //decolorez toate celulele
                                  for (i=0;i<document.getElementById("tabel_intoarce_cautari").rows.length;i++) {
                                    document.getElementById("tabel_intoarce_cautari").rows[i].cells[0].style.background="white";
                                  }
                                };
                                celula.onclick=function(){
                                   //identific celula in care se afla numele salariatului si il adaug in zona de se aproba
                                   
                                   //genereaza_campuri();
                                   
                                   nrlinie=event.target.parentElement.rowIndex;
                                   cheie_salariat=tabela_salariati[nrlinie][0];
                                   nume_salariat=tabela_salariati[nrlinie][2];
                                   //in functie de tipul paginii se vor intoarce infromatii diferite asadar se va apela o functie cu aceeasi denumire care se va regasi in fiecare pagina modificata si va intoarce informatii diferite                                   
                                   informatii_de_intors(nrlinie,cheie_salariat,nume_salariat);
                                   

                                   lista_salariati(ls,pttitlu);                                   
                                   document.getElementById("nume").value=tabela_salariati[nrlinie][2];
                                   
                                   //sterg tabelul
                                   document.getElementById("tabel_intoarce_cautari").remove();
                                   //golesc pt_cautare_SelectSalariati
                                   //document.getElementById("pt_cautare_SelectPensionari").value="";

                                    
                                 };
                                
                       }
                       document.getElementById("tabel_intoarce_cautari").style.top=(document.getElementById("nume").getBoundingClientRect().bottom + window.scrollY) + "px";  //bo-document.getElementById("tabel_intoarce_cautari").getBoundingClientRect().top-document.getElementById("tabel_intoarce_cautari").offsetHeight+550; 
                    }
                };                
                xsal.open("POST","desenarearbore.php",true);
                xsal.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xsal.send("cauta_salariat_nume=" + document.getElementById("nume").value);
              }   

 }
 
   
  

