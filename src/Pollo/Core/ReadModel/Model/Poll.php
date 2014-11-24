<?php

namespace Pollo\Core\ReadModel\Model;

final class Poll extends Model
{
    /** @var string */
    private $id;

    /** @var string */
    private $title;

    /**
     * @param string $id
     * @param string $title
     */
    public function __construct($id, $title)
    {
        $this->id = (string) $id;
        $this->title = (string) $title;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return self
     */
    public static function deserialize(array $data)
    {
        return new self($data['id'], $data['title']);
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return array(
            'id' => $this->id,
            'title' => $this->title
        );
    }
}
