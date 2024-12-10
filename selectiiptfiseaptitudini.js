
if (document.getElementById("navbarMedicinaMuncii")) {
    codb=[];
    ap=[];

    div=document.createElement("div");div.id="div_filtre";div.style.position="relative"; div.className = "div_in_linie";div.style.width = "500px";document.body.appendChild(div); // div.style.left = document.getElementById("div_arbore").offsetWidth+ "px";

    tabel=document.createElement('TABLE');tabel.id="optiuni_filtre";tabel.name="optiuni_filtre";tabel.style.textAlign="center";document.getElementById("div_filtre").appendChild(tabel);
    tr=document.createElement("TR");tr.id="tr_filtre_[0]";tr.name="tr_filtre_[0]";tr.className = "tabel_header_f";document.getElementById("optiuni_filtre").appendChild(tr);
    td=document.createElement("TD");td.id="[0]_[0]_fil";td.innerHTML="Sex";document.getElementById("tr_filtre_[0]").appendChild(td);
    //td=document.createElement("TD");td.id="[0]_[1]_fil";td.innerHTML="Varsta (ani)";document.getElementById("tr_filtre_[0]").appendChild(td);
    td=document.createElement("TD");td.id="[0]_[2]_fil";td.innerHTML="Sit. CIM";document.getElementById("tr_filtre_[0]").appendChild(td);
    td=document.createElement("TD");td.id="[0]_[3]_fil";td.innerHTML="Perioada";document.getElementById("tr_filtre_[0]").appendChild(td);
    //td=document.createElement("TD");td.id="[0]_[4]_fil";td.innerHTML="Cod diag.";document.getElementById("tr_filtre_[0]").appendChild(td);
    td=document.createElement("TD");td.id="[0]_[4]_fil";td.innerHTML="Aviz medical";document.getElementById("tr_filtre_[0]").appendChild(td);


    tr=document.createElement("TR");tr.id="tr_filtre_[1]";tr.name="tr_filtre_[1]";tr.className = "tabel_header_f";document.getElementById("optiuni_filtre").appendChild(tr);
    td=document.createElement("TD");td.id="[1]_[0]_fil";document.getElementById("tr_filtre_[1]").appendChild(td);
    a=document.createElement("select");a.id="sex";document.getElementById("[1]_[0]_fil").appendChild(a);
    a=document.createElement("option");a.value="";a.innerHTML="";document.getElementById("sex").appendChild(a);
    a=document.createElement("option");a.value="M";a.innerHTML="M";document.getElementById("sex").appendChild(a);
    a=document.createElement("option");a.value="F";a.innerHTML="F";document.getElementById("sex").appendChild(a);


    td=document.createElement("TD");td.id="[1]_[2]_fil";document.getElementById("tr_filtre_[1]").appendChild(td);
    a=document.createElement("select");a.id="CIM";document.getElementById("[1]_[2]_fil").appendChild(a);
    a=document.createElement("option");a.value="";a.innerHTML="";document.getElementById("CIM").appendChild(a);
    a=document.createElement("option");a.value="Activ";a.innerHTML="Activ";document.getElementById("CIM").appendChild(a);
    td=document.createElement("TD");td.id="[1]_[3]_fil";document.getElementById("tr_filtre_[1]").appendChild(td);
    a=document.createElement("input");a.type="date";a.id="Perioada_incepand_cu"; document.getElementById("[1]_[3]_fil").appendChild(a);
    document.getElementById("[1]_[3]_fil").innerHTML=document.getElementById("[1]_[3]_fil").innerHTML+" - ";
    a=document.createElement("input");a.type="date";a.id="Perioada_pana_la"; document.getElementById("[1]_[3]_fil").appendChild(a);


    td=document.createElement("TD");td.id="[1]_[4]_fil";document.getElementById("tr_filtre_[1]").appendChild(td);
    a=document.createElement("select");a.id="AvizMedical";document.getElementById("[1]_[4]_fil").appendChild(a);
    a=document.createElement("option");a.value="";a.innerHTML="";document.getElementById("AvizMedical").appendChild(a);
    a=document.createElement("option");a.value=1;a.innerHTML="APT";document.getElementById("AvizMedical").appendChild(a);
    a=document.createElement("option");a.value=2;a.innerHTML="APT CONDITIONAT";document.getElementById("AvizMedical").appendChild(a);
    a=document.createElement("option");a.value=3;a.innerHTML="INAPT TEMPORAR";document.getElementById("AvizMedical").appendChild(a);
    a=document.createElement("option");a.value=4;a.innerHTML="INAPT";document.getElementById("AvizMedical").appendChild(a);



    tabel=document.createElement('TABLE');tabel.id="optiuni_filtre_2";tabel.name="optiuni_filtre_2";document.getElementById("div_filtre").appendChild(tabel);
    tr=document.createElement("TR");tr.id="tr_filtre_[2]";tr.name="tr_filtre_[2]";tr.className = "tabel_header_f";document.getElementById("optiuni_filtre_2").appendChild(tr);
    td=document.createElement("TD");td.id="[2]_[0]_fil";td.innerHTML="R_inaltime";document.getElementById("tr_filtre_[2]").appendChild(td);
    td=document.createElement("TD");td.id="[2]_[1]_fil";td.innerHTML="R_noapte";document.getElementById("tr_filtre_[2]").appendChild(td);
    td=document.createElement("TD");td.id="[2]_[2]_fil";td.innerHTML="R_auto";document.getElementById("tr_filtre_[2]").appendChild(td);

    tr=document.createElement("TR");tr.id="tr_filtre_[3]";tr.name="tr_filtre_[3]";tr.className = "tabel_header_f";document.getElementById("optiuni_filtre_2").appendChild(tr);
    td=document.createElement("TD");td.id="[3]_[0]_fil";document.getElementById("tr_filtre_[3]").appendChild(td);
    a=document.createElement("select");a.id="LucruLaInaltime";a.style.width="75px";document.getElementById("[3]_[0]_fil").appendChild(a);
    a=document.createElement("option");a.value="";a.innerHTML="";document.getElementById("LucruLaInaltime").appendChild(a);
    a=document.createElement("option");a.value="Da";a.innerHTML="Da";document.getElementById("LucruLaInaltime").appendChild(a);
    a=document.createElement("option");a.value="Nu";a.innerHTML="Nu";document.getElementById("LucruLaInaltime").appendChild(a);

    td=document.createElement("TD");td.id="[3]_[1]_fil";document.getElementById("tr_filtre_[3]").appendChild(td);
    a=document.createElement("select");a.id="TuraDeNoapte";a.style.width="75px";document.getElementById("[3]_[1]_fil").appendChild(a);
    a=document.createElement("option");a.value="";a.innerHTML="";document.getElementById("TuraDeNoapte").appendChild(a);
    a=document.createElement("option");a.value="Da";a.innerHTML="Da";document.getElementById("TuraDeNoapte").appendChild(a);
    a=document.createElement("option");a.value="Nu";a.innerHTML="Nu";document.getElementById("TuraDeNoapte").appendChild(a);

    td=document.createElement("TD");td.id="[3]_[2]_fil";document.getElementById("tr_filtre_[3]").appendChild(td);
    a=document.createElement("select");a.id="Auto";a.style.width="75px";document.getElementById("[3]_[2]_fil").appendChild(a);
    a=document.createElement("option");a.value="";a.innerHTML="";document.getElementById("Auto").appendChild(a);
    a=document.createElement("option");a.value="Da";a.innerHTML="Da";document.getElementById("Auto").appendChild(a);
    a=document.createElement("option");a.value="Nu";a.innerHTML="Nu";document.getElementById("Auto").appendChild(a);


    td=document.createElement("TD");td.id="[5]_[3]_fil";document.getElementById("tr_filtre_[3]").appendChild(td);

}
