<?php
/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 30/11/2016
 * Time: 08:30 PM
 */
require_once '../fachade/FachadeOne.php';

$facade = new FachadeOne();
$idUnidad = 2;

?>

<html>
<head></head>
<body>

<?php echo $facade->listarActividades($idUnidad); ?>

</body>
</html>
