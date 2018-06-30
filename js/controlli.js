
function login(){
	var user, pass;
	var con=true;
	var patternUSER=/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	user=document.getElementById("email").value;
	pass=document.getElementById("password").value;
	if(user===""){
		document.getElementById("errore_mail").innerHTML= "Inserire la email! ";
		con=false;
	}
    if(pass===""){
        document.getElementById("errore_pass").innerHTML= "Inserire la password! ";
        con=false;
    }
	if(!patternUSER.test(user.value)){
		document.getElementById("errore_mail").innerHTML= "Email "+ user + " non valida! ";
		con=false;
	}
	return con;
}
/*
function prenota(){
   //pulisci();//pulisco i p ogni volta che l'utente cerca di inserire i dati
   if(emptyForm()){//verifico se tutti i campi sono diversi da null
       if(valida()){
            return true;//funzione per validare i campi dati
       }
       else{
           return false;
       }
    }
    return false;//altrimenti ritorna false se mancano i campi dati
}

function emptyForm(){
    var checkIn = document.getElementByName("check-in");
    var checkOut = document.getElementByName("check-out");
    var nomeCognome = document.getElementByName("input-name");
    var email = document.getElementByName("guest-email");
    var con=true;
    if(checkIn.value===""){
        document.getElementById("checkIn_error").innerHTML = "Data di arrivo è richiesta! ";
        con=false;
    }
    if(checkOut.value===""){
        document.getElementById("checkOut_error").innerHTML = "Data di partenza è richiesta!";
        con=false;
    }
    if(nomeCognome.value===""){
        document.getElementById("nomeCognome_error").innerHTML = "Il nome e cognome è richiesto! ";
        con=false;
    }
    if(email.value===""){
        document.getElementById("email_error").innerHTML = "L'email è richiesta! ";
        con=false;
    }
    return con;
}

function pulisci(){
    document.getElementById("checkIn_error").innerHTML = "";
    document.getElementById("checkOut_error").innerHTML = "";
    document.getElementById("nomeCognome_error").innerHTML = "";
    document.getElementById("email_error").innerHTML = "";
}

function valida(){
    var con=true;
    var nomeCognome = document.getElementByName("guest-name");
    var email = document.getElementByName("guest-email");
    var checkIn = document.getElementByName("check-in");
    var checkOut = document.getElementByName("check-out");
    var patternCheck = /^[0-9]{2}\-[0-9]{2}\-[0-9]{4}$/;
    var patternNC = /^([a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27]\s?)+$/;
    var patternEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(!patternCheck.test(checkIn.value)){
        document.getElementById("errore_checkIn").innerHTML= "Data di arrivo non valida! ";
        con=false;
    }
    if(!patternCheck.test(checkOut.value)){
        document.getElementById("errore_checkOut").innerHTML= "Data di partenza non valida! ";
        con=false;
    }
    if(!patternNC.test(nomeCognome.value)){
        document.getElementById("errore_nomeCognome").innerHTML= "In quale universo uno si chiama "+nomeCognome.value+" non valido! ";
        con=false;
    }
    if(!patternEmail.test(email.value)){
        document.getElementById("errore_email").innerHTML= "Email "+ email.value + " non valida! ";
        con=false;
    }
    return con;
}

*/
function checkNomeCognome(){
	var con=true;
	var tag=document.getElementById("input-name").value;
	var ctrl=/^[a-zA-Z ]+$/;
	if(tag.value==null || tag.value=="" || tag.value.length < 3 || tag.value.length > 20 || !crtl.test(tag.value))
		document.getElementById("errori").innerHTML= "<li>Nome e Cognome non inseriti correttamente</li>";
		con=false;
	return con;
}

function checkEmail(){
	var con=true;
	var tag=document.getElementById("guest-mail").value;
	var ctrl = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    if (tag.value == null || tag.value == "" || /^[ ]+$/.test(tag.value)){
        document.getElementById("errori").innerHTML= "<li>Il campo email non può essere vuoto</li>";
    	con=false;
    }
    if(!ctrl.test(tag.value)){
    	document.getElementById("errori").innerHTML= "<li>Il campo email non è inserito correttamente</li>";
    	con=false;
    }
    return con;
}

function checkData(){
	var con=true;
    var tag1 = document.getElementById("check-in").value;
    var tag2 = document.getElementById("check-out").value;     
    var ctrl = /^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/;

    if(!ctrl.test(tag1.value) || !ctrl.test(tag2.value)){
        document.getElementById("errori").innerHTML= "<li>Formato data non valido, il formato deve essere di tipo gg/mm/aaaa</li>";
    	con=false
    }
    return con;
}

function checkPrenota(){
	var errori = checkData("check-in") + checkData("check-out") + checkNomeCognome("input-name") + checkEmail("guest-email");
	if(errori){
		document.getElementById("errori").innerHTML = "<ul>" + errori + "</ul>";
		return false;
	}
	return true;
}



