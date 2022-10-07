<?php   

// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// $link = mysqli_init();
// // mysqli_ssl_set($link,NULL,NULL, "./DigiCertGlobalRootCA.crt.pem", NULL, NULL);
// mysqli_real_connect($link, "alvaserp-server.mysql.database.azure.com", "rriusxsmdm", "ErpAlvas@321", "erp_alvas", 3306, MYSQLI_CLIENT_SSL);


$link = mysqli_connect('localhost', 'sawerp_erpalvas', 'Hype#123');
  $link->query('use erpalvas');

?>
