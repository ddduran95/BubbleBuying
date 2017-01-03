<?php
// file: model/CommentMapper.php

require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/Mensaje.php");

/**
 * Class CommentMapper
 *
 * Database interface for Comment entities
 *
 * @author lipido <lipido@gmail.com>
 */
class MensajeMapper {

  /**
   * Reference to the PDO connection
   * @var PDO
   */
  private $db;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }

  /**
   * Saves a comment
   *
   * @param Mensaje $mensaje The comment to save
   * @throws PDOException if a database error occurs
   * @return true or false of execute
   */
  public function save(Mensaje $mensaje) {
    $stmt = $this->db->prepare("INSERT INTO mensajes(autor, chat, mensaje) values (?,?,?)");
    return $stmt->execute(array($mensaje->getAutor(),$mensaje->getChat()->getId(),$mensaje->getMensaje()));
  }
}
