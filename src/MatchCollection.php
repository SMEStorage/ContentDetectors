<?php
namespace SME\ContentDetectors;

use Iterator;

/**
 * Class MatchCollection
 *
 * Contains the collection of Matches that have been identifed. Implements the Iterator interface.
 *
 * @package SME\ContentDetectors
 * @author James Norman <james@storagemadeeasy.com>
 */
class MatchCollection implements Iterator
{
    /**
     * @var int
     */
    private $position = 0;

    /**
     * Array of DataMatch instances
     * @var array
     */
    private $matches = [];

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return $this->matches[$this->position];
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return isset($this->matches[$this->position]);
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * Adds the match to the list of existing matches
     *
     * @param DataMatch $match
     */
    public function addMatch(DataMatch $match)
    {
        $this->matches []= $match;
    }
}
