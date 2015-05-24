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
        echo "<img id=\"foto_hotel\" src = \"http://127.0.0.1/heisenburg/".$this->imagen."\">";
        echo "<div>";
        echo "<h2> HOTEL ".$this->nombre." </h2>";
        echo "<h4>Precio desde: ".$this->precio." € </h4>";
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
    $size=count($decoded);
    if($httpcode==200 && $size>0){//mostramos los hotels en forma de tabla
        echo "<table>";
        for($i = 0; $i<$size; $i++) {
            $h = new Hotel;
            $h->read_hotel($decoded[$i]);
            if($i%2==0){
                echo "<tr>";
                echo "<td>";
                echo "<div class = \"hotel_izquierda\">";
                $h->mostrar();
                echo "</div><!-- end hotel_izquierda -->";
                echo "</td>";
            }
            else{
                echo "<td>";
                echo "<div class = \"hotel_derecha\">";
                $h->mostrar();
                echo "</div><!-- end hotel_derecha -->";
                echo "</td>";
                echo "</tr>";
            }
        }
        echo "</table>";

    }
    else{
        echo "error Header:" . $httpcode . "</br>";
    }


}
?>
