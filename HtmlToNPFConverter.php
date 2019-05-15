<?php

require_once 'blocks/ContentBlock.php';
require_once 'blocks/TextContentBlock.php';
require_once 'blocks/ImgContentBlock.php';

/**
 * A neat class that takes HTML and converts it to Neue Post Format content blocks.
 */
class HtmlToNPFConverter
{
    /**
     * Take in some raw HTML and make content blocks out of it!
     * @param string $raw_html The raw HTML to parse into content blocks.
     * @return ContentBlock[] An array of content blocks.
     * @todo Make the return typehint better/safer than just an array.
     */
    public function convert($raw_html)
    {
        $blocks = [];

        // load the given html into a DOMDocument
        $dom = new DOMDocument();
        $dom->loadHTML($raw_html);
        $html = $dom->childNodes[1]; // this should always be the <html> tag
        $dom_body = $html->firstChild; // this should always be the <body> tag within <html>

        // the rest should be our post content
        foreach ($dom_body->childNodes as $child_node) {
            if ($child_node instanceof DOMElement) {
                if ($child_node->tagName === 'p') {
                    $blocks[] = new TextContentBlock($child_node->textContent);
                }
                if ($child_node->hasAttributes()) {
                    foreach ($child_node->attributes as $attr) {
                        if ($attr->name === "src") {
                            $blocks[] = new ImgContentBlock($attr->value);
                        }
                    }
                }
            }
        }
        return $blocks;
    }
}
