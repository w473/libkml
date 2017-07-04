<?php

namespace tests\system\KML;

use KML\Hydrator\KMLBuilder;
use KML\KML;
use PHPUnit\Framework\TestCase;

class KMLTest extends TestCase
{
    const SAMPLE_TIME_KML = __DIR__ . '/../data/sample-time.kml';
    const PARSE_TEST_KML  = __DIR__ . '/../data/parse-test.kml';
    const GOOGLE_MAP_KML  = __DIR__ . '/../data/googlemap.kml';

    public function testCreateFromTextGeoJson()
    {
        $kmlData = file_get_contents(self::PARSE_TEST_KML);

        $kml = KMLBuilder::createFromText($kmlData);

        $this->assertInstanceOf(KML::class, $kml);
        $this->assertEquals(
            '{"type":"FeatureCollection","features":[{"id":"mountainpin1","properties":' .
            '{"name":"Pin on a mountaintop","styleUrl":"#pushpin","id":"mountainpin1"},"type":' .
            '"Feature","geometry":{"type":"Point","coordinates":[170.1435558771009,-43.60505741890396]}}]}',
            json_encode($kml->getGeoJson())
        );
    }

    public function testCreateFromTextJson()
    {
        $kmlData = file_get_contents(self::PARSE_TEST_KML);

        $kml = KMLBuilder::createFromText($kmlData);

        $this->assertInstanceOf(KML::class, $kml);
        $this->assertEquals(
            '{"name":"gx:AnimatedUpdate example","description":null,"folders":[{"type":"FeatureCollection"'.
            ',"features":[{"id":"mountainpin1","properties":{"name":"Pin on a mountaintop","styleUrl":"#pushpin",'.
            '"id":"mountainpin1"},"type":"Feature","geometry":{"type":"Point","coordinates":[170.1435558771009,'.
            '-43.60505741890396]}}]}]}',
            json_encode($kml)
        );
    }

    public function testCreateFromTextJsonLayers()
    {
        $kmlData = file_get_contents(self::GOOGLE_MAP_KML);

        $kml = KMLBuilder::createFromText($kmlData);

        $this->assertInstanceOf(KML::class, $kml);
        $this->assertEquals(
            '{"name":"Moja mapka","description":"opis mojej mapki","folders":[{"type":"FeatureCollection"'.
            ',"properties":{"name":"pierwsza warstwa","description":null},"features":[{"properties":{"name":'.
            '"punkt w pierwszej warsatwie","description":"opis\u00a0punkt w pierwszej warsatwie","styleUrl":'.
            '"#icon-1899-0288D1"},"type":"Feature","geometry":{"type":"Point","coordinates":[10.809989,51.7279585]}}'.
            ',{"properties":{"name":"Punkt 22","description":"pkt 12","styleUrl":"#icon-1899-0288D1"},"type":'.
            '"Feature","geometry":{"type":"Point","coordinates":[10.8081222,51.7283971]}}]},{"type":"FeatureCol'.
            'lection","properties":{"name":"Druga warstwa","description":null},"features":[{"properties":{"name"'.
            ':"punkt w drugiej warsatwie","description":"punkt w drugiej warsatwie","styleUrl":"#icon-1899-0288D'.
            '1"},"type":"Feature","geometry":{"type":"Point","coordinates":[10.8094686,51.7276063]}},{"propertie'.
            's":{"name":"Punkt 2","description":"pkt2","styleUrl":"#icon-1899-0288D1"},"type":"Feature","geometr'.
            'y":{"type":"Point","coordinates":[10.8089751,51.7282742]}}]}]}',
            json_encode($kml)
        );
    }

    public function testKmlParsing()
    {
        // Checking if the document was correctly parsed.
        $kmlData = file_get_contents(self::SAMPLE_TIME_KML);
        $kml = KMLBuilder::createFromText($kmlData);
        $features = $kml->getAllFeatures();
        $this->assertNotEmpty($kml);
        $folder = $kml->getFeature();
        $this->assertNotEmpty($folder);
        $document = $folder->getFeatures()[0];
        $this->assertNotEmpty($folder);
        $placemarks = $document->getFeatures();
        $this->assertNotEmpty($placemarks);

        // Checking if the TimeStamp and TimeSpan are converted to xml correctly.
        foreach (['TimeStamp', 'TimeSpan'] as $i => $tag) {
            $str = $placemarks[$i]->__toString();
            $this->assertRegExp("/$tag/", $str);
        }
    }
}
