<?php
require_once __DIR__ . '/../vendor/autoload.php';

$kml = \KML\Hydrator\KMLBuilder::createFromFile($argv[1]);
echo json_encode($kml);