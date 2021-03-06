<?php
    class Camion{
        var Modelo $modelo;
        var string $patente;
        var HojaDeRuta $hojaDeRuta;

        public function __construct(Float $volumenMax, Float $pesoMax, string $patente){
            $this->modelo = new Modelo($volumenMax, $pesoMax);
            $this->patente = $patente;
        }

        public function asignarHojaDeRuta(HojaDeRuta $hoja){
            if ($this->modelo->puedeHacerEstaRuta($hoja)) {
                $this->hojaDeRuta = $hoja;
                echo 'se asigno';
            }else{
                throw new Exception("No se le puede asignar esta Hoja de ruta, ya que exede los limites del modelo del camion");
            }
        }

        public function calcularCostoPorHojaDeViaje(HojaDeRuta $hoja){
            return $hoja->calcularCosto();
        }
    }

    class Modelo{
        var float $volumenMax;
        var float $pesoMax;

        public function __construct(Float $volumenMax, Float $pesoMax){
            $this->volumenMax = $volumenMax;
            $this->pesoMax = $pesoMax;
        }

        public function puedeHacerEstaRuta(HojaDeRuta $hoja):Bool{
            return $hoja->peso() < $this->pesoMax && $hoja->volumen() < $this->volumenMax ;
        }
    }

    class HojaDeRuta{

        var array $viajes;
        var float $pesoTotal;
        var float $volumenTotal;
        var float $distanciaTotal;

        public function __construct(Array $viajes){
            $this->viajes = $viajes;
        }

        public function distancia():float{
            $valor = 0;
            foreach ($this->viajes as $key => $value) {
                $valor += $value->distancia();
            }
            $this->distanciaTotal = $valor;
            return $this->distanciaTotal;
        }

        public function volumen():float{
            $valor = 0;
            foreach ($this->viajes as $key => $value) {
                $valor += $value->volumen();
            }
            $this->volumenTotal = $valor;
            return $this->volumenTotal;
        }

        public function peso():float{
            $valor = 0;
            foreach ($this->viajes as $key => $value) {
                $valor += $value->peso();
            }
            $this->pesoTotal = $valor;
            return $this->pesoTotal;
        }

        public function calcularCosto():float{
            $valor = 0;
            foreach ($this->viajes as $key => $value) {
                $valor += $value->calcularCosto();
            }
            return $valor;
        }
    }

    class Viaje{
        var Lugar $origen;
        var Lugar $destino;
        var mixed $paquetes;

        public function __construct(Lugar $origen, Lugar $destino, mixed $paquetes){
            $this->origen = $origen;
            $this->destino = $destino;
            $this->paquetes = $paquetes;
        }

        public function asignarPaquetes(Paquete $paquete)
        {
            $this->paquetes->$paquete;
        }

        public function peso():Float{
            $valor = 0;
            foreach($this->paquetes as $key => $value) {
                $valor += $value->peso();
            }
            return $valor;
        }

        public function volumen():Float{
            $valor = 0;
            foreach($this->paquetes as $key => $value) {
                $valor += $value->volumen();
            }
            return $valor;
        }

        public function distancia():Float {
            $theta = $this->origen->longitud() - $this->destino->longitud(); 
            $distance = (sin(deg2rad($this->origen->latitud())) * sin(deg2rad($this->destino->latitud()))) + (cos(deg2rad($this->origen->latitud())) * cos(deg2rad($this->destino->latitud())) * cos(deg2rad($theta))); 
            $distance = acos($distance); 
            $distance = rad2deg($distance); 
            $distance = $distance * 60 * 1.1515; 
            $distance = $distance * 1.609344;
            return (round($distance,2)); 
        }
    }

    class Normal extends Viaje{

        public function calcularCosto():Float{
            return 2 * $this->peso() * $this->distancia();
        }
    }

    class Prioritario extends Viaje{

        public function calcularCosto(){
            $op1 = 4 * $this->peso() * $this->distancia();
            $op2 = 10 * $this->volumen() * $this->distancia();
            return max($op1, $op2);
        }
    }

    class Devolucion extends Viaje{
        public function calcularCosto(){
            return 100;
        }
    }

    class Paquete{
        var float $peso;
        var float $alto;
        var float $ancho;
        var float $largo;

        public function __construct(Float $peso, Float $alto, Float $ancho, Float $largo){
            $this->peso = $peso;
            $this->alto = $alto;
            $this->ancho = $ancho;
            $this->largo = $largo;
        }

        public function peso():Float{
            return $this->peso;
        }

        public function volumen():Float{
            return $this->alto * $this->ancho * $this->largo;
        }
    }

    class lugar{
        var string $calle;
        var int $altura;
        var float $latiud;
        var float $longitud;

        public function __construct(String $calle, Int $altura, Float $latitud, Float $longitud){
            $this->calle = $calle;
            $this->altura = $altura;
            $this->latitud = $latitud;
            $this->longitud = $longitud;
        }

        public function calle(){
            return $this->calle;
        }

        public function altura(){
            return $this->altura;
        }

        public function latitud(){
            return $this->latitud;
        }

        public function longitud(){
            return $this->longitud;
        }
    }

    //paquetes
    $celular = new Paquete(250,0.14,0.05,0.02);
    $pecera = new Paquete(2.250,0.85,0.40,1.1);
    $tanqueDeGuera = new Paquete(20000,15,3,4);

    //array de paquetes
    $array1 = [$celular, $pecera];
    $array2 = [$celular, $pecera, $tanqueDeGuera];

    //Lugares
    $villaRosa = new Lugar("Eva Peron", 75858, 12 ,15);
    $rusia = new Lugar("dahka", 2525, 25525, 21);
    $centralDeCarga = new Lugar("ruta 25", 25, 25.25, 2525.25);

    //viajes
    $aVillaRosa = new Normal($centralDeCarga, $villaRosa, $array1);
    $aRusia = new Prioritario($centralDeCarga, $rusia, $array2);
    $aCentralDeCarga = new Devolucion($rusia, $centralDeCarga, $array1);

    //hojas De Rutas
    $hojaDeRuta2 = new HojaDeRuta([$aRusia, $aCentralDeCarga]);
    $hojaDeRuta1 = new HojaDeRuta([$hojaDeRuta2, $aVillaRosa]);
    $rutaExpress = new HojaDeRuta([$aVillaRosa]);

    //camiones
    $camion = new Camion(2500, 6000, "mgt 532");

    $camion->asignarHojaDeRuta($hojaDeRuta2);
    $camion->calcularCostoPorHojaDeViaje($hojaDeRuta2);
?>