
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>NASA</title>
</head>
<!-- Barra de Navegación -->
<nav class="navbar navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e5/NASA_logo.svg/2449px-NASA_logo.svg.png" alt="Bootstrap" width="35" height="32">
        Localización Satelital</a>
  </div>
</nav>
<body>
    <!-- Contenedor Principal -->
    <div class="container">

        <!-- Bloque de Ingreso de Datos -->
        <div class="card mt-4 text-center">
            <div class="card-body">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e5/NASA_logo.svg/2449px-NASA_logo.svg.png" width="20%">
                <h2>Localización Satelital</h2>
                <p class="mt-3">Ingrese la latitud y longitud:</p> 
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <input type="text" class="form-control" id="txtEnter" placeholder="Ej: 29.78, -95.33">
                    </div>
                    <div class="col-2"></div>
                </div>
                <button type="button" class="btn btn-primary my-3" id="img">Enviar Datos</button>
                <div class="row mt-2">
                    <div class="col-2"></div>
                    <div class="col-8">
                    <p class="text-muted">
                        Nota: Las imagenes son obtenidas del satélite Landsat 8 lanzado el 11 de febrero de 2013. Las imagenes mostradas son del 01-01-2018
                        por lo que es posible que algunas de las ubicaciones no esten disponibles.
                    </p>
                    </div>
                    <div class="col-2"></div>
                </div>
            </div>
        </div>

        <!-- Bloque de Resultados -->
        <div class="card text-center my-4" id="cont" style="display: none;">
            <h3 class="my-3">Resultados</h3>
            <div id="results"></div>
            <div id="image"></div>
        </div>
        
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

<script>

    //Capturar el envio de datos (Evento click)
    $( "#img" ).click(function() {

        //Capturar valores del input
        var texto = $("#txtEnter").val();

        //Separar valores ingresados (Latitud y Longitud)
        var separador = texto.split(",");

        //Consumo de API
        getImageData(separador[0], separador[1]);

        //Salida de resultados
        $("#cont").css("display", "block");
        $("#txtEnter").val("");
    });

    //Función de consumo de API
    function getImageData(lat, lon)
    { 
        //Envío de Solicitud a la API 
        $.get("https://api.nasa.gov/planetary/earth/assets?api_key=LW4KNbpqUMgN1Up8HtDb344d7Gql0XU75CBrMZYr",
            {
                lat: lat,
                lon: lon,
                date: '2018-01-01',
                dim: 0.25
            },
            //Salida de resultados
    		function(response)
    		{    		    
    			$("#image").html("<img src='"+ response.url +"'  class='img-thumbnail mb-4' width='60%' />");
                $("#results").html("<p>Latitud: "+ lat +", Longitud: "+ lon +"</p>");
    		}
    	);
    }
</script>
</html>