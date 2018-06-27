function login(){
	var user, pass;
	var con=true;
	var patternUSER=/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	user=document.getElementById("email").value;
	pass=document.getElementById("password").value;
	if(!patternUSER.test(user)){
		document.getElementById("errore_mail").innerHTML= "Email " +email+" non valida! ";
		con=false;
	}
	if(pass===""){
		document.getElementById("errore_pass").innerHTML= "Inserire la password! ";
		con=false;
	}
	return con;
}