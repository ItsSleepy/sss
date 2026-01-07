<?php
    class Car{
        //Properties
        private $model;
        private $topSpeed;
        private $doors;
        //model, topSpeed, doors
        public function __construct($model, $topSpeed, $doors){
            $this->model = $model;
            $this->topSpeed = $topSpeed;
            $this->doors = $doors;
        }

        //Setters
        public function setModel($model){
            $this->model = $model;
        }
        public function setTopSpeed($topSpeed){
            $this->topSpeed = $topSpeed;
        }
        public function setDoors($doors){
            $this->doors = $doors;
        }
        //Getters
        public function getModel(){
            return $this->model;
        }
        public function getTopSpeed(){
            return $this->topSpeed;
        }
        public function getDoors(){
            return $this->doors;
        }

    }

    //Create 2 car objects
    // BMW, 300, 3
    $car1 = new Car("BMW", 300, 3);
    //Nissan Micra, 80, 5
    $car2 = new Car("Nissan Micra", 80, 5);

    //Display the info
    echo "Car 1: Model: " . $car1->getModel() . ", Top Speed: " . $car1->getTopSpeed() . " km/h, Doors: " . $car1->getDoors() . "\n";
    echo "Car 2: Model: " . $car2->getModel() . ", Top Speed: " . $car2->getTopSpeed() . " km/h, Doors: " . $car2->getDoors() . "\n";
?>