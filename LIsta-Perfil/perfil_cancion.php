
<?php include '../validar_sesión.php';
if($_SESSION["EsArtista"]){
    header("Location: http://localhost/index.html");
    exit("Credenciales Incorrectas");
}?>

<?php include $_SERVER['DOCUMENT_ROOT'].'/db_config.php'; ?>
<?php include 'statement.php'; ?> 

<head> <link rel="stylesheet" href="../style/style2.css"> </head>
<?php include '../include/navbar.html'; ?>

<?php $id_cancion = $_GET['id_cancion'];  
 ?> <!-- Guardamos el id de la cancion que enviamos en lista.php  -->

<?php $result_cancion = pg_query_params($dbconn, $cancion_statement, array($id_cancion)); 
$cancion =pg_fetch_object($result_cancion);
?> <!-- Se almacena la cancion y la letra del la respectiva cancion que corresponde al id obtenido -->
<div class = 'div-center'> 
   
<h3> <center> Nombre de la cancion: </center>  </h3>
<p> <center> <?php echo $cancion->nombre; ?> </center>  </p>

<h3> <center> Artistas: </center>  </h3>
<?php  $artistas = pg_query_params($dbconn, $artistas_statement, array($id_cancion)); ?> <!-- Se emplea el metodo para los artistas que se uso en lista.php -->
<p> <center> <?php while($obj2=pg_fetch_object($artistas)){
                echo $obj2->nombre_artistico;
                echo ', '; } ?> </center> </p>

<h3> <center>  Albums: </center> </h3>
<?php  $albums = pg_query_params($dbconn, $albums_statement, array($id_cancion)); ?> <!-- Lo mismo para los albums -->
<p > <center>  <?php while($obj3=pg_fetch_object($albums)){
                echo $obj3->nombre;
                echo ', '; } ?> </center>  </p>
                
<h3> <center>  Letra: </center>  </h3>
<p> <center> <?php echo $cancion->letra;  ?> </center>  </p> <!-- Se accede a la letra de la cancion y se printea -->
</div>                        
</body>
</html>
