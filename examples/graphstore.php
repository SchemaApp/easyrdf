<?php
    /**
     * Store and retrieve data from a SPARQL 1.1 Graph Store
     *
     * This example adds a triple containing the current time into
     * a local graph store. It then fetches the whole graph out
     * and displays the contents.
     *
     * Note that you will need a graph store, for example RedStore,
     * running on your local machine in order to test this example.
     *
     * @package    EasyRdf
     * @copyright  Copyright (c) 2009-2013 Nicholas J Humfrey
     * @license    http://unlicense.org/
     */

    require_once realpath(__DIR__.'/..')."/vendor/autoload.php";
?>
<html>
<head>
  <title>GraphStore example</title>
</head>
<body>

<?php
  // Use a local SPARQL 1.1 Graph Store (eg RedStore)
  $gs = new \EasyRdf\GraphStore('http://127.0.0.1:9999/blazegraph/sparql');

  // Add the current time in a graph
  $graph1 = new \EasyRdf\Graph();
  $graph1->add('http://example.com/test3', 'rdfs:label', 'Test3');
  $graph1->add('http://example.com/test3', 'dc:date', time());
  $gs->insert($graph1, 'http://examplegraph.com', 'turtle');

  // Get the graph back out of the graph store and display it
  $graph2 = $gs->get('http://examplegraph.com');
  print $graph2->dump();
?>

</body>
</html>
