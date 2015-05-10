function pausecomp(millis){
  var date = new Date();
  var curDate = null;
  do { curDate = new Date(); }
  while(curDate-date < millis);

}
function rotar(){
	var timer = setInterval(sliderScroll, 10);
	//230px ancho ventana
	//Desplaza el contenedor derecha
    var slider =document.getElementById("slider");
	    // crea el temporizador
	var timer = setInterval(sliderScroll, 10);
	//Asigna el ancho total de los slides al contenedor
	//La anchura total se obtiene multiplicando la medida de un slide por el nÃºmero de slides)
	document.getElementById("slidesContainer").style.width="920px";//230*4=920
	var incremento=0;
	var totalWidth =690;//4*230-230=690//Calcula la anchura total menos el ultimo slide.
	var position=0;
	function sliderScroll(){
	    position =document.getElementById("slider").scrollLeft; //Calcula la posicion actual del contenedor
		//si estamos al inicio de una imagne que se pare durante 1seg
		if(position%230==0){
			pausecomp(1000);
		}
		//movemos scroll
		incremento=position+1;
		if(incremento>totalWidth){//si es el final del scroll -> volvmeos a empezar
			slider.scrollLeft=0;
		}
		else{
	    	slider.scrollLeft=incremento;
		}
    }
}


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
        if(document.getElementById("checkbox6").checked==true) cantidad_dinero=cantidad_dinero+2;
		if(document.getElementById("checkbox7").checked==true) cantidad_dinero=cantidad_dinero+2;
		if(document.getElementById("option1").selected==true) cantidad_dinero=cantidad_dinero+10;//estudiante
		if(document.getElementById("option2").selected==true) cantidad_dinero=cantidad_dinero+15;//profesor
		if(document.getElementById("option3").selected==true) cantidad_dinero=cantidad_dinero+20;//visitante

		dinero.innerHTML="Total:"+cantidad_dinero.toString()+"€";
	}
}

function switch_section(n){
	if(document.getElementById("subseccion"+n).style.display=="block")
		document.getElementById("subseccion"+n).style.display="none";
	else
		document.getElementById("subseccion"+n).style.display="block";
}

//mantine un checkbox siempre checked
function alwayschecked(id){
    document.getElementById(id).checked = true;
}

//devuelve que option se ha selecionado del select
function returnCuota() {
    var x = document.getElementById("tipo").selectedIndex;
    console.log(x);
}
