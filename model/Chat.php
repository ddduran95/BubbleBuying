<?php
// file: model/Chat.php

require_once(__DIR__."/../core/ValidationException.php");

/**
 * Class Chat
 *
 * Represents a Chat in the blog. A Chat was written by an
 * specific User (vendedor) and contains a list of Comments
 *
 * @vendedor lipido <lipido@gmail.com>
 */
class Chat {

  /**
   * The id of this chat
   * @var string
   */
  private $id;

  /**
   * The $product of this chat
   * @var Product
   */
  private $product;

  /**
   * The comprador of this chat
   * @var User
   */
  private $comprador;

  /**
   * The vendedor of this chat
   * @var User
   */
  private $vendedor;

  /**
   * The list of mensajes of this chat
   * @var mixed
   */
  private $mensajes;

  /**
   * The constructor
   *
   * @param string $id The id of the chat
   * @param string $product The id of the chat
   * @param string $comprador The comprador of the chat
   * @param User $vendedor The vendedor of the chat
   * @param mixed $mensajes The list of mensajes
   */
  public function __construct($id=NULL,Product $product=NULL, User $comprador=NULL, User $vendedor=NULL, array $mensajes=NULL) {
    $this->id = $id;
    $this->product = $product;
    $this->comprador = $comprador;
    $this->vendedor = $vendedor;
    $this->mensajes = $mensajes;

  }

  /**
   * Gets the id of this chat
   *
   * @return string The id of this chat
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Gets the Product of this chat
   *
   * @return Product The Product of this chat
   */
  public function getProduct() {
    return $this->product;
  }

  /**
   * Sets the Product of this chat
   *
   * @param string $product the Product of this chat
   * @return void
   */
  public function setProduct(Product $product) {
    $this->product = $product;
  }

  /**
   * Gets the comprador of this chat
   *
   * @return User The comprador of this chat
   */
  public function getComprador() {
    return $this->comprador;
  }

  /**
   * Sets the comprador of this chat
   *
   * @param string $comprador the comprador of this chat
   * @return void
   */
  public function setComprador(User $comprador) {
    $this->comprador = $comprador;
  }

  /**
   * Gets the vendedor of this chat
   *
   * @return User The vendedor of this chat
   */
  public function getVendedor() {
    return $this->vendedor;
  }

  /**
   * Sets the vendedor of this chat
   *
   * @param User $vendedor the vendedor of this chat
   * @return void
   */
  public function setVendedor(User $vendedor) {
    $this->vendedor = $vendedor;
  }

  /**
   * Gets the other user of this chat

   * @param User $user the other user of this chat
   * @return User The vendedor/Buyer of this chat
   */
   public function getOther($currentuser) {
     if($this->getComprador()->getAlias() == $currentuser)
        return $this->getVendedor();
    else
        return $this->getComprador();
   }

  /**
   * Gets the list of mensajes of this chat
   *
   * @return mixed The list of mensajes of this chat
   */
  public function getMensajes() {
    return $this->mensajes;
  }

  /**
   * Sets the mensajes of the chat
   *
   * @param mixed $mensajes the mensajes list of this chat
   * @return void
   */
  public function setMensajes(array $mensajes) {
    $this->mensajes = $mensajes;
  }

  /**
   * Checks if the current instance is valid
   * for being updated in the database.
   *
   * @throws ValidationException if the instance is
   * not valid
   *
   * @return void
   */
  public function checkIsValidForCreate() {
      $errors = array();
      if ($this->product == NULL ) {
	$errors["product"] = "Product is mandatory";
      }
       if ($this->comprador == NULL ) {
	$errors["comprador"] = "comprador is mandatory";
      }
      if ($this->vendedor == NULL ) {
	$errors["vendedor"] = "vendedor is mandatory";
      }

      if (sizeof($errors) > 0){
	throw new ValidationException($errors, "chat is not valid");
      }
  }

  /**
   * Checks if the current instance is valid
   * for being updated in the database.
   *
   * @throws ValidationException if the instance is
   * not valid
   *
   * @return void
   */
  public function checkIsValidForUpdate() {
    $errors = array();

    if (!isset($this->id)) {
      $errors["id"] = "id is mandatory";
    }

    try{
      $this->checkIsValidForCreate();
    }catch(ValidationException $ex) {
      foreach ($ex->getErrors() as $key=>$error) {
	$errors[$key] = $error;
      }
    }
    if (sizeof($errors) > 0) {
      throw new ValidationException($errors, "chat is not valid");
    }
  }
}
