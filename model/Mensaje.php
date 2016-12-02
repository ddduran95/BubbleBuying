<?php
// file: model/Comment.php

require_once(__DIR__."/../core/ValidationException.php");

/**
 * Class Comment
 *
 * Represents a Comment in the blog. A Comment is attached
 * to a Chat and was written by an specific User (author)
 *
 * @author lipido <lipido@gmail.com>
 */
class Mensaje {

  /**
   * The autor of the mensaje
   * @var User
   */
  private $autor;

  /**
   * The chat of the mensaje
   * @var timestamp
   */
  private $hora;

  /**
   * The mensaje of the mensaje
   * @var string
   */
  private $mensaje;

  /**
   * The chat being chatted by this mensaje
   * @var Chat
   */
  private $chat;

  /**
   * The constructor
   *
   * @param int $id The id of the mensaje
   * @param string $mensaje The mensaje of the mensaje
   * @param User $author The author of the mensaje
   * @param Chat $chat The parent chat
   */
  public function __construct(User $autor=NULL, Chat $chat=NULL, $mensaje=NULL,$tiempo=NULL) {
    $this->autor= $autor;
    $this->chat= $chat;
    $this->tiempo= $tiempo;
    $this->mensaje= $mensaje;
  }

  /**
   * Gets the autor of this mensaje
   *
   * @return User The mensaje of this mensaje
   */
  public function getAutor() {
    return $this->autor;
  }

  /**
   * Sets the mensaje of the Comment
   *
   * @param string $mensaje the mensaje of this mensaje
   * @return void
   */
  public function setAutor(User $autor) {
    $this->autor = $autor;
  }


  /**
   * Gets the mensaje of this mensaje
   *
   * @return string The mensaje of this mensaje
   */
  public function getMensaje() {
    return $this->mensaje;
  }

  /**
   * Sets the mensaje of the Comment
   *
   * @param string $mensaje the mensaje of this mensaje
   * @return void
   */
  public function setMensaje($mensaje) {
    $this->mensaje = $mensaje;
  }

  /**
   * Gets the parent chat of this mensaje
   *
   * @return Chat The parent chat of this mensaje
   */
  public function getChat() {
    return $this->chat;
  }

  /**
   * Sets the parent Chat
   *
   * @param Chat $chat the parent chat
   * @return void
   */
  public function setChat(Chat $chat) {
    $this->chat = $chat;
  }

  /**
   * Checks if the current instance is valid
   * for being inserted in the database.
   *
   * @throws ValidationException if the instance is
   * not valid
   *
   * @return void
   */
  public function checkIsValidForCreate() {
      $errors = array();
      if (strlen(trim($this->mensaje)) < 2 ) {  $errors["mensaje"] = "mensaje is mandatory";}
      if ($this->autor == NULL ) {              $errors["autor"] = "chat is mandatory";}
      if ($this->chat == NULL ) {	            $errors["chat"] = "chat is mandatory";}
      if (sizeof($errors) > 0){	                throw new ValidationException($errors, "mensaje is not valid");}
  }
}
