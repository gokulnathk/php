<?php

//Interface INode
interface INode {
    public function readNode();
}


/**
 * Class to create simple node for singly linked list
 * @uses Interface INode to avoid dependency of Node class in SinglyLinkedList (Dependency Inversion)
 */
Class Node implements INode{
    // Required attributes of singly linked list nodes
    var $data;
    var $next;
    
    /**
     * Constructor to read node values
     * @param type $data
     */
    public function __construct($data) {
        $this->data = $data;
        $this->next = NULL;
    }
    
    // Read node value
    public function readNode() {
        return $this->data;
    }
}


/**
 * Class to implement Singly Linked List functionalities
 */
Class SinglyLinkedList {
    var $firstNode;
    var $lastNode;
    var $count;
    
    // Constructor to initiate the properties
    public function __construct() {
        $this->firstNode = NULL;
        $this->lastNode = NULL;
        $this->count = 0;
    }
    
    /**
     * Insert a node to the list at first
     * @param INode $node Node object to be inserted
     */
    public function insertFirst(INode $node) {
        $node->next = $this->firstNode;
        $this->firstNode = &$node;        
        
        if ($this->lastNode == NULL) {
            $this->lastNode = &$node;
        }
        // increment the node count
        $this->count++;
    }
    
    /**
     * Insert a node to the list at last
     * @param INode $node Node object to be inserted
     */
    public function insertLast(INode $node) {
        if ($this->firstNode != NULL) {
            $this->lastNode->next = $node;
            $node->next = NULL;
            $this->lastNode = &$node;
            // increment the node count
            $this->count++;
        } else {
            $this->insertFirst($node);
        }
    }
    
    /**
     * Find the node of the input value(key)
     * @param mixed $key node value to be searched
     * @return INode|NULL return the node if found else NULL
     */
    public function find($key) {
        $current = $this->firstNode;
        // loop through the list until finding the required value
        while ($current->data != $key) {
            if ($current->next === NULL)
                return NULL;
            else
                $current = $current->next;
        }
        return $current;
    }
    
    /**
     * Delete the node present in at front of the list
     * @return INode Node object will be deleted
     */
    public function deleteFirstNode() {
        // delete only if the list is not empty
        if ($this->firstNode !== NULL) {
            // assign the first node to a temporary variable
            $temp = $this->firstNode;
            // make the next node as a first node
            $this->firstNode = $this->firstNode->next;
            // If the list is not empty reduce the count of nodes
            if ($this->firstNode !== NULL) 
                $this->count--;
            // return the deleted node
            return $temp;
        }
    }
        
    /**
     * Delete a node from the last of list
     * @return INode Node object will be deleted
     */
    public function deleteLastNode() {
        // delete if the list is not empty
        if ($this->firstNode !== NULL) {
            // if list has only one node in it
            if ($this->firstNode->next === NULL) {
                // set the first node as NULL
                $current = $this->firstNode;
                $this->firstNode = NULL;
                $this->count--;
            } else {
                // Get the first two nodes and make them as previous and current
                $previous = $this->firstNode;
                $current = $this->firstNode->next;
                // loop through to reach the last node
                while($current->next !== NULL) {
                    $previous = $current;
                    $current = $current->next;
                }
                // delete the reference to the last node from previous node of last
                $previous->next = NULL;
                $this->count--;                
            }
            return $current;
        }        
    }
}