//Si dios quiere esto validará los datos
function formSubmit(){
var there_err=false;
var dinero=document.getElementById("dinero");
var error=document.getElementById("error");
var name=document.getElementById("formNombre").value;
var surname=document.getElementById("formApellidos").value;

var mail=document.getElementById("formMail").value;
mail=mail.trim();
if(mail.search(" ")!=-1) there_err=true;
else{
var mail2=mail.split("@");
if(mail2.length!=2) there_err=true;
else if(mail2[0].length==0) there_err=true;
else{
    var mail3=mail2[1].split(".");
    if(mail3.length<2) there_err=true;
    else{
        var t;
        for(var i=0;i<mail3.length;i++){
            if(mail3[i].length==0) there_err=true;
        }

    }
}
}
if(name.length<=3 || surname.length<=3 || there_err==true)
error.innerHTML="Error, algún parámetro no es correcto";
else error.innerHTML="";
}
/*
var input=document.getElementById("stupidText").value;
       var res=input.split(" ");
       res.sort();
       res=res.toString();
       res=res.replace(/,/g," ");
       document.getElementById("result").innerHTML=res.toString();*/
