<?php

/**
 * Base class for more specific content blocks.
 */
abstract class ContentBlock implements JsonSerializable
{
    /**
     * The "text" type content block.
     * @var string
     */
    const TYPE_TEXT = 'text';

    /**
     * The "img" type content block.
     * @var string
     */
    const TYPE_IMG = 'img';

    /**
     * A list of valid content block types.
     * @var array
     */
    const VALID_TYPES = [
        self::TYPE_TEXT,
        self::TYPE_IMG,
    ];

    /**
     * This content block's type.
     * @var string
     */
    protected $type;

    /**
     * ContentBlock constructor.
     * @param string $type The type of block this is.
     */
    public function __construct($type)
    {
        if (!in_array($type, self::VALID_TYPES, true)) {
            throw new InvalidArgumentException('The type you specified is not valid!');
        }

        $this->type = $type;
    }

    /**
     * Return what type of content block this is.
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Return a JSON-serializable version of this content block.
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'type' => $this->getType(),
        ];
    }
}
