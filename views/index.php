<?php
/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 27/11/2016
 * Time: 10:37 PM
 */

$path = "../";
include_once ($path.'fachade/FachadeReportes.php');
$fachadaRepo = new FachadeReportes();
?>
<html>
<head></head>
<body>
<h1 style="text-align: center">GESTION BIENESTAR UNIVERSITARIO</h1>

<?php echo $fachadaRepo->listarDivisiones($path); ?>

</body>
</html>

