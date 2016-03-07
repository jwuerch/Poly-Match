<?php

    class City {
        private $name;
        private $state;
        private $id;

        public function __construct($name, $state, $id = null) {
            $this->name = $name;
            $this->state = $state;
            $this->id = $id;
        }

        //Setters
        public function setName($new_name) {
            $this->name = $new_name;
        }
        public function setState($new_state) {
            $this->state = $new_state;
        }
        //Getters
        public function getName() {
            return $this->name;
        }
        public function getState() {
            return $this->state;
        }
        public function getId() {
            return $this->id;
        }

        public function save() {
            $GLOBALS['DB']->exec("INSERT INTO cities (name, state) VALUES ('{$this->getName()}', '{$this->getState()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        //Static Functions;
        static function getAll() {
            $returned_cities = $GLOBALS['DB']->query("SELECT * FROM cities;");
            $cities = array();
            foreach ($returned_cities as $city) {
                $id = $city['id'];
                $name = $city['name'];
                $state = $city['state'];
                $new_city = new City($name, $state, $id);
                array_push($cities, $new_city);
            }
            return $cities;
        }

        static function deleteAll() {
            $GLOBALS['DB']->exec("DELETE FROM cities;");
        }
    }


 ?>
