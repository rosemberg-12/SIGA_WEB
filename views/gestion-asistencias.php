<?php
/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 01/12/2016
 * Time: 04:30 AM
 */

require_once '../fachade/FachadeOne.php';

$facade = new FachadeOne();
$idActividad = 2;

?>

<html>
<head></head>
<body>

<?php echo $facade->listarAsistencias($idActividad); ?>

</body>
</html>
