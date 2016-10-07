function load_products() {
    
    var jqxhr = $.get("modules/products/controller/controller_products.class.php?load=true", function (data) {
        var json = JSON.parse(data);
        console.log(json);
        pintar_product(json);
        //alert( "success" );
    }).done(function () {
        //alert( "second success" );
    }).fail(function () {
        //alert( "error" );
    }).always(function () {
        //alert( "finished" );
    });

    jqxhr.always(function () {
        //alert( "second finished" );
    });
}

$(document).ready(function () {
    
    load_products();
});

function pintar_product(data) {
    console.log(data);
    var content = document.getElementById("content");
    var div_product = document.createElement("div");
    var parrafo = document.createElement("p");

    var msje = document.createElement("div");
    msje.innerHTML = "msje = ";
    msje.innerHTML += data.msje;
    
    var id = document.createElement("div");
    id.innerHTML = "id = ";
    id.innerHTML += data.product.id;
    console.log(data.product.id);
    var name = document.createElement("div");
    name.innerHTML = "name = ";
    name.innerHTML += data.product.name;
    
    var cad = data.avatar.datos;
    console.log(cad);
    //var cad = cad.toLowerCase();
    var img = document.createElement("div");
    var html = '<img src="' + cad + '" height="75" width="75"> ';
    img.innerHTML = html;
    

    div_product.appendChild(parrafo);
    parrafo.appendChild(msje);
    parrafo.appendChild(id);
    parrafo.appendChild(name);
    content.appendChild(div_product);
    content.appendChild(img);
   console.log(content.appendChild(div_product));
    console.log(content.appendChild(img));
}
