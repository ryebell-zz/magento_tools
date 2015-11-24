<?php

require_once ("./app/Mage.php");
$app = Mage::app('default');

$config  = Mage::getConfig()->getResourceConnectionConfig("default_setup");

$dbinfo = array(“host” => $config->host,
            “user” => $config->username,
            “pass” => $config->password,
            “dbname” => $config->dbname
);

$hostname = $dbinfo[“host”];
$user = $dbinfo[“user”];
$password = $dbinfo[“pass”];
$db_name = $dbinfo[“dbname”];

try {
    $dsn = "mysql:
        host=$hostname;
        dbname=$db_name";
    $username = "$user";
    $password = "$password";
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );
    $db = new PDO($dsn, $username, $password, $options);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}   catch(Exception $e){
        echo $e->getMessage();
        die();
}

$data = $db->query('SELECT * FROM cron_schedule');

$result = $data->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $row) {
	echo $row['schedule_id'] . " " . $row['job_code'] . " " . $row['status'] . " " . $row['messages'] . " " . $row['created_at'] . " " . $row['scheduled_at'] . " " . $row['executed_at'] . " " . $row['finished_at'] . "<br>";

}

?>
