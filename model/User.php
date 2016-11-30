<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

/**
 * Class User
 *
 * Represents a User in the blog
 *
 * @author lipido <lipido@gmail.com>
 */
class User {

  /**
   * The user name of the user
   * @var string
   */
  private $name;
  /**
   * The alias of the user
   * @var string
   */
  private $alias;
  /**
   * The password of the user
   * @var string
   */
  private $password;
  private $photo;
  /**
   * The constructor
   *
   * @param string $name The name of the user
   * @param string $passwd The password of the user
   */
  public function __construct($name=NULL, $alias=NULL, $password=NULL, $photo=NULL) {
    $this->name = $name;
    $this->alias = $alias;
    $this->password = $password;
    $this->photo = $photo;
  }

  /**
   * Gets the name of this user
   *
   * @return string The name of this user
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Sets the name of this user
   *
   * @param string $name The name of this user
   * @return void
   */
  public function setName($name) {
    $this->name = $name;
  }

  public function getAlias() {
    return $this->alias;
  }

  public function setAlias($alias) {
    $this->alias = $alias;
  }

  /**
   * Gets the password of this user
   *
   * @return string The password of this user
   */
  public function getPassword() {
    return $this->password;
  }
  /**
   * Sets the password of this user
   *
   * @param string $passwd The password of this user
   * @return void
   */
  public function setPassword($password) {
    $this->password = $password;
  }

  public function getPhoto() {
    return $this->photo;
  }

  public function setPhoto($photo) {
    $this->photo = $photo;
  }

  /**
   * Checks if the current user instance is valid
   * for being registered in the database
   *
   * @throws ValidationException if the instance is
   * not valid
   *
   * @return void
   */
  public function checkIsValidForRegister() {
      $errors = array();
      if (strlen($this->name) < 5) {
	       $errors["name"] = "name must be at least 5 characters length";

      }
      if (strlen($this->alias) < 3) {
	       $errors["alias"] = "Alias must be at least 3 characters length";
      }
      if (strlen($this->password) < 4) {
	       $errors["password"] = "Password must be at least 5 characters length";
      }
      if (sizeof($errors)>0){
	       throw new ValidationException($errors, "user is not valid");
      }

  }
}
