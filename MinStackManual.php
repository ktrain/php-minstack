<?php

/**
 * MinStack implementation using manual tracking of the end of
 * the inner "stack" arrays.
 */
class MinStackManual extends MinStack
{
    protected $_dataEnd;
    protected $_minsEnd;

    /**
     * @return the top element of the stack
     */
    public function top()
    {
        if (empty($this->_data)) {
            return null;
        }

        return $this->_data[$this->_dataEnd];
    }

    /**
     * Adds an element to the top of the stack.
     *
     * @param int $i
     * @return $i
     */
    public function push($i)
    {
        if (empty($this->_mins) || $i < $this->min()) {
            $this->_mins[++$this->_minsEnd] = $i;
        }

        $this->_data[++$this->_dataEnd] = $i;
        return $i;
    }

    /**
     * Removes and returns the top element of the stack.
     *
     * @return the top element of the stack (null if stack empty)
     */
    public function pop()
    {
        if (empty($this->_data)) {
            return null;
        }

        if ($this->top() === $this->min()) {
            unset($this->_mins[$this->_minsEnd--]);
        }

        $popped = $this->_data[$this->_dataEnd];
        unset($this->_data[$this->_dataEnd--]);
        return $popped;
    }

    /**
     * @return the minimum element in the stack (null if stack empty)
     */
    public function min()
    {
        if (empty($this->_mins)) {
            return null;
        }

        return $this->_mins[$this->_minsEnd];
    }
}
