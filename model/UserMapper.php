<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");

/**
 * Class UserMapper
 *
 * Database interface for User entities
 *
 * @author lipido <lipido@gmail.com>
 */
class UserMapper {

  /**
   * Reference to the PDO connection
   * @var PDO
   */
  private $db;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }

  /**
   * Saves a User into the database
   *
   * @param User $user The user to be saved
   * @throws PDOException if a database error occurs
   * @return void
   */
  public function save($user) {
    $stmt = $this->db->prepare("INSERT INTO usuario values (?,?,?)");
    $stmt->execute(array($user->getName(), $user->getAlias(), $user->getPassword()));
  }

  /**
   * Checks if a given username is already in the database
   *
   * @param string $username the username to check
   * @return boolean true if the username exists, false otherwise
   */
  public function aliasExists($alias) {
    $stmt = $this->db->prepare("SELECT count(alias) FROM usuario where alias=?");
    $stmt->execute(array($alias));
    if ($stmt->fetchColumn() > 0) {
      return true;
    }
  }

  /**
   * Checks if a given pair of username/password exists in the database
   *
   * @param string $username the username
   * @param string $passwd the password
   * @return boolean true the username/passwrod exists, false otherwise.
   */
  public function isValidUser($alias, $password) {
    $stmt = $this->db->prepare("SELECT count(alias) FROM usuario where alias=? and password=?");
    $stmt->execute(array($alias, $password));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }
  }
}
