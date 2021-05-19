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
<section class="row">
<?php

    require("datos_conexion.php");

    //conectar con la base de datos mysql
    $conexion = mysqli_connect($servidor, $usuario, $password, $nameDatabase);
    

    if(mysqli_connect_errno()){
        echo "Fallo al conectar con la BBDD";
        exit();
    }
    
    $sql = "SELECT * FROM cartelera";
    $resultados = mysqli_query($conexion, $sql);
    

    /*$registros=1;
    while($registros<=4){
        $fila = mysqli_fetch_row($resultados);
    
    echo $fila[1] . " ";
    echo $fila[2] . " ";
    echo $fila[3] . " ";
    echo $fila[4] . " ";
    echo "<br>";

    $registros++;
    }*/
    
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

    
    if(isset($_POST['guardar'])){
        $sql2="INSERT INTO cartelera (pelicula, imagen, director, sinopsis)
        VALUES ('".$_POST["pelicula"]."', '".$_POST["imagen"]."', '".$_POST["director"]."', '".$_POST["sinopsis"]."')";
        $resultados2 = mysqli_query($conexion, $sql2);
    }
        

mysqli_close($conexion);


if (isset($_GET['delete'])){
    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM cartelera WHERE id=$id") or die($mysqli->error);

    header("location: index.php");
}
?>


<form action="index.php" method="post">
            <label id="pelicula"> Nombre película: </label><br/>
            <input type="text" name="pelicula"><br/>

            <label id="imagen"> Imagen URL: </label><br/>
            <input type="text" name="imagen"><br/>

            <label id="director"> Director: </label><br/>
            <input type="text" name="director"><br/>

            <label id="sinopsis"> Sinopsis: </label><br/>
            <input type="text" name="sinopsis"><br/>

            <button type="submit" name="guardar">Guardar</button>
            <button type="submit" name="borrar">Borrar</button>
        </form>
    

</section>    
</body>
</html>