<?php
require_once '../php-lib/init.php';
$newElementsTable = <table />;

$files = scandir("elements");

foreach ($files as $file) {
	$parts = explode(".",$file);
	$extension = end($parts);
    $element = prev($parts);
	if ($extension == "php") {
		$newElementsTable->appendChild(<tr><td>&lt;{$element}&gt;</td><td><a href="show.php?el=figure">show</a></td></tr>);
	}
}

?>

<h1>HTML5 support in XHP</h1>

<h2>New Elements</h2>

<?= $newElementsTable ?>

<h2>New attributes</h2>
