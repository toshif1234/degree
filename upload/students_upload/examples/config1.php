<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$link = mysqli_init();
// mysqli_ssl_set($link,NULL,NULL, "./DigiCertGlobalRootCA.crt.pem", NULL, NULL);
// mysqli_real_connect($link, "alvaserp-server.mysql.database.azure.com", "rriusxsmdm", "ErpAlvas@321", "erp_alvas", 3306, MYSQLI_CLIENT_SSL);
include("../../../config.php");
$con=$link;
// Check connection
if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>