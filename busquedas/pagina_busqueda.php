<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Document</title>
</head>
<body style="background-color:cadetblue;">
<section class="row">>
    
<?php

$busqueda=$_POST["buscar"];

require("datos_conexion.php");


//conectar con la base de datos mysql
$conexion = mysqli_connect($servidor, $usuario, $password, $nameDatabase);



if(mysqli_connect_errno()){
    echo "Fallo al conectar con la BBDD";
    exit();
}



$sql = "SELECT * FROM cartelera WHERE sinopsis LIKE '%busqueda%'";
$resultados = mysqli_query($conexion, $sql);



while($fila=mysqli_fetch_array($resultados, MYSQLI_BOTH)){
echo <<<TAG
    <article class="col-sm d-flex justify-content-around">
        <div class="card text-center" style="width: 15rem">
            <img class="card-img-top" src="{$fila["imagen"]}">
            <div class="card-body">
                <h5 class="card-title">{$fila["pelicula"]}</h5>
                <h6 class="card-text">{$fila["director"]}</h6>
                <p class="card-text">{$fila["sinopsis"]}</p>
            </div>
        </div>
    </article>
    TAG;
    }



mysqli_close($conexion);
?>
</section>  
</body>
</html>