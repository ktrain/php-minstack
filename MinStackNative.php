<?php

/**
 * MinStack implementation using native PHP methods to
 * access and modify the inner "stack" arrays.
 */
class MinStackNative extends MinStack
{
    /**
     * @return the top element of the stack
     */
    public function top()
    {
        if (empty($this->_data)) {
            return null;
        }

        // I thought that these end() calls,
        // combined with array_pop() which calls reset()
        // on the array, would slow down the native stack.
        // Apparently not!
        return end($this->_data);
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
            $this->_mins[] = $i;
        }

        $this->_data[] = $i;
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
            // array_pop reset()s the array,
            // but doesn't seem to slow down top() or min()
            array_pop($this->_mins);
        }

        return array_pop($this->_data);
    }

    /**
     * @return the minimum element in the stack (null if stack empty)
     */
    public function min()
    {
        if (empty($this->_mins)) {
            return null;
        }

        return end($this->_mins);
    }
}
