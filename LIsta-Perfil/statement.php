<?php
$cancion_statement = "SELECT * FROM canciones WHERE canciones.id = $1;";  #Este query selecciona todos los atributos de determinada cancion cuyo id es igual a $1
$canciones_statement = "SELECT * FROM canciones;"; #Selecciona todas las canciones
$canciones = pg_query_params($dbconn, $canciones_statement, array()); #result 
$albums_statement = 'SELECT nombre from album   
        INNER JOIN album_tiene_cancion
        ON album.id = album_tiene_cancion.id_album
        WHERE id_cancion = $1';      #Este query selecciona todos los albums de determinada cancion...
$artistas_statement = 'SELECT nombre_artistico FROM artistas
        INNER JOIN artista_compuso_cancion
        ON artistas.id = artista_compuso_cancion.id_artista
        WHERE id_cancion = $1;'; #Este query selecciona todos los artistas de determinada cancion...

?>