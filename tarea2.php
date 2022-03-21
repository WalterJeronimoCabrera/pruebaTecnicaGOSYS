<?php

use Viaje as GlobalViaje;

$ejemploDestinos1 = 
[
    [
    "nombre" => "America", 
        "hijos" => [
            [
            "nombre" => "Argentina",
            "hijos" => [
                [
                "nombre" => "Buenos Aires", 
                "hijos" => [
                    [
                        "nombre" => "Pilar",
                        "hijos" => [["nombre" => "Manzanares"]]
                    ]
                ]
                ],
                ["nombre" => "Córdoba"]
            ],
            ],
            [
            "nombre" => "Venezuela",
                "hijos" => [
                    ["nombre" => "Caracas"],
                    ["nombre" => "Vargas"]
                ]
            ]
        ]
    ]
];

$ejemploDestinos2 = [
  [
    "nombre" => "America",
    "hijos" => [
      [
        "nombre" => "Argentina",
        "hijos" => [
          ["nombre" => "Buenos Aires"],
          ["nombre" => "Córdoba"],
          ["nombre" => "Santa Fe"],
          ["nombre" => "Santa Fe"],
          ["nombre" => "Santa Fe"]
        ],
      ],
      [
        "nombre" => "EEUU",
        "hijos" => [
          ["nombre" => "Arizona"],
          ["nombre" => "Florida"],
          ["nombre" => "Santa Fe"],
        ]
      ]
    ]
  ],
  [
      "nombre" => "Europa",
      "hijos" => [
          ["nombre" => "España"],
          ["nombre" => "Italia"],
          ["nombre" => "Santa Fe"],
          ["nombre" => "Santa Fe"],    
      ]
  ]
];

function buscarDestinos(array $destinos, string $substring):array{
  $coincidencias = array();
  foreach ($destinos as $key => $value) {
    foreach ($value as $clave => $valor) {
      if ($clave == "nombre"){
        if(esResultadoValido($valor, $substring)){
          $coincidencias[] = $valor;
        }
        }elseif ($clave == "hijos") {
          $agregar = buscarDestinos($valor, $substring);
          $coincidencias = array_merge($coincidencias, $agregar);
        }
    }
  }
  return $coincidencias;
}

function esResultadoValido(String $buscado, String $buscando):Bool{
  $buscado = strtolower($buscado);
  $buscando = strtolower($buscando);
  if (strpos($buscado,$buscando) !== false) {
    return true;
  }else{return false;}
}

$coincidencias = buscarDestinos($ejemploDestinos2, "san"); //["Argentina", "Arizona"]