
<?php include $_SERVER['DOCUMENT_ROOT'].'/db_config.php'; ?>
<?php  include 'statement.php'; ?> 

<head> <link rel="stylesheet" href="../style/style2.css"> </head>
<?php include '../include/navbar.html'; ?>
<div class='div-center2'>       
<table border='3' class = 'center'>   <!--En esta parte se crea la tabla, de las canciones -->
        
        <thead>
                <tr>
                        <th>Songs's name</th>
                        <th>Artist's name</th>
                        <th>Album's name</th>
                        
                </tr>
        </thead>
        <tbody>
                
                <?php
                while($obj=pg_fetch_object($canciones)){ ?>   <!-- Aca se itera sobre todas las canciones para ir "printeandolas" por fila-->
                        <tr>   

                        
                        <td><?php echo $obj->nombre;?></td>   <!--Se accede al nombre de la cancion -->



                        <?php
                        $artistas = pg_query_params($dbconn, $artistas_statement, array($obj->id)); ?> <!-- Aca se accede a los artistas de la cancion, contenidos en una tabla
                        asociada a la cancion (Para cada cancion se crea una tabla con sus artistas, esto se hizo debido a la complicacion de hacer una query que mostrara todos
                        los artistas en una sola fila por cancion junto a sus demas atributos, ya que el artista de una cancion no es unico.)  -->
                          
                        <td> <?php while($obj2=pg_fetch_object($artistas)){ 
                                echo $obj2->nombre_artistico;
                                echo ', ';
                        } ?> </td> <!-- Se printean los artistas  -->



                        <?php $albums = pg_query_params($dbconn, $albums_statement, array($obj->id)); ?>
                        <td> <?php while($obj3=pg_fetch_object($albums)){
                                echo $obj3->nombre;
                                echo ', ';
                        } ?> </td> <!-- Se hace lo mismo que se hizo arriba, pero con los albums -->


                        <td> <a href="perfil_cancion.php?id_cancion= <?php echo $obj->id; ?>">More info</a> </td> <!-- Se crea el botom que envia el id de la cancion
                        a la vista perfil_artista -->
                        
                                         
                        
                        
                        
                
                        </tr>                
                <?php  } ?>
                
        </tbody>
</table>
</div>  
</body>
</html>
