<?php
class Hotel{
    public $idAlojamiento;
    public $nombre;
    public $precio;
    public $direccion;
    public $estrellas; //0-5
    public $telefono;
    public $email;
    public $resumen;
    public $imagen;

    //se le pasa una decoded JSON
    public function read_hotel($decoded){
        $this->idAlojamiento=$decoded["idAlojamiento"];
        $this->nombre=$decoded["nombre"];
        $this->precio=$decoded["precio"];
        $this->direccion=$decoded["direccion"];
        $this->estrellas=$decoded["estrellas"]; //0-5
        $this->telefono=$decoded["telefono"];
        $this->email=$decoded["email"];
        $this->resumen=$decoded["resumenCorto"];
        $this->imagen=$decoded["imagen1"];
    }


    public function mostrar(){
        echo "<h2> HOTEL ".$this->nombre." </h2>";
        echo "<h4>Precio desde: ".$this->precio." € </h4>";
        echo "<img src = \"http://127.0.0.1/heisenburg/".$this->imagen."\">";
        echo "<div>";
        echo "<p>".$this->resumen."</p>";
        echo "</div>";
    }
}


if(isset($_POST["tipohab"]) && isset($_POST["fecha_entrada"]) && isset($_POST["fecha_entrada"])){


    $service_url = "http://localhost/heisenburg/rest/hotel/".$_POST["tipohab"]."/".$_POST["fecha_entrada"]."/".$_POST["fecha_salida"];//funcion de buscar alojameintos

    $curl = curl_init($service_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //to return the content


    $result = curl_exec($curl);
    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    $decoded=json_decode($result,true);
    //echo "Header:" . $httpcode . "</br>";
    if($httpcode==200){

        foreach ($decoded as  $valor) {
            $h = new Hotel;
            $h->read_hotel($valor);
            $h->mostrar();
        }
    }
    else{
        echo "error Header:" . $httpcode . "</br>";
    }


}
?>
