<?php
if ($_POST) {
	$filename = $_POST["filename"] ?? "";
	$text = $_POST["text"] ?? "";
	
	if ($filename and $text) {
		file_put_contents($filename, $text);
	}
} else {
	$_get_file = $_GET["file"] ?? "";
	if ($_get_file == "index") {
		$files = array_merge(glob("*.txt"), glob("*.md"));
		natsort($files);
		foreach ($files as $file) {
			$text = file_get_contents($file);
			preg_match_all("/\w+/", $text, $matches);
			$word_count = count($matches[0]);
			$byte_count = strlen($text);
			echo "* <a href='javascript:load_page(\"$file\")'>$file</a> ($word_count W, $byte_count B)<br>";
		}
	} else {
		echo nl2br(htmlspecialchars(file_get_contents($_get_file)));
	}
}
?>
