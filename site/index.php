<?php
require_once '../php-lib/init.php';

function getValue($keyword, $file) {
	$content = file_get_contents('elements/'.$file);
	$r = preg_match("/".$keyword.":\s*(\w+)/",$content,$matches);
	return $r ? $matches[1] : "";
}

$newElementsTable = <table />;

$files = scandir("elements");
$newElementsTable->appendChild(<thead><tr><td>Element</td><td>Demo</td><td>Visible?</td></tr></thead>);
foreach ($files as $file) {
	$parts = explode(".",$file);
	$extension = end($parts);
    $element = prev($parts);

	if ($extension == "php") {
		$visible = getValue("VISIBLE",$file);
		$showURL = "show.php?el=$element";
		$newElementsTable->appendChild(<tr><td>&lt;{$element}&gt;</td><td><a href={$showURL}>show</a></td><td>{$visible}</td></tr>);
	}
}

?>

<h1>HTML5 support in XHP</h1>

<h2>New Elements</h2>

<?= $newElementsTable ?>

<h2>New attributes</h2>

<p>no demos yet</p>
