<?php
    class Camion{
        var Modelo $modelo;
        var int $patente;
        var HojaDeRuta $hojaDeRuta;
        var Viaje $tipoDeViaje;

        public function __construct(Modelo $modelo, int $patente, HojaDeRuta $hojaDeRuta, Viaje $tipoDeViaje){
            $this->modelo = $modelo;
            $this->patente = $patente;
            $this->hojaDeRuta = $hojaDeRuta;
            $this->tipoDeViaje = $tipoDeViaje;
        }
        public function calcularCostoPorHojaDeViaje(HojaDeRuta $hoja){
            
        }
    }
    

    class HojaDeRuta{
        var array $viajes;

        public function __construct(Array $viajes){
            $this->viajes = $viajes;
        }

        public function kmTotal():float{
            $valor = 0;

            foreach ($this->viajes as $key => $value) {
                $valor += $value->kmTotal();
            }

            return $valor;
        }
    }

    abstract class Viaje{
        var Lugar $origen;
        var Lugar $destino;
        var array $paquetes;
        var int $costo;

        public function __construct(Lugar $origen, Lugar $destino, Array $paquetes){
            $this->origen = $origen;
            $this->destino = $destino;
            $this->paquetes = $paquetes;
        }

        abstract public function calcularCosto();

    }

    class Normal extends Viaje{
        public function calcularCosto(){
            return 2 ;
        }
    }

    class Prioritario extends Viaje{
        

        public function calcularCosto(){
            $op1 = 4;
            $op2 = 10;
            return max($op1, $op2);
        }
    }

    class Devolucion extends Viaje{
        public function calcularCosto(){
            return 100;
        }
    }

    class Modelo{
        var float $volumenMax;
        var float $pesoMax;

        public function __construct(Float $volumenMax, Float $pesoMax){
            $this->volumenMax = $volumenMax;
            $this->pesoMax = $pesoMax;
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
    }

    class lugar{
        var Direccion $direccion;
        var coordenadas $coordenas;

        public function __construct(String $calle, Int $altura, Float $latitud, Float $altitud){

            $this->direccion = new Direccion($calle, $altura);
            $this->coordenas = new coordenadas($latitud, $altitud);
        }
    }

    class Direccion{
        var string $calle;
        var int $altura;

        public function __construct(String $calle, Int $altura){
            $this->calle = $calle;
            $this->altura = $altura;
        }
    }

    class coordenadas{
        var float $latiud;
        var float $altitud;

        public function __construct(Float $latitud, Float $altitud){
            $this->latitud = $latitud;
            $this->altitud = $altitud;
        }
    }

?>