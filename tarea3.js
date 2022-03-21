let facturas = [{
    cliente: {
        nombre: "Coca Cola",
        tipo: "B2B"
    },
    pagada: false,
        items: [
            {subtotal: 1234.44, descripcion: 'asdfg'},
            {subtotal: 5678.88, descripcion: 'qwerty'}
    ]},
    {
    cliente: {
        nombre: "Juan Perez",
        tipo: "B2C"
    },
    pagada: false,
        items: [
            {subtotal: 5556.54, descripcion: 'asdfg'},
            {subtotal: 9632.21, descripcion: 'qwerty'}
    ]},
    {
    cliente: {
        nombre: "John Smith",
        tipo: "B2C"
    },
    pagada: true,
        items: [
            {subtotal: 1234.44, descripcion: 'asdfg'},
            {subtotal: 5678.88, descripcion: 'qwerty'}
    ]},
    {
    cliente: {
        nombre: "Esteban Quito",
        tipo: "B2C"
    },
    pagada: false,
        items: [
            {subtotal: 895.7, descripcion: 'asdfg'},
            {subtotal: 8542.34, descripcion: 'qwerty'},
            {subtotal: 9674.95, descripcion: 'qwerty'}
    ]}
];
posicion = 0;
tamanio = facturas.length;
var deudaB2C = 0;
var deudaB3C = 0;

function buscarDeudas(posicion){
    if (posicion < tamanio) {
        if(!facturas[posicion].pagada){
            if(facturas[posicion].cliente.tipo == "B2C"){
                deudaB2C +=  facturas[posicion].items.subtotal.sum;
            }if (facturas[posicion].cliente.tipo == "B3B") {
                deudaB3C +=  facturas[posicion].items.subtotal.sum;
            }
        }
        posicion += 1;
        buscarDeudas(posicion);
    }
}

var deudaTotal = facturas.map(function(x){
    if(!x.pagada){
        return x.items.sum(function(y){
            return y.subtotal;
        })
    }
});

console.log(deudaTotal);
