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

  $coincidenciasParciales = array();

  foreach ($destinos as $key => $value) {
    foreach ($value as $clave => $valor) {
      if ($clave == "nombre"){
        // if($valor == $substring){
        //   echo'verdad';echo '<br><br>';
        //   $coincidenciasParciales[] = $valor;
        // }else{
        //   echo'mentira';echo '<br><br>';
        // }
        //print_r($valor); echo 'desde nombre';echo '<br><br>';
        }elseif ($clave == "hijos") {
          buscarDestinos($valor, $substring);
        }
    }
  }
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
    echo $value;
  }
}
// function recortando(string $buscado, string $comparacion){
//   //$tamaño = count($buscado);
//   $tamanio = $buscado::length();

// }

//recortando("ar", "argentina");
// buscarDestinos($ejemploDestinos2, "Santa Fe"); //["Argentina", "Arizona"]
print_r(buscarDestinos($ejemploDestinos2, "Santa Fe"));
$array = array();
$jero = recorrerArbol($ejemploDestinos2,$array);
print_r($jero);