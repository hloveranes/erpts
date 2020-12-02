<?php

class OrderedList {
      /** The $orderedList attribute. This attribute is the list
       ** @type array
       **/
      var $classname = "OrderedList";
      var $orderedList;
      /** The $head attribute. This attribute is the next available slot in the list.
       ** @type int
       **/
      var $head = 0;
      /** The $tail attribute. This attribute is the next available slot in the list.
       ** @type int
       **/
      var $tail = 0;
      /** The $numItems attribute. This attribute is the number of items in the list. Different from the size of the list
       ** @type int
       **/
      var $numItems = 0;
      /**
      * Constructor, Initializes the list.
      */
      function OrderedList(){
          $this->head = 0;
          $this->tail = 0;
      }
      /**  The count method. This method returns the number of objects in the list.
       **  @public
       **  @returns int
       **/
      function count(){
          return $this->numItems;
      }
      /**  The get method. This method returns the object at the given index.
       **  @public
       **  @returns object
       **/
      function get($index){

          if($index >= $this->numItems) { //first, check if we are within bounds
              return null;
          }
          else {
              return $this->orderedList[$index];
          }
      }
      /**  The first method. This method returns the first object in the list.
       **  @public
       **  @returns object
       **/
      function first(){
          return $this->orderedList[$this->$head];
      }
      /**  The last method. This method returns the last object in the list.
       **  @public
       **  @returns object
       **/
      function last(){
          return $this->orderedList[$this->$tail];
      }
      /**  The includes method. This method determines whether the list includes the prescrbed item.
       **  @public
       **  @returns boolean
       **/
      function includes($item){
          // use the PHP array_search function to search for a particular item
          return array_search($item, $this->orderedList);
      }
      /**  The append method. This method appends the given item to the list, making it the last in the list.
       **  @public
       **  @returns int
       **/

      function append($item){
          // insert the item into the list
          $this->orderedList[$this->tail++] = $item;
          // increment the number of items in the list
          $this->numItems++;
          // assign tail to the next available slot
          // if there are no more slots then grow the list
             // increment the number of slots in the list
      }
      /**  The prepend method. This method prepends the given item to the list, making it the first in the list.
       **  @public
       **  @returns int
       **/
      function prepend($item){
          // use the PHP array function unshift to add to the front of the array
          array_unshift($this->orderedList,$item);
          // increment the tail
          $this->tail++;
          // increment the number of items in the list.
          $this->numItems++;
      }
      /**  The remove method. This method removes the given item from the list.
       **  @public
       **  @returns object
       **/
      function remove($item){
          // find the item in the list
          $index = $this->includes($item);
          if ( !($index === FALSE)){
              // splice the list from this index
              $item = array_splice($this->orderedList,$index,1);
          }
          return $item;
      }
      /**  The removelast method. This method will remove the last item on the list.
       **  @public
       **  @returns object
       **/
      function removelast(){
          // use the array pop function to remove the last item on the list
          $item = array_pop($this->orderedList);
          // decrement the tail and numItems
          $this->tail--; $this->numItems--;
          return $item;
      }
      /**  The removefirst method. This method will remove the first item on the list.
       **  @public
       **  @returns object
       **/
      function removefirst(){
          // use the array shift function to remove the first item on the list
          $item = array_shift($this->orderedList);
          // decrement the tail and numItems
          $this->tail--; $this->numItems--;
          return $item;
      }
      /**  The removeall method. This method will remove all the objects in the list.
       **  @public
       **  @returns boolean
       **/
      function removeall(){

      }
      /**  The top method. This is a stack interface, it returns the top element of the stack.
       **  @public
       **  @returns object
       **/
      function top(){
          return end($this->orderedList);
      }
      /**  The push method. This is a stack interface, it pushes an object onto the stack.
       **  @public
       **  @returns object
       **/
      function push($item){
          array_push($this->orderedList,$item);
          // increment $tail and $numItems
          $this->tail++; $this->numItems++;
      }
      /**  The pop method. This is a stack interface. it pops the top of the stack.
       **  @public
       **  @returns object
       **/
      function pop(){
          $item = array_pop($this->orderedList);
          // decrement $tail and $numItems
          $this->tail--; $this->numItems--;
          return $item;
      }
 }

?>
