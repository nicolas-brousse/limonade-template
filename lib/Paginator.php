<?php

class Paginator implements \ArrayAccess, \Countable, \IteratorAggregate
{
    protected $items = array();

    protected $query;
    protected $petPage;
    protected $page;

    private $isExecuted = false;

    /**
     * The constructor
     *
     * @param ORM  $query
     * @param int  $perPage
     * @param int  $page
     */
    public function __construct(ORM $query, $page=1, $perPage=25)
    {
        $this->query   = $query;
        $this->perPage = (int) $perPage;
        $this->page    = (int) $page;
    }

    /**
     *
     */
    public function offsetSet($offset, $value)
    {
        // if (is_null($offset)) {
        //     $this->items[] = $value;
        // } else {
        //     $this->items[$offset] = $value;
        // }
    }

    /**
     *
     */
    public function offsetExists($offset)
    {
        $this->execute();

        return isset($this->items[$offset]);
    }

    /**
     *
     */
    public function offsetUnset($offset)
    {
        $this->execute();

        unset($this->items[$offset]);
    }

    /**
     *
     */
    public function offsetGet($offset)
    {
        $this->execute();

        return isset($this->items[$offset]) ? $this->items[$offset] : null;
    }

    /**
     * Get the total of items in this CURRENT page
     *
     * @return int
     */
    public function count()
    {
        $this->execute();

        return count($this->items);
    }

    /**
     * Get the total of entries in database
     *
     * @return int
     */
    public function total()
    {
        $this->execute();

        return (int) $this->total;
    }

    /**
     * Get the array iterator
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        $this->execute();

        return new ArrayIterator($this->items);
    }

    /**
     *
     */
    public function current_page()
    {
        $this->execute();

        return (int) $this->page;
    }

    /**
     *
     */
    public function next_page()
    {
        $this->execute();

        return $this->current_page() < $this->last_page()
            ? $this->current_page() + 1
            : false
        ;
    }

    /**
     *
     */
    public function prev_page()
    {
        $this->execute();

        return $this->current_page() > 1
            ? $this->current_page() - 1
            : false
        ;
    }

    /**
     *
     */
    public function last_page()
    {
        $this->execute();

        return (int) ceil($this->total() / $this->perPage);
    }

    /**
     *
     */
    public function first_page()
    {
        $this->execute();

        return (int) 1;
    }

    /**
     * Execute the queries
     */
    protected function execute()
    {
        if ($this->isExecuted !== false) {
            return;
        }

        /**
         * count
         */
        $query = clone $this->query;
        foreach (array('limit', 'offset') as $field) {
            $query->{$field} = null;
        }
        $this->total = $query->count();

        /**
         * entries
         */
        $query = clone $this->query;
        $query
            ->limit($this->perPage)
            ->offset(($this->page - 1) * $this->perPage)
        ;
        $this->items = $query->find_many();

        $this->isExecuted = true;
    }
}
