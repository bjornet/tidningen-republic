<?php
// Get Variables
$dbname = '';
$dbusername = '';
$dbpass = '';
$dbhost = '';

$insertKeys = '';
$insertVals = '';
$countTot = count($_POST);
$count = 0;

foreach ($_POST as $key => $value) {
	$count++;
	$insertKeys .= $count < $countTot ? $key . ", " : $key;
	# LYBE: Björn [Clean value from whitespace if INT] 
	if ($key === 'phone' || $key === 'zip') {
		$value = str_replace(' ', '', $value);
	}

	$insertVals .= $count < $countTot ? "'{$value}'" . ", " : "'{$value}'";

}

$connection = mysql_connect("$dbhost", "$dbusername", "$dbpass");
if (!$connection) {
    die('Could not connect: ' . mysql_error());
} else {
    $dbcheck = mysql_select_db("$dbname");
    if (!$dbcheck) {
        echo mysql_error();
    } else {
		$sql = "INSERT INTO {$dbname}.try_issue ({$insertKeys}) VALUES ($insertVals)";
		mysql_query("SET NAMES utf8");
        $result = mysql_query($sql);
		echo true;
    }
}
// some code. no need to close mysql and no need to close php
?>