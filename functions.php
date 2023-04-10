<?php

function fetchDocument(
    string $url,
    &$outDocument,
    &$outDocumentBody
)
{
    $hCurl = curl_init($url);

    if ($hCurl === false)
    {
        die('Failed to init cURL handle.');
    }

    curl_setopt($hCurl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($hCurl);

    if ($result === false)
    {
        die('cURL request failed for some reason.');
    }

    // Parse as DOM
    //
    $domDoc = new DOMDocument();

    $domDoc->loadHTML($result);

    $outDocument     = $domDoc;
    $outDocumentBody = $domDoc->getElementsByTagName('body')[0];
}

function findNodeByTagName(
    DOMNodeList $nodeList,
    string      $tagName
)
{
    foreach ($nodeList as $node)
    {
        if (strtolower($tagName) === strtolower($node->nodeName))
        {
            return $node;
        }
    }

    return null;
}
?>
