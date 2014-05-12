<?php
  class Movie 
  {
    private $moiveId;
    private $title;
    private $director;
    private $genres;
    private $actors;
    
    public function __construct($movieId, $title, $director) {
      $this->movieId = $movieId;
      $this->title = $title;
      $this->director = $director;
    }

    public function getMovieId() {
      return $this->movieId;
    }

    public function getTitle() {
      return $this->title;
    }

    public function getDirector() {
      return $this->director;
    }

    public function getGenres() {
      return $this->genres;
    }

    public function getActors() {
      return $this->actors;
    }

    public function setGenres($genres) {
      $this->genres = $genres;
    }

    public function setActors($actors) {
      $this->actors = $actors;
    }

  }
?>