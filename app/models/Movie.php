<?php

    class Movie{

        private $jsonPath;

        public function __construct(){
            $this->jsonPath= ROOT_PATH . '/movies.json';
        }

        public function showMovies(){   
            $jasonData = file_get_contents($this->jsonPath);
            return json_decode($jasonData, true);
        }

        public function addMovie(){

        }

        public function deleteMovie(){

        }

    }

?>