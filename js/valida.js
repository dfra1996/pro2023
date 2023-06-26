// Ffuncion agregar un nuevo imput
$(document).ready(function(){
    var maxField = 200; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><label>Arbol Nro: </label><input type="text" name="arbol[]" value=""/ class="form-control" maxlength="6" required><a href="javascript:void(0);" class="remove_button btn btn-danger" title="Remove field">Eliminar arbol</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    $(addButton).click(function(){ //Once add button is clicked
        if(x < maxField){ //Check maximum number of input fields
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); // Add field html
        }
    });
    $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
 //
//Funcion recorrer Ciudades
function recCiudad(value){
    //alert("Si le llega "+value);
    var parametros ={
        "valor" : value
    };
    $.ajax({
        data: parametros,
        url: 'selmun.php',
        type: 'post',
        success: function(response){
            $("#reloadMun").html(response);
        }
    });
}
function recCircuito(value){
    //alert("Si le llega "+value);
    var parametros ={
        "valor" : value
    };
    $.ajax({
        data: parametros,
        url: 'selcir.php',
        type: 'post',
        success: function(response){
            $("#reloadcircuito").html(response);
        }
    });
}
function reczona(value){
    //alert("Si le llega "+value);
    var parametros ={
        "valor" : value
    };
    $.ajax({
        data: parametros,
        url: 'selzon.php',
        type: 'post',
        success: function(response){
            $("#reloadzona").html(response);
        }
    });
}
function cambio(elemento, checkbox1, checkbox2){
    if (checkbox1.checked == true && elemento ==1) {
        checkbox2.checked = false;
    }
    if(checkbox2.checked == true && elemento ==2){
        checkbox1.checked = false;
    }
    if(checkbox1.checked == true && elemento ==1){
        checkbox1.required = true;
        checkbox2.required = false;   
    }else if(checkbox2.checked == true && elemento ==2){        
        checkbox1.required = false;
        checkbox2.required = true;
    }  
}    
//FUNCIONES PARA ACTIVAR O DESACTIVAR CAMPOS A TRAVES DE UN RADIO 
function che1(elemento,iden){  
    var obj = elemento;
    if (obj.checked){      
        iden.style.display = ""; 
        iden.required=true;
        iden.name="descri[]";
    }
}
function che2(obj,iden){
    if (obj.checked){
        iden.style.display ="none";
        iden.required=false;
        iden.value=null;
        iden.name="nn";

    }   
}
function chec1(elemento,iden){  
    var obj = elemento;
    if (obj.checked){      
        iden.style.display = ""; 
        iden.required=true;
        iden.name="descrie[]";
    }
}
function chec2(obj,iden){
    if (obj.checked){
        iden.style.display ="none";
        iden.required=false;
        iden.value=null;
        iden.name="nn";
    }   
}
//FUNCIONES PARA ACTIVAR O DESACTIVAR CAMPOS A TRAVES DE UN RADIO 
function cradio(elemento,iden){  
    var obj = elemento;
    if (obj.checked){      
        iden.style.display =""; 
        iden.required=true;
    }
}
function ctexa(obj,iden){
    if (obj.checked){
        iden.style.display ="none";
        iden.required=false;
        iden.value=null;
    }   
}
////////////////////////////
/*Funciones para la geolocalizacion COORDENADAS*/
var x = document.getElementById("demo");
function getLocation() {
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showPosition, showError);
        navigator.geolocation.getCurrentPosition(showPositionT);
    }else{
        x.innerHTML = "Geolocalizacion no soportada";
    }
}
function showPositionT(position) {
    var lat = document.getElementById("lat");
    var lng = document.getElementById("lng");
    /*x.innerHTML = "Latitud: <input type='text'name='lat' value='" + position.coords.latitude + "'><br>Longitud: <input type='text' name='lng' value='" + position.coords.longitude+"'>";*/
    //x.innerHTML = "<a target='_blank'  href='https://www.google.com/maps?ll="+ position.coords.latitude +","+ position.coords.longitude+" &z=16&t=m&hl=es-419&gl=US&mapclient=embed&q=4%C2%B051%2731.7%22N+74%C2%B003%2719.1%22W+"+position.coords.latitude+"00,+"+ position.coords.longitude+"@"+ position.coords.latitude +","+ position.coords.longitude+"'><i>Ir al mapa</i></a>"
    document.getElementById('lat').value = position.coords.latitude;
    document.getElementById('lng').value = position.coords.longitude;
}
function showPosition(position) {
    lat = position.coords.latitude;
    lon = position.coords.longitude;
    //latlon = new google.maps.LatLng(lat, lon);
}
function showError(error) {
    switch(error.code){
        case error.PERMISSION_DENIED:
        x.innerHTML = "USER denied the request for Geolocation.";
        break;
        case error.POSITION_UNAVAILABLE:
        x.innerHTML = "location information is unavailable.";
        break;
        case error.TIMEOUT:
        x.innerHTML = "the request to get user location time out.";
        break;
        case error.UNKNOWN_ERROR:
        x.innerHTML = "An unknown error occurred.";
        break;
    }
}

////////////////////////////
/**/