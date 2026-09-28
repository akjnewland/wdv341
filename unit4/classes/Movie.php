<?php
class Movie {
  private $title;
  private $director;
  private $genre;
  private $releaseYear;

  public function __construct($title, $director, $genre, $releaseYear) {
    $this->title = $title;
    $this->director = $director;
    $this->genre = $genre;
    $this->releaseYear = $releaseYear;
  }

  public function getTitle() {
    return strtoupper($this->title);
  }

  public function setTitle($value) {
    $this->title = $value; //do your validation with the setter
    return $this->title;
  }

  // public function displayMovie() {
  //   echo "
  //     <ul> 
  //     <li>{$this->title}</li>
  //     <li>{$this->director}</li>
  //     <li>{$this->genre}</li>
  //     <li>{$this->releaseYear}</li>
  //     </ul>
  //     ";
  // };
}

?>