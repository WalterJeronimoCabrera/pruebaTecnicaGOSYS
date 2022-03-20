<?php
    class Camion{
        var Modelo $modelo;
        var int $patente;
        var HojaDeRuta $hojaDeRuta;
        var Viaje $tipoDeViaje;

        public function __construct(Modelo $modelo, int $patente, HojaDeRuta $hojaDeRuta, Viaje $tipoDeViaje){
            $this->$modelo = $modelo;
            $this->$patente = $patente;
            $this->$hojaDeRuta = $hojaDeRuta;
            $this->$tipoDeViaje = $tipoDeViaje;
        }
        public function calcularCostoPorHojaDeViaje(HojaDeRuta $var){
            
        }
    }
    

    class HojaDeRuta{
        var array $recorrido;
    }

    abstract class Viaje{
        var array $paquetes;
        var int $costo;

        abstract public function costo();

    }

    class Normal extends Viaje{
        public function costo(){
            return 2 * $kgTotal * $kmRecorrido;
        }
    }

    class Prioritario extends Viaje{
        public function costo(){
            $op1 = 4 * $kgTotal * $kmRecorrido;
            $op2 = 10 * $volumenTotal * $kmRecorrido;
            return max($op1, $op2);
        }
    }

    class Devolucion extends Viaje{
        public function costo(){
            return 100;
        }
    }

    class Modelo{
        var float $volumen;
        var float $pesoMax;

        
    }

    class Paquete{
        var float $peso;
        var float $alto;
        var float $ancho;
        var float $largo;
    }

    class lugar{
        var Direccion $direccion;
        var coordenadas $coordenas;
    }

    class Direccion{
        var string $calle;
        var int $altura;
    }

    class coordenadas{
        var float $latiud;
        var float $altitud;
    }

?>