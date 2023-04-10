<?php

$domDoc = null;
$domBody = null;

fetchDocument('https://example.org', $domDoc, $domBody);

$internalContentNode =
   findNodeByTagName($domBody->childNodes, 'div');

$internalContent = $domDoc->saveHTML($internalContentNode);

require('views/default.php');

?>
