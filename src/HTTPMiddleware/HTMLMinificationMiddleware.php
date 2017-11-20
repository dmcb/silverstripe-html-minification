<?php

use SilverStripe\Control\Middleware\HTTPMiddleware;
use SilverStripe\Control\HTTPRequest;
use voku\helper\HtmlMin;

class HTMLMinificationMiddleware implements HTTPMiddleware {

    public function process(HTTPRequest $request, callable $delegate)
    {
        $response = $delegate($request);
        $body = $response->getBody();

        $htmlMin = new HtmlMin();
        $minifiedBody = $htmlMin->minify($body);

        $response->setBody($minifiedBody);

        return $response;
    }
}
