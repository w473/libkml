<?php
require_once __DIR__ . '/../vendor/autoload.php';

$fileContents = file_get_contents($argv[1]);
$kml = KML\KML::createFromText($fileContents);
echo json_encode($kml);