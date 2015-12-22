<?php 

$source_path = $_SERVER["DOCUMENT_ROOT"].'/source';

if(isset($_GET["path"])){
	$path = $_GET["path"];
	$filepath = $_GET["path"];
	if($filepath=="root"){
		$filepath =$source_path;
	}else{
		$filepath=$source_path."/".$filepath;
	}
	
	if(is_dir($filepath)){
		showFileList($filepath);
	}else{
		if(file_exists($filepath)){
			$text= file_get_contents($filepath);
			//$fp = fopen($_SERVER["DOCUMENT_ROOT"].'/temp.txt', 'w');
			//fwrite($fp, $text);
			//fclose($fp);
			echo "<code>";
			echo $text;
			echo "</code>";
			//echo $path;	
		}else{
			throw new Exception('there is no such file/directory');
		}	
	}	
	
}

function showFileList($path){
	$files =scandir($path);
	echo json_encode($files);
}

?>