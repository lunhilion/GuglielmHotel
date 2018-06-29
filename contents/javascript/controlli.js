
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
	if(!patternUSER.test(user.value)){
		document.getElementById("errore_mail").innerHTML= "Email non valida! ";
		con=false;
	}
	if(pass===""){
		document.getElementById("errore_pass").innerHTML= "Inserire la password! ";
		con=false;
	}
	return con;
}

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




