<?php 

function getTitleInHTML(string $source){
	// @source = "http://livrodigital/unef/ambientes-virtuais-de-aprendizagem-ava-e1002eaf8.html";

	$file = file_get_contents($source);

	$fileHTML = new DOMDocument();

	libxml_use_internal_errors(true);
	$fileHTML->loadHTML($file);
	libxml_clear_errors();

	return $fileHTML->getElementsByTagName('title')[0]->nodeValue;
}

function loadBooksList(string $path) {
	// @path = "http://livrodigital/unef/";

	$result = array();
	$path = str_replace('//', '/', $path);
	$path = str_replace(':/', '://', $path);

	foreach (scandir(getcwd()) as $current_item) {

		if (strstr($current_item, '.html')) {
			$source = $path.$current_item;
			$name = getTitleInHTML($source);

			$result[] = array('source' => $source, 'name' => $name);
		}
	}

	return $result;
}
// $path = $_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI'];
$path = 'http://livrodigital/unef/';
$book_list = loadBooksList($path);
?>

<!DOCTYPE html>
	<html>
		<head>
			<title></title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		</head>
	<body>


		<div class="container mt-5 mb-5">

			<ul class="list-group">
				<?php foreach ($book_list as $book_item) { ?>
				<li class="list-group-item"><a href="<?php echo $book_item['source']; ?>"><?php echo $book_item['name']; ?></a></li>
				<?php } ?>
			</ul>
		</div>

		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>
</html>
