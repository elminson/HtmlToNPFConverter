<?php

require_once 'ContentBlock.php';

/**
 * A content block that just has text.
 */
class TextContentBlock extends ContentBlock
{
    /**
     * The text content of this content block.
     * @var string
     */
    protected $text;

    /**
     * Create a new text content block with some text!
     * @param string $text The text to use in this content block.
     */
    public function __construct($text)
    {
        parent::__construct(ContentBlock::TYPE_TEXT);

        $this->text = $text;
    }

    /**
     * Get the text used in this text content block.
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        $array = parent::jsonSerialize();
        $array['text'] = $this->getText();
        return $array;
    }
}
