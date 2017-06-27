<?php
use foundationphp\UploadFile;

$max = 50 * 1024; //x * 1kb
$result = array();
if (isset($_POST['upload'])){
	require_once 'src/foundationphp/UploadFile.php';
	$destination = __DIR__ . '/uploaded/'; //create directory in same level as this script. Must be fully qualified
	try {
		$upload = new UploadFile($destination);
		$upload->setMaxSize($max);
		$upload->upload();
		$result = $upload->getMessages();
	} catch (Exception $e){
		$$result[] = $e->getMessage();
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>File Uploads</title>
	<meta charset="utf-8">

</head>
<body>
	<h1>Uploading Files</h1>
	<?php
		if($result){ ?>
			<ul class="reuslt">
				<?php
				foreach($result as $message){
					echo "<li>$message</li>";
				}
				?>
			</ul>
		<?php } ?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
		<p>
			<input type="hidden" name="MAX_FILE_SIZE" vale="<?php echo $max; ?>">
		</p>
		<p>
			<label for="filename">Select File:</label>
			<input type="file" name="filename" id='label'>
		</p>
		<p>
			<input type="submit" name="upload" value="Upload File">
		</p>
	</form>
</body>
</html>