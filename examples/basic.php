<?php
    /**
     * Basic "Hello World" type example
     *
     * @package    EasyRdf
     * @copyright  Copyright (c) 2009-2011 Nicholas J Humfrey
     * @license    http://unlicense.org/
     */

    set_include_path(get_include_path() . PATH_SEPARATOR . '../lib/');
    require_once "EasyRdf.php";
?>
<html>
<head>
  <title>Basic FOAF example</title>
</head>
<body>

<?php
  $foaf = new EasyRdf_Graph("http://www.aelius.com/njh/foaf.rdf");
  $foaf->load();
  $me = $foaf->primaryTopic();
?>

<p>
  My name is: <?= $me->get('foaf:name') ?>
</p>

</body>
</html>
