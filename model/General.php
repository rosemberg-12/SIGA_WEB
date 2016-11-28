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