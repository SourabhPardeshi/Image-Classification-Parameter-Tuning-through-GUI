<?php 

//$x=getcwd();
//echo $x;

if(isset($_GET['dir'])){
	$dir=$_GET['dir'];

$command = escapeshellcmd("python test.py $dir");

$output = shell_exec($command);
echo "Predictions are done";

}
?>