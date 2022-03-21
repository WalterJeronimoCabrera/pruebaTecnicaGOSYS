<?php

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

function buscarDestinos(array $destinos, string $substring) {
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

function esResultadoValido($buscado, $buscando):Bool{
  $buscado = strtolower($buscado);
  $buscando = strtolower($buscando);
  if (strpos($buscado,$buscando) !== false) {
    return true;
  }else{return false;}
}

function recorrerArbol($arbol, $array){
  foreach ($arbol as $key => $value) {
    foreach ($value as $clave => $valor) {
      if ($clave == "nombre"){
        echo $valor; echo '<br><br>';
      }elseif ($clave == "hijos") {
          recorrerArbol($valor, $array);
        }
    }
  }
}


function imprimirArray(Array $array){
  foreach ($array as $key => $value) {
    echo $value;echo', ';
  }
}

$coincidencias = buscarDestinos($ejemploDestinos2, "san"); //["Argentina", "Arizona"]
imprimirArray($coincidencias);

// $array = array();
// $jero = recorrerArbol($ejemploDestinos2,$array);
// print_r($jero);

// buscarDestinos()



