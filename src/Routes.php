<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig', []);
});
$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    switch ($code) {
        case 404:
            $message = $app['twig']->render('error404.html.twig');
            break;
        default:
            $message = 'We are sorry, but something went terribly wrong.';
    }

    if ($app['debug']) {
        $message .= ' Error Message: ' . $e->getMessage();
    }

    return new Response($message, $code);
});

return $app;
