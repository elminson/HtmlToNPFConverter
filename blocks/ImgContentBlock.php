<?php

require_once 'ContentBlock.php';

/**
 * A content block that just has text.
 */
class ImgContentBlock extends ContentBlock
{
    /**
     * The img content of this content block.
     * @var string
     */
    protected $img;

    /**
     * Create a new img content block with some img!
     * @param string $img The img to use in this content block.
     */
    public function __construct($img)
    {
        parent::__construct(ContentBlock::TYPE_IMG);

        $this->img = $img;
    }

    /**
     * Get the img used in this img content block.
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        $array = parent::jsonSerialize();
        $array['img'] = $this->getImg();
        return $array;
    }
}
