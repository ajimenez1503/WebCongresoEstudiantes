//Si dios quiere esto validará los datos
function formSubmit(){
	var there_err=false;
	var dinero=document.getElementById("dinero");
	var name=document.getElementById("formNombre").value;
	var surname=document.getElementById("formApellidos").value;

	var mail=document.getElementById("formMail").value;
	mail=mail.trim();
	if(mail.search(" ")!=-1)
		there_err=true;
	else{
		var mail2=mail.split("@");
		if(mail2.length!=2) there_err=true;
		else if(mail2[0].length==0) there_err=true;
		else{
		    var mail3=mail2[1].split(".");
		    if(mail3.length<2)
			there_err=true;
		    else{
			var t;
			for(var i=0;i<mail3.length;i++){
			    if(mail3[i].length==0) there_err=true;
			}
		    }
		}
	}
	if(name.length<=2)
		alert("Error, nombre no es correcto");
	else if(surname.length<=2)
		alert("Error, apellido no es correcto");
	else if(there_err==true)
		alert("Error, correo no es correcto");
	else{
		alert("Ha sido inscrito al congreso correctamente");

		//calculamos dinero y los mostramos en un parrafo
		var cantidad_dinero=0;
		if(document.getElementById("checkbox1").checked==true) cantidad_dinero=cantidad_dinero+2;
		if(document.getElementById("checkbox2").checked==true) cantidad_dinero=cantidad_dinero+2;
		if(document.getElementById("checkbox3").checked==true) cantidad_dinero=cantidad_dinero+2;
		if(document.getElementById("checkbox4").checked==true) cantidad_dinero=cantidad_dinero+2;
		if(document.getElementById("checkbox5").checked==true) cantidad_dinero=cantidad_dinero+2;
		if(document.getElementById("option1").selected==true) cantidad_dinero=cantidad_dinero+10;//estudiante
		if(document.getElementById("option2").selected==true) cantidad_dinero=cantidad_dinero+15;//profesor
		if(document.getElementById("option3").selected==true) cantidad_dinero=cantidad_dinero+20;//visitante

		dinero.innerHTML="Total:"+cantidad_dinero.toString()+"€";
	}
}

function ver(n) {
        document.getElementById("subseccion"+n).style.display="block";
}
function ocultar(n) {
         document.getElementById("subseccion2").style.display="none";
	     document.getElementById("subseccion1").style.display="none";
}

setInterval(image_slider, 3000);
function image_slider(){
var imgs=["images/cevug.png","images/ugr.png","images/ceibiotic.png","images/osl.png"];
var image=document.getElementById("image_pat");
//var src=image.src;
var n=Math.floor(Math.random() * imgs.length);
image.src=imgs[n];

}
//
