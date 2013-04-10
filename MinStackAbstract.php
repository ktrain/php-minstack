<?php

abstract class MinStackAbstract
{
    protected $_data;
    protected $_mins;

    public function __construct()
    {
        $this->_data = array();
        $this->_mins = array();
    }

    /**
     * Clears the stack.
     *
     * @return $this
     */
    public function clear()
    {
        $this->_data = array();
        $this->_mins = array();

        return $this;
    }

    /**
     * Returns the value of the top element on the stack.
     * Does not modify the stack.
     *
     * @return int
     */
    abstract function top();

    /**
     * Adds $i to the top of the stack.
     *
     * @param int $i
     * @return $i
     */
    abstract function push($i);

    /**
     * Removes and returns the top element on the stack.
     *
     * @return int
     */
    abstract function pop();

    /**
     * Returns the value of the minimum element in the stack.
     * Does not modify the stack.
     *
     * @return int
     */
    abstract function min();
}
