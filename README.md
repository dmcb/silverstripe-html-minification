# SilverStripe HTML minification

## Description
Minifies the HTML of SilverStripe HTTP responses.

## Requirements
* SilverStripe 4.x

## Usage
Define HTML minification settings for your project in `mysite/_config/config.yml`. These are the default values:

```
  dmcb\HTMLMinification\HTMLMinificationMiddleware:
    doOptimizeViaHtmlDomParser = true               // optimize html via "HtmlDomParser()"
    doRemoveComments = true                         // remove default HTML comments (depends on "doOptimizeViaHtmlDomParser(true)")
    doSumUpWhitespace = true                        // sum-up extra whitespace from the Dom (depends on "doOptimizeViaHtmlDomParser(true)")
    doRemoveWhitespaceAroundTags = false            // remove whitespace around tags (depends on "doOptimizeViaHtmlDomParser(true)")
    doOptimizeAttributes = true                     // optimize html attributes (depends on "doOptimizeViaHtmlDomParser(true)")
    doRemoveHttpPrefixFromAttributes = true         // remove optional "http:"-prefix from attributes (depends on "doOptimizeAttributes(true)")
    doRemoveDefaultAttributes = false               // remove defaults (depends on "doOptimizeAttributes(true)" | disabled by default)
    doRemoveDeprecatedAnchorName = true             // remove deprecated anchor-jump (depends on "doOptimizeAttributes(true)")
    doRemoveDeprecatedScriptCharsetAttribute = true // remove deprecated charset-attribute - the browser will use the charset from the HTTP-Header, anyway (depends on "doOptimizeAttributes(true)")
    doRemoveDeprecatedTypeFromScriptTag = true      // remove deprecated script-mime-types (depends on "doOptimizeAttributes(true)")
    doRemoveDeprecatedTypeFromStylesheetLink = true // remove "type=text/css" for css links (depends on "doOptimizeAttributes(true)")
    doRemoveEmptyAttributes = true                  // remove some empty attributes (depends on "doOptimizeAttributes(true)")
    doRemoveValueFromEmptyInput = true              // remove 'value=""' from empty <input> (depends on "doOptimizeAttributes(true)")
    doSortCssClassNames = true                      // sort css-class-names, for better gzip results (depends on "doOptimizeAttributes(true)")
    doSortHtmlAttributes = true                     // sort html-attributes, for better gzip results (depends on "doOptimizeAttributes(true)")
    doRemoveSpacesBetweenTags = false               // remove more (aggressive) spaces in the dom (disabled by default)
```

And extend any ContentControllers to enable HTML minification for the index output of that controller:

```
ContentController:
  extensions:
    - dmcb\HTMLMinification\HTMLMinificationExtension
```
