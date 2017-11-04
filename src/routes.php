<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/api/v1/sale/[{ruc}]', function (Request $request, Response $response, array $args) {
    //$ruc = $args['ruc'];

    /**@var $parser \Greenter\Parser\DocumentParserInterface */
    $parser = $this->get('parser.invoice');
    /**@var $serializer \Symfony\Component\Serializer\Serializer */
    $serializer = $this->get('serializer');
    $files = glob($this->get('dir_xml') . '*.xml');
    $documents = [];
    foreach ($files as $file) {
        if($file == '.' || $file == '..') continue;

        $document = $parser->parse(file_get_contents($file));
        $documents[] = $document;
    }

    $json = $serializer->serialize($documents, 'json');
    $response->getBody()->write($json);

    return $response->withHeader('Content-Type', 'application/json; charset=utf8');
});
