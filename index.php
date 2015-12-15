<?php 

$source_path = $_SERVER["DOCUMENT_ROOT"].'/source';

if(isset($_GET["name"])){
	$filename = $_GET["name"];
	$filename = $source_path.'/'.$filename.'.php';
	if(file_exists($filename)){
		$text= file_get_contents($filename);
		$fp = fopen($_SERVER["DOCUMENT_ROOT"].'/temp.txt', 'w');
		fwrite($fp, $text);
		fclose($fp);
		echo "1";	
	}else{
		throw new Exception('there is no such php file');
	}
}

if(isset($_GET["path"])){
	$filepath = $_GET["path"];
	if($filepath=="root"){
		showFileList($source_path);
	}else{
		$filepath=$source_path."/".$filepath;
		if(is_dir($filepath)){
			showFileList($filepath);
		}else{
			throw new Exception("there is no such directory");
		}	
	}
	
}

function showFileList($path){
	$files =scandir($path);
	echo json_encode($files);
}

?>