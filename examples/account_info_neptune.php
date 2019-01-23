<?php
    /**
     * Mapping an RDF class type to a PHP Class
     *
     * This example fetches and displays artist information from the
     * BBC Music website. The artist object is an instance of the
     * Model_MusicArtist class, so it is possible to call custom PHP
     * methods on the object.
     *
     * It also demonstrates setting new namespaces.
     *
     * @package    EasyRdf
     * @copyright  Copyright (c) 2009-2013 Nicholas J Humfrey
     * @license    http://unlicense.org/
     */

    require_once realpath(__DIR__.'/..')."/vendor/autoload.php";
    require_once __DIR__."/html_tag_helpers.php";

    class Model_Organization extends \EasyRdf\Resource
    {
        public function test() 
        {
            return "test";
        }
    }

    \EasyRdf\TypeMapper::set('gist:Organization', 'Model_Organization');
?>
<html>
<head><title>EasyRdf Artist Info Example</title></head>
<body>
<h1>EasyRdf Artist Info Example</h1>

<?php
    $sparql = new \EasyRdf\Sparql\Client('http://127.0.0.1:9999/blazegraph/sparql');
    $graph = $sparql->query(
        'CONSTRUCT {<http://schemaapp.com/resources/admin/Company_AcmeDataTest> ?p ?o .}'.
        'WHERE {'.
            '<http://schemaapp.com/resources/admin/Company_AcmeDataTest> ?p ?o .'.
        '}'
    );
    $resource = $graph->resource("http://schemaapp.com/resources/admin/Company_AcmeDataTest");
    $resource->test();
?>

</body>
</html>
