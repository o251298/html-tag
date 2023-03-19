<?php

namespace Codehigh\HtmlTag;

class HtmlTag
{

    /**
     * @var string[]
     */
    private array $attributes = [];
    /**
     * @var string[]
     */
    private array $content = [];
    private string $tag;

    /**
     * @param string[] $attributes
     */
    public function __construct(string $tag, array $attributes = [])
    {
        $this->tag = $tag;
        $this->attributes = $attributes;
    }

    public static function create(string $tag): HtmlTag
    {
        return new self($tag);
    }

    /**
     * @param string[] $attributes
     */
    public function setAttributes(array $attributes): HtmlTag
    {
        $this->attributes = $attributes;
        return $this;
    }

    public function addAttribute(string $attribute, string $value) : HtmlTag
    {
        $this->attributes[$attribute] = $value;
        return $this;
    }

    public function setContent(string $content): HtmlTag
    {
        $this->content = [$content];
        return $this;
    }

    public function assemble(): string
    {
        $result = "<" . $this->tag . $this->renderAttributes();
        if (count($this->content) !== 0) {
            $result .= ">\n" . implode("\n", $this->content) . "</" . $this->tag . ">";
        } else {
            $result .= ">";
        }
        return $result;
    }

    private function renderAttributes(): string
    {
        $result = '';
        foreach ($this->attributes as $key => $value) {
            $result .= " $key='" . "$value'";
        }
        return $result;
    }
}