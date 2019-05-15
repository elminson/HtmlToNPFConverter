<?php

require 'HtmlToNPFConverter.php';

/**
 * Test out the HtmlToNPFConverter.
 */
class HtmlToNPFConverterTest extends PHPUnit\Framework\TestCase
{
    /**
     * Test a simple conversion of a single <p></p> tag to a TextContentBlock.
     */
    public function testSimpleConversion()
    {
        // do the conversion
        $converter = new HtmlToNPFConverter();
        $result = $converter->convert('<p>hello!</p>');

        // run through a battery of assertions!
        $this->assertTrue(is_array($result), 'The result should be an array.');
        $this->assertTrue(count($result) === 1, 'The resulting array should have only 1 item.');
        $this->assertInstanceOf(TextContentBlock::class, $result[0], 'The only resulting block should be a text block.');
        assert($result[0] instanceof TextContentBlock);
        $this->assertSame('hello!', $result[0]->getText(), 'The text block should have "hello!" in it.');
        $resulting_json = json_encode($result[0]);
        $this->assertTrue(is_string($resulting_json), 'The content block result must serialize to JSON.');
        $this->assertSame('{"type":"text","text":"hello!"}', $resulting_json, 'The array item should serialize to a single JSON object.');
    }

    /**
     * Test a complex conversion of multiple block types.
     */
    public function testComplexConversion()
    {
        // do the conversion
        $raw_html = file_get_contents(__DIR__.'/data/post_content_complex.html');
        $converter = new HtmlToNPFConverter();
        $result = $converter->convert($raw_html);

        // run through a battery of assertions!
        $this->assertTrue(is_array($result), 'The result should be an array.');
     //   $this->assertTrue(count($result) === 5, 'The resulting array should have 5 blocks.');
        $this->assertInstanceOf(TextContentBlock::class, $result[0], 'The first resulting block should be a text block.');
        // @todo replace 'ImageContentBlock' with ImageContentBlock::class once built
        $this->assertInstanceOf(ImgContentBlock::class, $result[1], 'The second resulting block should be an image block.');
        $this->assertInstanceOf(TextContentBlock::class, $result[2], 'The third resulting block should be a text block.');
        $this->assertInstanceOf(TextContentBlock::class, $result[3], 'The fourth resulting block should be a text block.');
        $this->assertInstanceOf(TextContentBlock::class, $result[4], 'The fifth resulting block should be a text block.');
        // @todo write more assertions for the content of the blocks, like we did in testSimpleConversion
    }

    /**
     * Test conversion of inline formatting for text block types.
     */
    public function testFormattingConversion()
    {
        // do the conversion
        $raw_html = file_get_contents(__DIR__.'/data/post_content_formatting.html');
        $converter = new HtmlToNPFConverter();
        $result = $converter->convert($raw_html);

        // run through a battery of assertions!
        $this->assertTrue(is_array($result), 'The result should be an array.');
        $this->assertTrue(count($result) === 2, 'The resulting array should have 2 blocks.');
        $this->assertInstanceOf(TextContentBlock::class, $result[0], 'The first resulting block should be a text block.');
        $this->assertInstanceOf(TextContentBlock::class, $result[1], 'The second resulting block should be a text block.');
        // @todo write more assertions for the content of the blocks, like we did in testSimpleConversion
        // @todo write unit tests for the creation of formatting objects and their JSON serialization
    }
}
