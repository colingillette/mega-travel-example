<?php

    // An address class used to make an object for easier handling
    
    // Public parameters
    public $line1;
    public $line2;
    public $city;
    public $state;
    public $zip;

    // Constructor
    public function __construct($line1, $city, $state, $zip)
    {
        $this->line1 = $line1;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
    }

    // Set the optional line2 variable
    public function set_line2($line2)
    {
        $this->line2;
    }

    // Checks if line2 exists
    public function line2_exists()
    {
        if (isset($this->line2))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

?>