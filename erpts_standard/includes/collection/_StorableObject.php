<?php

class StorableObject{
    /**
     *  Description of the Field
     */
    var $isStoredInDatabase;
    /**
     *  Default Constructor. Sets all values to defaults.
     */
    function StorableObject()
    {
        $this->isStoredInDatabase = false;
    }
    /**
     *  Returns an XML element that forms a DOM tree representing the data of
     *  this object. Only those fields are inserted into the DOM tree that were
     *  initialized in the init method.
     *
     */

    /**
     *  This method deletes the databse entry of the object. No values of the
     *  object are changed, but the database entry does not exist any more.
     *  It is possible to store the object again.
     *
     */
    function deleteRecord(){
    }


    /**
     *  Prints the values of all mapped fields of the current object to the
     *  console.
     */
    function storeRecord(){
    }


    /**
     *  Returns a string containing the XML representation of the values of the
     *  fields stored in the current object.
     *
     *@return    java.lang.String
     */
    function createRecord()
    {

        $this->isStoredInDatabase = true;
    }


    /**
     *  This method updates an existing entry in the database. It is never
     *  called directly from the application, because if you store an object the
     *  database manager decides whether this object has to be inserted or
     *  updated.
     *
     *@exception  DatabaseException  Description of Exception
     *@exception  ObjectException    Description of Exception
     */
    function updateRecord(){

    }
}
