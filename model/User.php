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
  private $nombre;
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

  /**
   * The constructor
   *
   * @param string $username The name of the user
   * @param string $passwd The password of the user
   */
  public function __construct($nombre=NULL, $alias=NULL, $password=NULL) {
    $this->nombre = $nombre;
    $this->alias = $alias;
    $this->password = $password;
  }

  /**
   * Gets the username of this user
   *
   * @return string The username of this user
   */
  public function getNombre() {
    return $this->nombre;
  }

  /**
   * Sets the username of this user
   *
   * @param string $username The username of this user
   * @return void
   */
  public function setNombre($nombre) {
    $this->nombre = $nombre;
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
      if (strlen($this->nombre) < 5) {
	       $errors["username"] = "Username must be at least 5 characters length";

      }
      //3 por ejemplo
      if (strlen($this->alias) < 3) {
	       $errors["alias"] = "Alias must be at least 3 characters length";
      }
      if (strlen($this->password) < 5) {
	       $errors["password"] = "Password must be at least 5 characters length";
      }
      if (sizeof($errors)>0){
	       throw new ValidationException($errors, "user is not valid");
      }
  }
}
