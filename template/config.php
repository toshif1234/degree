<?php   
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// $link = mysqli_init();
// // mysqli_ssl_set($link,NULL,NULL, "./DigiCertGlobalRootCA.crt.pem", NULL, NULL);
// mysqli_real_connect($link, "alvaserp-server.mysql.database.azure.com", "rriusxsmdm", "ErpAlvas@321", "erp_alvas", 3306, MYSQLI_CLIENT_SSL);


//  $link = mysqli_connect('localhost', 'root', '', 'erpalvas');

// $link = mysqli_connect('localhost', 'root', '', 'erpalvasdev');
  $link = mysqli_connect('saw-erp.in', 'degree_alvasdegree', 'Hype#123', 'erpdegree');
  // $link = mysqli_connect('localhost', 'devuser_erpalvasdev', 'Hype#123');
  // $link->query('use erpalvasdev');
?>
