<?php
/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 27/11/2016
 * Time: 10:52 PM
 */


/**
 * Metodo para encriptar un dato
 * @param $cadena valor a encriptar
 * @return string valor encriptado
 */
function encriptar($cadena){
    $key='fbAsCM47895FPRnh@!sdjf';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
    return $encrypted; //Devuelve el string encriptado

}

/**
 * Metodo para desencriptar un dato
 * @param $cadena encriptada
 * @return string valor original
 */
function desencriptar($cadena){
    $key='fbAsCM47895FPRnh@!sdjf';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
    $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
    return $decrypted;  //Devuelve el string desencriptado
}


/**
 * Metodo para obtener el nombre de la carrera a apartir del codigo del beneficiario
 * @param $codigo codigo del beneficiario
 * @return mixed nombre de la carrera
 */
function getNombreCarrera($codigo){
    if(strlen($codigo)>3){
        $codigo = substr($codigo,3);
    }

    $listaCarrerras = array('121'=>'ADMINISTRACION DE EMPRESAS DIURNO',
        '125'=>'ADMINISTRACION DE EMPRESAS NOCTURNO',
        '079'=>'ADMINISTRACION DE LOS SERVICIOS DE LA SALUD',
        '3'=>'ADMINISTRATIVO',
        '150'=>'ARQUITECTURA',
        '126'=>'COMERCIO INTERNACIONAL',
        '133'=>'COMUNICACION SOCIAL',
        '122'=>'CONTADURIA PUBLICA DIURNA',
        '123'=>'CONTADURIA PUBLICA DIURNA',
        '135'=>'DERECHO',
        '2'=>'DOCENTE',
        '180'=>'ENFERMERIA',
        '164'=>'INGENIERIA AGROINDUSTRIAL',
        '162'=>'INGENIERIA AGRONOMICA',
        '165'=>'INGENIERIA AMBIENTAL',
        '161'=>'INGENIERIA BIOTECNOLOGICA',
        '111'=>'INGENIERIA CIVIL',
        '118'=>'INGENIERIA DE MINAS',
        '015'=>'INGENIERIA DE SISTEMAS',
        '115'=>'INGENIERIA DE SISTEMAS',
        '109'=>'INGENIERIA ELECTROMECANICA',
        '116'=>'INGENIERIA ELECTRONICA',
        '119'=>'INGENIERIA INDUSTRIAL',
        '112'=>'INGENIERIA MECANICA',
        '146'=>'TECNOLOGIA COMERCIAL Y FINANCIERA',
        '046'=>'TECNOLOGIA COMERCIAL Y FINANCIERA',
        '163'=>'INGENIERIA PECUARIA',
        '070'=>'LICENCIATURA EN INFORMATICA',
        '136'=>'LICENCIATURA EN MATEMATICAS',
        '148'=>'TECNOLOGIA EN REGENCIA EN FARMACIA',
        '192'=>'TECNOLOGIA EN OBRAS CIVILES',
        '134'=>'TRABAJO SOCIAL',
        '198'=>'TECNOLOGIA EN PROCESOS INDUSTRIALES');


    foreach($listaCarrerras as $carrera=>$valor){
        if($carrera == $codigo){
            return $valor;
        }
    }
}

?>
