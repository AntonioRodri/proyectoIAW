<?php
require_once __DIR__.'/../config/config.php';
function comprobarFoto($arrayFoto) {
    if ($arrayFoto['error'] > 0) {
        return 'sinfoto.gif';
    }else {
        return subirFichero($arrayFoto);
    }
}

/**
 * 
 * @param array $fichero -> Donde van los datos del fichero.
 * @return string -> Nombre de la imagen
 */
function subirFichero($fichero){
    $nombreOriginal = $fichero['name'];
    $nombreTemporal = $fichero['tmp_name'];
    $subido = "";
    
    if (is_uploaded_file($nombreTemporal)) {
        $nombreDirectorio = DIRIMAGEN;
        $rutaFichero = $nombreDirectorio . time() . $nombreOriginal;
        
        if (move_uploaded_file($nombreTemporal, $rutaFichero)) {
            // Creo la miniatura.
            crearthumb($rutaFichero, 100);
            $subido = time() . $nombreOriginal;
        }
    }//END if
    return $subido;
}

/**
 * Función que crea una miniatura de la imagen que le llega por parámetros.
 * 
 * @param String $pathImage -> Ruta de la imagen al que le vamos a crear la miniatura.
 * @param Integer $thumbWidth -> Ancho de la nueva miniatura a crear.
 */
function crearthumb($pathImage, $thumbWidth) {
    // Obtengo solo la imagen de la ruta y le saco su información (extensión, etc).
    $imageName = obtenerImagen($pathImage);
    $info = pathinfo($imageName);
    
    switch (strtolower($info['extension'])) {
        case "jpg":
            crearjpeg($pathImage, $thumbWidth, $imageName);
            break;
        case "png":
            crearpng($pathImage, $thumbWidth, $imageName);
            break;
        default:
            break;
    }
}//END function

/**
 * Función que le llega la ruta completa de la foto (con el nombre de la foto inclusive),
 * separo con explode() la cadena dividiendola mediante las barras (DIRECTORY_SEPARATOR)
 * y devuelvo solo la última que es el nombre de la imagen.
 * 
 * @param String $pathImage -> Ruta compreta de la foto con el nombre de la foto.
 * @return String -> Con el nombre de la foto únicamente.
 */
function obtenerImagen($pathImage){
    return end(explode(DIRECTORY_SEPARATOR, $pathImage));
}

function crearjpeg($pathImage, $thumbWidth, $imageName){
    // carga y devuelve las medidas de la imagen
    $img = imagecreatefromjpeg($pathImage);
    $width = imagesx($img);
    $height = imagesy($img);
    // calcula el nuevo tamaño que va a tener la miniatura.
    $new_width = $thumbWidth;
    $new_height = floor($height * ($thumbWidth/$width));
    // crea una nueva imagen de manera temporal con el nuevo tamaño.
    $tmp_img = imagecreatetruecolor($new_width, $new_height);
    // copia y redimensiona la nueva imagen en la temporal que hemos creado.
    imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    // Guarda la miniatura, en la ruta especificada, y le añado mini delante del nombre.
    imagejpeg($tmp_img,DIRIMAGEN.$imageName);
}

function crearpng($pathImage, $thumbWidth, $imageName){
    // carga y devuelve las medidas de la imagen
    $img = imagecreatefrompng($pathImage);
    $width = imagesx($img);
    $height = imagesy($img);
    // calcula el nuevo tamaño que va a tener la miniatura.
    $new_width = $thumbWidth;
    $new_height = floor($height * ($thumbWidth/$width));
    // crea una nueva imagen de manera temporal con el nuevo tamaño.
    $tmp_img = imagecreatetruecolor($new_width, $new_height);
    // copia y redimensiona la nueva imagen en la temporal que hemos creado.
    imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    // Guarda la miniatura, en la ruta especificada, y le añado mini delante del nombre.
    imagepng($tmp_img,DIRIMAGEN.$imageName);
}