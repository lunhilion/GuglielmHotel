
function pv(){
   p_pulisci();		//pulisco i p ogni volta che l'utente cerca di inserire i dati
   if(p_emptyForm()){		//verifico se tutti i campi sono diversi da null
	   if(p_valida()){
			return true;		//funzione per validare i campi dati
	   }
	   else{
		   return false;
	   }
   }
}

function p_emptyForm(){
	var checkIn = document.getElementById("check-in");
	var checkOut = document.getElementById("check-out");
	var nome = document.getElementById("guest-name");
	var cognome = document.getElementById("guest-cognome");
	var email = document.getElementById("guest-email");
	var con=true;
	if(checkIn.value===""){
		document.getElementById("checkIn_error").innerHTML = "Data di arrivo è richiesta!";
		con=false;
	}
	if(checkOut.value===""){
		document.getElementById("checkOut_error").innerHTML = "Data di partenza è richiesta!";
		con=false;
	}
	if(nome.value===""){
		document.getElementById("nome_error").innerHTML = "Nome è richiesto!";
		con=false;
	}
	if(cognome.value===""){
		document.getElementById("cognome_error").innerHTML = "Cognome è richiesto!";
		con=false;
	}
	if(email.value===""){
		document.getElementById("email_error").innerHTML = "L'email è richiesta!";
		con=false;
	}
    return con;
}

function p_pulisci(){
	document.getElementById("checkIn_error").innerHTML = "";
	document.getElementById("checkOut_error").innerHTML = "";
	document.getElementById("nome_error").innerHTML = "";
	document.getElementById("cognome_error").innerHTML = "";
	document.getElementById("email_error").innerHTML = "";
}

function p_valida{
	var con=true;
	var checkIn = document.getElementById("check-in");
	var checkOut = document.getElementById("check-out");
	var nome=document.getElementById("guest-nome");
	var cognome=document.getElementById("guest-cognome");
	var email=document.getElementById("guest-email");
	var patternCheck=/^[0-9]{2}\-[0-9]{2}\-[0-9]{4}$/;
	var patternNC=/^[a-zA-Z\s]*$/;
	var patternEmail=/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	if(!patternCheck.test(checkIn.value)){
		document.getElementById("checkIn_error").innerHTML= "Data di arrivo "+ checkIn.value+" non valida! ";
		con=false;
	}
	if(!patternCheck.test(checkOut.value)){
		document.getElementById("checkIn_error").innerHTML= "Data di partenza "+ checkOut.value+" non valida! ";
		con=false;
	}
	if(!patternEmail.test(email.value)){
		document.getElementById("email_error").innerHTML= "Email "+ email.value+" non valida! ";
		con=false;
	}
	if(!patternNC.test(nome.value)){
		document.getElementById("nome_error").innerHTML= "In quale universo uno si chiama "+nome.value+" non valido! ";
		con=false;
	}
	if(!patternNC.test(cognome.value)){
		document.getElementById("cognome_error").innerHTML= "Cognome "+ cognome.value+" non valido! ";
		con=false;
	}
	return con;
}