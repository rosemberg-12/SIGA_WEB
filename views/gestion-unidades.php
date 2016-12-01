<?php
/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 30/11/2016
 * Time: 08:30 PM
 */

require_once '../fachade/FachadeOne.php';

$facade = new FachadeOne();
$idDivision = 0;

?>

<html>
<head></head>
<body>

<?php echo $facade->listarUnidades($idDivision); ?>

</body>
</html>
