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
          ["nombre" => "Santa Fe"]
        ],
      ],
      [
        "nombre" => "EEUU",
        "hijos" => [
          ["nombre" => "Arizona"],
          ["nombre" => "Florida"]
        ]
      ]
    ]
  ],
  [
      "nombre" => "Europa",
      "hijos" => [
          ["nombre" => "España"],
          ["nombre" => "Italia"],
      ]
  ]
];

function buscarDestinos(array $destinos, string $substring):array {
  $coincidencias = array();
  foreach ($destinos as $key => $value) {
    foreach ($value as $eslavon => $valor) {
      if ($eslavon == "nombre"){
        if($valor == $substring){
          $coincidencias[] = $valor;
        }
      }elseif ($eslavon == "hijos") {
        buscarDestinos($valor, $substring);
      }
    }
  }
    return $destinos;
}

//ej
$coincidencias = buscarDestinos($ejemploDestinos2, "ar"); //["Argentina", "Arizona"]