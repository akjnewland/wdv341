<?php
class Student {
  private string $firstName; //best practice to define your variables
  private string $lastName;
  private string $email;
  private string $program;

  public function __construct(
    string $firstName, 
    string $lastName, 
    string $email, 
    string $program
    ){
      $this->firstName = $firstName;
      $this->lastName = $lastName;
      $this->email = $email;
      $this->program = $program;
  }

  public function displayStudent(){
    return "<p>" . "Name: " . $this->firstName . " " . $this->lastName . "<br>" .
    "Email: " . $this->email . "<br>" . 
    "Program: " . $this->program . "</p>";
  }

  // public function getName(){
  //   return $this->firstName . $this->lastName;
  // }
}
?>