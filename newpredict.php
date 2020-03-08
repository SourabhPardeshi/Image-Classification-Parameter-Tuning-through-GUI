<?php 
session_start();

if(isset($_GET['dir'])){
	$dir=$_GET['dir'];

$command = escapeshellcmd("python classify_model.py $dir");

$output = shell_exec($command);
#echo $output;
#exec($command, $out, $status);	

}

/*$myfile = fopen("reading.txt", "r") or die("Unable to open file!");
echo fread($myfile,filesize("reading.txt"));
fclose($myfile);
*/


$cdir=getcwd();
#echo $cdir;
$image_arr =[];
$label_arr=[];
$imagefile=fopen($cdir."\\image.txt","r") or die("Unable to open file");
$labelfile=fopen($cdir."\\label.txt","r") or die("Unable to open file");
while (!feof($imagefile)) {
	$iname=fgets($imagefile);
	$ilabel = fgets($labelfile);
	$temp1="pictures\\pictures\\".$iname;
	#echo $temp1;
	#$image_arr.append($temp1);
	array_push($image_arr, $temp1);
	array_push($label_arr, $ilabel	);	
	#$label_arr.append($ilabel);

}
#print_r($image_arr);
#print_r($label_arr);
$c=count($image_arr);
/*
foreach(scandir($dir) as $file) {
       if($file=="reading.txt"){
       	$myfile = fopen($file, "r") or die("Unable to open file!");
		while(!feof($myfile)){
			$line=fgets($myfile);
			echo $line[0];
		}

		#echo fread($myfile,filesize($file));
		fclose($myfile);
       }
}
       #echo $file." ";}
       */

$current_img = 0;
$current_img =$_SESSION['cur_img'];
$tofile_img=[];
$tofile_label=[];
		$myfile1 = fopen("confidence.txt", "r") or die("Unable to open file!");

		$confi_arr=[];
			while(!feof($myfile1)){
			$line=fgets($myfile1);
			array_push($confi_arr,$line);	
	}
if(isset($_POST['submit'])){
	if ($_SESSION['cur_img'] <= $c-3) {
		$lab=$_POST['changelabel'];
		$fp1 = fopen('update_label.txt', 'a');
		$fp2 = fopen('update_img.txt', 'a');//opens file in append mode  
		fwrite($fp2,$image_arr[$_SESSION['cur_img']]); 
		fwrite($fp1, $lab."\n"); 
		fclose($fp1);
		fclose($fp2);  
		$te = $_SESSION['cur_img']+1;
		echo $te." ";
		echo $c-1;

	}
	else{
		echo "<div class=\"uploadform\"><h3>Done Printing and Predicting</h3></div>";
		$command = escapeshellcmd("python retrain.py");

$output_retrain = shell_exec($command);
echo "<div class=\"uploadform\"><h3>".$output_retrain."</h3></div>";

	}

	$current_img +=1;
	$_SESSION['cur_img']=$current_img;	
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Predicted Images</title>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
		<!--
		<?php for($i=0;$i<$c;$i++){ ?>
			<img src="<?php echo $image_arr[$i] ?>">
			<br>
			<b>Predicted label</b>: 
			<?php echo $label_arr[$i];?><br>
			<b>change label:</b> 
			<input type="text" name="changelabel">
			<br>

		<?php }?>
		-->
		<div class="uploadform">
			
		
		<form method="POST" >
	<?php 	if ($_SESSION['cur_img'] <= $c-2) { ?>
			<div class="content">
				
			<center>
			<img src="<?php echo $image_arr[$current_img] ?>" height="200px" width="250px">
			<br>
			<b>Predicted label</b>: 
			<?php echo $label_arr[$current_img];?><br>
			<br>
			<b>change label:</b> 
			<input type="text" name="changelabel" value="<?php echo $label_arr[$current_img]; ?>">
			<br><br>
			<?php echo "confidence :".$confi_arr[$current_img] ?>
			<br><br>
			<input type="submit" name="submit" value="change" class="btn btn-success">
			
		<?php }?>
		</center>
		</div>
		
		</form>
		</div>
</body>
</html>