# php-minstack

###### MinStack is a PHP implementation of an integer stack with added O(1) minimum element retrieval.

A MinStack is a run-of-the-mill stack having, in addition to ```top()```, ```push(i)```, and ```pop()``` methods,
a ```min()``` method that returns the minimum element in the stack in O(1) time.
(MinStack also supports a ```clear()``` method.)


### Minimum Element
A MinStack uses two arrays to store elements pushed on to the stack and provide the ```min()``` operation in O(1) time.

One array acts as the "true" stack and pushed (popped) elements are simply added (removed) from the end of it.

The second tracks the minimum elements as they are pushed;
that is, when an element that is lesser than the current minimum element is pushed,
then it is also appended to this array.
When the current minimum element is popped,
then it is also removed from the end of this array and the new minimum element is the new end of this array.

This scheme works because new elements that are greater than the current minimum will never be the minimum
element on the stack, and thus do not need to later be recalled.
Conversely, new elements that are lesser than the current minimum will need to be recalled in the
reverse order in which they were pushed; thus a simple secondary stack can be used to track them.

This brought up an interesting question:
what is the most efficient way to treat an array as a stack in PHP?


### Two Implementations

```php-minstack``` includes two implementations of a MinStack:

* MinStackManual:
an implementation that manually tracks the ends of the arrays to add and retrieve elements.
* MinStackNative:
an implementation using native PHP array methods to add and retrieve elements to and from the arrays, and

With MinStackManual, a member ```i``` is maintained for each array ```a```
such that ```a[i]``` is the last member of the array
(and thus the top of the stack); these members are incremented and decremented
as elements are pushed and popped.
As a result, ```top()``` and ```min()``` are simple array accesses.

With MinStackNative, the PHP ```end()``` function is called on the internal arrays during
```top()``` and ```min()```,
which sets the array's internal pointer to the end of the array and returns that value.
In ```pop()```, however, the PHP function ```array_pop()``` is used to pop the value from the end of the arrays.
Because [this function](http://php.net/manual/en/function.array-pop.php) resets the array's
internal pointer to the front, I was inclined to believe that the constant
shuffling of the internal pointer from the the back to the front and back again
combined with the overhead of the function calls themselves would
slow down this implementation.
Indeed, because I do not know how the internal pointer is manipulated in PHP,
I was not even sure if this would be a true O(1) implementation.
However, according to the included test script, the native implementation is actually
faster than the manually-tracked implementation.


### Test Results

The test script currently pushes 1,000,000 elements on one stack type
and then randomly pushes or pops 2,000,000 times.

*Note that running the test script currently requires ```memory_limit``` to be set to at least 1024M.*

```
$ php test.php
native time for 2000000 iterations: [14584 ms]
manual time for 2000000 iterations: [15341 ms]

$ php test.php
native time for 2000000 iterations: [14719 ms]
manual time for 2000000 iterations: [15133 ms]

$ php test.php 
native time for 2000000 iterations: [14513 ms]
manual time for 2000000 iterations: [14898 ms]

$ php test.php 
native time for 2000000 iterations: [14665 ms]
manual time for 2000000 iterations: [15011 ms]

$ php test.php
native time for 2000000 iterations: [14562 ms]
manual time for 2000000 iterations: [14986 ms]
```

Not much differential, but the native implementation is consistently faster.
Who knows what's going on in the depths of PHP ...
