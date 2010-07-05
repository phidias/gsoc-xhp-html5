<?php
require_once '../php-lib/init.php';

function getValue($keyword, $content) {
	$r = preg_match("/".$keyword.":\s*(.+)\n/",$content,$matches);
	return $r ? $matches[1] : "";
}

echo <<<EOL
<style>table td { padding: 5px; border: 1px solid black }
table { border-collapse: collapse; }
</style>
EOL;

$newElementsTable = <table/>;

$files = scandir("elements");
$newElementsTable->appendChild(<thead>
	<tr>
		<td>Element</td>
		<td>Demo</td>
		<td>Visual?</td>
		<td>Firefox</td>
		<td>Chrome</td>
		<td>Opera</td>
		<td>IE</td>
		<td>simulated in XHP?</td>
	</tr>
	</thead>);
foreach ($files as $file) {
	$parts = explode(".",$file);
	$extension = end($parts);
    $element = prev($parts);

	if ($extension == "php") {
		$content = file_get_contents('elements/'.$file); 
		$visible = getValue("VISUAL",$content);
		$chrome = getValue("CHROME",$content);
		$xhp = getValue("XHP",$content);
		$showURL = "show.php?el=$element";
		$newElementsTable->appendChild(
			<tr>
				<td>&lt;{$element}&gt;</td>
				<td><a href={$showURL}>show</a></td>
				<td>{$visible}</td>
				<td>{$firefox}</td>
				<td>{$chrome}</td>
				<td>{$opera}</td>
				<td>{$ie}</td>
				<td>{$xhp}</td>
			</tr>);
	}
}

?>

<h1>HTML5 support in XHP</h1>

<h2>New Elements</h2>

<?= $newElementsTable ?>

<h2>New attributes</h2>

<p>no demos yet</p>

<h2>Spec</h2>

<a href="spec/HTML5 differences from HTML4.html">link</a>