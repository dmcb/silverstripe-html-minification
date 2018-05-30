<?php

namespace dmcb\HTMLMinification\Extensions;

use SilverStripe\Control\HTTPRequest;
use SilverStripe\Core\Extension;
use SilverStripe\Core\Config\Config;
use voku\helper\HtmlMin;

class HTMLMinificationExtension extends Extension
{
    /**
     * Optimize html via "HtmlDomParser()"
     * Set this via config.yml
     * @var bool
     */
    private static $doOptimizeViaHtmlDomParser = true;

    /**
     * Remove default HTML comments (depends on "doOptimizeViaHtmlDomParser(true)")
     * Set this via config.yml
     * @var bool
     */
    private static $doRemoveComments = true;

    /**
     * Sum-up extra whitespace from the Dom (depends on "doOptimizeViaHtmlDomParser(true)")
     * Set this via config.yml
     * @var bool
     */
    private static $doSumUpWhitespace = true;

    /**
     * Remove whitespace around tags (depends on "doOptimizeViaHtmlDomParser(true)")
     * Set this via config.yml
     * @var bool
     */
    private static $doRemoveWhitespaceAroundTags = true;

    /**
     * Optimize html attributes (depends on "doOptimizeViaHtmlDomParser(true)")
     * Set this via config.yml
     * @var bool
     */
    private static $doOptimizeAttributes = true;

    /**
     * Remove optional "http:"-prefix from attributes (depends on "doOptimizeAttributes(true)")
     * Set this via config.yml
     * @var bool
     */
    private static $doRemoveHttpPrefixFromAttributes = true;

    /**
     * Remove defaults (depends on "doOptimizeAttributes(true)" | disabled by default)
     * Set this via config.yml
     * @var bool
     */
    private static $doRemoveDefaultAttributes = true;

    /**
     * Remove deprecated anchor-jump (depends on "doOptimizeAttributes(true)")
     * Set this via config.yml
     * @var bool
     */
    private static $doRemoveDeprecatedAnchorName = true;

    /**
     * Remove deprecated charset-attribute - the browser will use the charset from the HTTP-Header, anyway (depends on "doOptimizeAttributes(true)")
     * Set this via config.yml
     * @var bool
     */
    private static $doRemoveDeprecatedScriptCharsetAttribute = true;

    /**
     * Remove deprecated script-mime-types (depends on "doOptimizeAttributes(true)")
     * Set this via config.yml
     * @var bool
     */
    private static $doRemoveDeprecatedTypeFromScriptTag = true;

    /**
     * Remove "type=text/css" for css links (depends on "doOptimizeAttributes(true)")
     * Set this via config.yml
     * @var bool
     */
    private static $doRemoveDeprecatedTypeFromStylesheetLink = true;

    /**
     * Remove some empty attributes (depends on "doOptimizeAttributes(true)")
     * Set this via config.yml
     * @var bool
     */
    private static $doRemoveEmptyAttributes = true;

    /**
     * Remove 'value=""' from empty <input> (depends on "doOptimizeAttributes(true)")
     * Set this via config.yml
     * @var bool
     */
    private static $doRemoveValueFromEmptyInput = true;

    /**
     * Sort css-class-names, for better gzip results (depends on "doOptimizeAttributes(true)")
     * Set this via config.yml
     * @var bool
     */
    private static $doSortCssClassNames = true;

    /**
     * Sort html-attributes, for better gzip results (depends on "doOptimizeAttributes(true)")
     * Set this via config.yml
     * @var bool
     */
    private static $doSortHtmlAttributes = true;

    /**
     * Remove more (aggressive) spaces in the dom (disabled by default)
     * Set this via config.yml
     * @var bool
     */
    private static $doRemoveSpacesBetweenTags = true;

    public function index() {
        $htmlMin = new HtmlMin();

        $htmlMin->doOptimizeViaHtmlDomParser(Config::inst()->get('dmcb\HTMLMinification\Extensions\HTMLMinificationExtension', 'doOptimizeViaHtmlDomParser'));
        $htmlMin->doRemoveComments(Config::inst()->get('dmcb\HTMLMinification\Extensions\HTMLMinificationExtension', 'doRemoveComments'));
        $htmlMin->doSumUpWhitespace(Config::inst()->get('dmcb\HTMLMinification\Extensions\HTMLMinificationExtension', 'doSumUpWhitespace'));
        $htmlMin->doRemoveWhitespaceAroundTags(Config::inst()->get('dmcb\HTMLMinification\Extensions\HTMLMinificationExtension', 'doRemoveWhitespaceAroundTags'));
        $htmlMin->doOptimizeAttributes(Config::inst()->get('dmcb\HTMLMinification\Extensions\HTMLMinificationExtension', 'doOptimizeAttributes'));
        $htmlMin->doRemoveHttpPrefixFromAttributes(Config::inst()->get('dmcb\HTMLMinification\Extensions\HTMLMinificationExtension', 'doRemoveHttpPrefixFromAttributes'));
        $htmlMin->doRemoveDefaultAttributes(Config::inst()->get('dmcb\HTMLMinification\Extensions\HTMLMinificationExtension', 'doRemoveDefaultAttributes'));
        $htmlMin->doRemoveDeprecatedAnchorName(Config::inst()->get('dmcb\HTMLMinification\Extensions\HTMLMinificationExtension', 'doRemoveDeprecatedAnchorName'));
        $htmlMin->doRemoveDeprecatedScriptCharsetAttribute(Config::inst()->get('dmcb\HTMLMinification\Extensions\HTMLMinificationExtension', 'doRemoveDeprecatedScriptCharsetAttribute'));
        $htmlMin->doRemoveDeprecatedTypeFromScriptTag(Config::inst()->get('dmcb\HTMLMinification\Extensions\HTMLMinificationExtension', 'doRemoveDeprecatedTypeFromScriptTag'));
        $htmlMin->doRemoveDeprecatedTypeFromStylesheetLink(Config::inst()->get('dmcb\HTMLMinification\Extensions\HTMLMinificationExtension', 'doRemoveDeprecatedTypeFromStylesheetLink'));
        $htmlMin->doRemoveEmptyAttributes(Config::inst()->get('dmcb\HTMLMinification\Extensions\HTMLMinificationExtension', 'doRemoveEmptyAttributes'));
        $htmlMin->doRemoveValueFromEmptyInput(Config::inst()->get('dmcb\HTMLMinification\Extensions\HTMLMinificationExtension', 'doRemoveValueFromEmptyInput'));
        $htmlMin->doSortCssClassNames(Config::inst()->get('dmcb\HTMLMinification\Extensions\HTMLMinificationExtension', 'doSortCssClassNames'));
        $htmlMin->doSortHtmlAttributes(Config::inst()->get('dmcb\HTMLMinification\Extensions\HTMLMinificationExtension', 'doSortHtmlAttributes'));
        $htmlMin->doRemoveSpacesBetweenTags(Config::inst()->get('dmcb\HTMLMinification\Extensions\HTMLMinificationExtension', 'doRemoveSpacesBetweenTags'));

        $html = $this->owner->render();
        $minifiedHtml = $htmlMin->minify($html);

        return $minifiedHtml;
    }
}
