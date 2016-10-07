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
    
    var content = document.getElementById("content");
    var div_product = document.createElement("div");
    var parrafo = document.createElement("p");

    var msje = document.createElement("div");
    msje.innerHTML = "msje = ";
    msje.innerHTML += data.msje;
    
    var id = document.createElement("div");
    id.innerHTML = "id = ";
    id.innerHTML += data.product.id;
    
    var name = document.createElement("div");
    name.innerHTML = "name = ";
    name.innerHTML += data.product.name;
    
    var description = document.createElement("div");
    description.innerHTML = "description = ";
    description.innerHTML += data.product.description;
    
    var condition = document.createElement("div");
    condition.innerHTML = "condition = ";
    condition.innerHTML += data.product.condition;
    
    var datepicker1 = document.createElement("div");
    datepicker1.innerHTML = "datepicker1 = ";
    datepicker1.innerHTML += data.product.datepicker1;
    
    var datepicker2 = document.createElement("div");
    datepicker2.innerHTML = "datepicker2 = ";
    datepicker2.innerHTML += data.product.datepicker2;
    
    var price = document.createElement("div");
    price.innerHTML = "price = ";
    price.innerHTML += data.product.price;
    
    var stock = document.createElement("div");
    stock.innerHTML = "stock = ";
    stock.innerHTML += data.product.stock;
    
    var category = document.createElement("div");
    category.innerHTML = "category = ";
    category.innerHTML += data.product.category;
    
    var cad = data.avatar.datos;
    
    var img = document.createElement("div");
    var html = '<img src="' + cad + '" height="75" width="75"> ';
    img.innerHTML = html;
    

    div_product.appendChild(parrafo);
    parrafo.appendChild(msje);
    parrafo.appendChild(id);
    parrafo.appendChild(name);
    parrafo.appendChild(description);
    parrafo.appendChild(condition);
    parrafo.appendChild(datepicker1);
    parrafo.appendChild(datepicker2);
    parrafo.appendChild(price);
    parrafo.appendChild(stock);
    parrafo.appendChild(category);
    content.appendChild(div_product);
    content.appendChild(img);
}
