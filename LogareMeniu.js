
var coo=document.cookie;
if (coo.indexOf("parolelesuntok")>-1){
	// Crearea navbar-ului  - ok conform Bulma
	const nav = document.createElement("nav");nav.className = "navbar navbar-custom";nav.setAttribute("role", "navigation");nav.setAttribute("aria-label", "main navigation");document.body.appendChild(nav);

	// Crearea div-ului pentru brand - ok conform bulma
	const navbarBrand = document.createElement("div");navbarBrand.className = "navbar-brand";navbarBrand.id="div_in_navigare";
	div=document.createElement("div");div.id="div_spatiu";div.style.width = "100px";div.style.height = "50px";navbarBrand.appendChild(div);

	
	// Crearea div-ului pentru imagine
	const ptimagine = document.createElement("div");ptimagine.id = "ptimagine";navbarBrand.appendChild(ptimagine);
	//Adaugarea imaginii
	imagine=document.createElement("img");imagine.id="logocuimagine";imagine.src="logo/logo_a+.png";imagine.style.width="160px";imagine.style.length="50px";imagine.setAttribute('href',"index.html");
	navbarBrand.appendChild(imagine);
   
	// Crearea link-ului navbar
	const navbarItem = document.createElement("a");navbarItem.className = "navbar-item";
	navbarBrand.appendChild(navbarItem);

	// Crearea butonului burger
	const navbarBurger = document.createElement("a");navbarBurger.setAttribute("role", "button");navbarBurger.className = "navbar-burger";navbarBurger.setAttribute("aria-label", "menu");
	navbarBurger.setAttribute("aria-expanded", "false");navbarBurger.setAttribute("data-target", "navbarMedicinaMuncii");

	// Crearea span-urilor pentru butonul burger
	for (let i = 0; i < 6; i++) {
		const span = document.createElement("span");
		span.setAttribute("aria-hidden", "true");
		navbarBurger.appendChild(span);
	}

	
	// Adăugarea elementelor în structura nav
	nav.appendChild(navbarBrand);	
	
	// Adăugarea navbar-ului 

    div=document.createElement("div");div.id="navbarMedicinaMuncii";div.classList.add("navbar-menu");nav.appendChild(div);
				
    div=document.createElement("div");div.id="div_meniu_0.1";div.classList.add("navbar-start");document.getElementById("navbarMedicinaMuncii").appendChild(div); //navbar-start
    a=document.createElement("a");a.innerHTML="Salariati";a.id="salariati";a.onclick=function(){Click('salariati');};a.onmouseenter=function(){Intra('salariati',10,8);};a.onmouseout=function(){Out('salariati');}; //a.onclick=function(){Click('salariati');};
    a.classList.add("navbar-item");a.setAttribute('href',"salariati.html");document.getElementById("div_meniu_0.1").appendChild(a);
				
    a=document.createElement("a");a.innerHTML="Alerte";a.id="alerte";a.onclick=function(){Click('alerte');};a.onmouseenter=function(){Intra('alerte',10,7);};a.onmouseout=function(){Out('alerte');};
    a.classList.add("navbar-item");a.setAttribute('href',"alerte.html");document.getElementById("div_meniu_0.1").appendChild(a);
				
    a=document.createElement("a");a.innerHTML="Boli Cronice";a.id="boli";a.onclick=function(){Click('boli');};a.onmouseenter=function(){Intra('boli',10,11);};a.onmouseout=function(){Out('boli');};
    a.classList.add("navbar-item");a.setAttribute('href',"bolicronice.html");document.getElementById("div_meniu_0.1").appendChild(a);
				
    a=document.createElement("a");a.innerHTML="Certificate Medicale";a.id="certificatemedicale";a.onclick=function(){Click('certificatemedicale');};a.onmouseenter=function(){Intra('certificatemedicale',10,16);};a.onmouseout=function(){Out('certificatemedicale');};
    a.classList.add("navbar-item");a.setAttribute('href',"certificatemedicale.html");document.getElementById("div_meniu_0.1").appendChild(a);
				
    a=document.createElement("a");a.innerHTML="Urgente";a.id="urgente";a.onclick=function(){Click('salariati');};a.onmouseenter=function(){Intra('urgente',10,8);};a.onmouseout=function(){Out('urgente');};
    a.classList.add("navbar-item");a.setAttribute('href',"urgente.html");document.getElementById("div_meniu_0.1").appendChild(a);
		
    a=document.createElement("a");a.innerHTML="Update-uri";a.id="update-uri";a.onclick=function(){Click('update-uri');};a.onmouseenter=function(){Intra('update-uri',10,10);};a.onmouseout=function(){Out('update-uri');};
    a.classList.add("navbar-item");a.setAttribute('href',"update.html");document.getElementById("div_meniu_0.1").appendChild(a);
	
    a=document.createElement("a");a.innerHTML="Checklist Audit";a.id="checklistaudit";a.onclick=function(){Click('checklistaudit');};a.onmouseenter=function(){Intra('checklistaudit',10,13);};a.onmouseout=function(){Out('checklistaudit');};
    a.classList.add("navbar-item");a.setAttribute('href',"checklistaudit.html");document.getElementById("div_meniu_0.1").appendChild(a);
				
    div=document.createElement("div");div.id="navbarsfarsit";div.classList.add("navbar-end");document.getElementById("navbarMedicinaMuncii").appendChild(div);

    div=document.createElement("div");div.id="diviesire";div.classList.add("navbar-item");document.getElementById("navbarsfarsit").appendChild(div);

	navbarBrand.appendChild(navbarBurger);



	document.addEventListener('DOMContentLoaded', () => {
		// Get all "navbar-burger" elements
		const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
	
		// Check if there are any navbar burgers
		if ($navbarBurgers.length > 0) {
	
			// Add a click event on each of them
			$navbarBurgers.forEach(el => {
				el.addEventListener('click', () => {
	
					// Get the target from the "data-target" attribute
					const target = el.dataset.target;
					const $target = document.getElementById(target);
	
					// Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
					el.classList.toggle('is-active');
					$target.classList.toggle('is-active');
					
				});
			});
		}
	}); // Added JavaScript for Bulma's burger menu functionality
         
    
	a=document.createElement("input");
	a.type="submit";
	a.id="dec";
	a.value="Sign out";
	a.className="button is-rounded is-normal has-text-black has-text-weight-bold";
	a.onmouseenter=function(){
		document.getElementById("dec").className="button is-focused is-rounded is-normal has-text-link has-text-weight-bold";
	};
	a.onmouseleave=function(){
		document.getElementById("dec").className="button is-rounded is-normal has-text-black has-text-weight-bold";
	};
	//a.setAttribute('href',"localhost/MedicinaMuncii");
	a.onclick=function(){
		//se sterg cooki-urile prima este pentru iva.antibiotice.ro pentru care cookiurile sunt localizate in partitia de baza /
		document.cookie = "Marc=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/;";
		document.cookie = "Nume=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/;";
		document.cookie = "Functia=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/;";
		document.cookie = "parolelesuntok=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/;";
		document.cookie = "Directia=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/;";
		//document.cookie = "Structura=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/;";
		//document.cookie = "Substructura=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/;";
		//document.cookie = "Alias=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/;";
		location.href="";window.location.origin;
			
		//a doua este localizata in partitia /pensii deoaree pe localhost acolo sunt memorate cookiurile
		document.cookie = "Marc=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/medicinamuncii;";
		document.cookie = "Nume=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/medicinamuncii;";
		document.cookie = "Functia=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/medicinamuncii;";
		document.cookie = "parolelesuntok=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/medicinamuncii;";
		document.cookie = "Directia=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/medicinamuncii;";
		//document.cookie = "Structura=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/medicinamuncii;";
		//document.cookie = "Substructura=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/medicinamuncii;";
		//document.cookie = "Alias=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/medicinamuncii;";
		location.href="";//window.location.origin;
		
	};
	document.getElementById("diviesire").appendChild(a);

}
	function Click(inf) {
//       //toate elementele din meniu capata culoarea veche iar elementul actual capata alta culoare
document.getElementById('salariati').className="navbar-item has-text-weight-bold";
document.getElementById('alerte').className="navbar-item has-text-weight-bold";
document.getElementById('boli').className="navbar-item has-text-weight-bold";
document.getElementById('certificatemedicale').className="navbar-item has-text-weight-bold";
document.getElementById('urgente').className="navbar-item has-text-weight-bold";
document.getElementById('update-uri').className="navbar-item has-text-weight-bold";
document.getElementById('checklistaudit').className="navbar-item has-text-weight-bold";

document.getElementById(inf).className="navbar-item is-large has-text-danger-25 has-text-weight-bold";//


    }
	function Intra(inf,decateori,lungimea){
            document.getElementById(inf).className="navbar-item is-large has-text-danger-40 has-text-weight-bold";//has-text-primary-25
            ok=0;
            centru=(document.getElementById(inf).getBoundingClientRect().left+document.getElementById(inf).getBoundingClientRect().right)/2;
            sus=document.getElementById(inf).getBoundingClientRect().top;
            if (sus==0) {
                realizeaza_linia(ok,centru,decateori,lungimea);                
            }
    }
	
	function realizeaza_linia(ok,centru,decateori,lungimea) {
                    if (document.getElementById("divcolor")) {document.getElementById("divcolor").remove();}
                    ok=ok+1;
					div=document.createElement("div");
					div.id="divcolor";
					div.style.position="fixed";
					div.style.width=ok*lungimea+"px";
					div.style.height="5px";
					div.style.backgroundColor="red";
					div.style.top=sus+58+"px";
					div.style.left=centru-ok*lungimea/2+"px";
                    div.style.zIndex="999";
					document.body.appendChild(div);
                                if (ok<decateori) {
                                         setTimeout(function(){realizeaza_linia(ok,centru,decateori,lungimea)},10);
                                }
    }

        
    function Out(inf){
		//alert(document.title);
		//alert(inf);
		if (inf!=document.title) {
           document.getElementById(inf).className="navbar-item has-text-weight-bold";
        }

                if (document.getElementById("divcolor")) {document.getElementById("divcolor").remove();}
    }



 
 