<?php

    // A class used to make a reservation object to make handling the reservation easier

    class Reservation
    {
        // Public parameters
        public $firstname;
        public $lastname;
        public $middlename;
        public $email;
        public $phone;
        public $departDate;
        public $returnDate;
        public $amenities;
        public $activities;
        public $address;
        public $destination;
        public $numadults;
        public $numkids;

        // Constructor
        public function __constructor($first, $last, $email, $phone, $depart, $return, $amenities, $address, $destination, $adults, $kids)
        {
            $this->firstname = $first;
            $this->lastname = $last;
            $this->email = $email;
            $this->phone = $phone;
            $this->departDate = $depart;
            $this->returnDate = $return;
            $this->amenities = $amenities;
            $this->address = $address;
            $this->destination = $destination;
            $this->numadults = $adults;
            $this->numkids = $kids;
        }

        // Setters for optional varaibales
        public function set_middlename($middle)
        {
            $this->middlename = $middle;
        }

        public function set_activities($activities)
        {
            $this->activities = $activities;
        }

        // Check if optional variables exist
        public function middlename_exists()
        {
            if (isset($this->middlename))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function activities_exists()
        {
            if (isset($this->activities))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }

?>