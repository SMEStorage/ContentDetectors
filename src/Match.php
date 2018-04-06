<?php
namespace SME\ContentDetectors;

/**
 * Class Match
 *
 * Class that represents an detected match in the content.
 *
 * @package SME\ContentDetectors
 * @author James Norman <james@storagemadeeasy.com>
 */
class Match
{
    /**
     * @var string
     */
    private $matchType;

    /**
     * @var string
     */
    private $matchingContent = '';

    private $data = [];

    /**
     * @return mixed
     */
    public function getMatchType()
    {
        return $this->matchType;
    }

    /**
     * @param mixed $matchType
     * @return $this
     */
    public function setMatchType($matchType)
    {
        $this->matchType = $matchType;

        return $this;
    }

    /**
     * @return string
     */
    public function getMatchingContent()
    {
        return $this->matchingContent;
    }

    /**
     * @param string $matchingContent
     * @return $this
     */
    public function setMatchingContent($matchingContent)
    {
        $this->matchingContent = $matchingContent;

        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

}