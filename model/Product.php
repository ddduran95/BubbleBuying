<?php
// file: model/Post.php

require_once(__DIR__."/../core/ValidationException.php");

/**
 * Class Post
 *
 * Represents a Post in the blog. A Post was written by an
 * specific User (author) and contains a list of Comments
 *
 * @author samu
 */
class Product {

  /**
   * The id of this product
   * @var string
   */
  private $id;

  /**
   * The title of this product
   * @var string
   */
  private $titulo;

  /**
   * The desxription of this product
   * @var string
   */
  private $descripcion;

  /**
   * The prize of this product
   * @var User
   */
  private $precio;

  /**
   * The photo of this product
   * @var mixed
   */
  private $foto;

  /**
   * The seller of this product
   * @var mixed
   */
  private $vendedor;

  /**
   * The constructor
   *
   * @param string $id The id of the post
   * @param string $title The id of the post
   * @param string $content The content of the post
   * @param User $author The author of the post
   * @param mixed $comments The list of comments
   */
  public function __construct($id=NULL, $titulo=NULL, $descripcion=NULL, User $vendedor=NULL, $precio=NULL, $foto=NULL) {
    $this->id = $id;
    $this->titulo = $titulo;
    $this->descripcion = $descripcion;
    $this->vendedor = $vendedor;
    $this->precio = $precio;
    $this->foto = $foto;

  }

  /**
   * Gets the id of this post
   *
   * @return string The id of this post
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Gets the title of this post
   *
   * @return string The title of this post
   */
  public function getTitulo() {
    return $this->titulo;
  }

  /**
   * Sets the title of this post
   *
   * @param string $title the title of this post
   * @return void
   */
  public function setTitulo($titulo) {
    $this->titulo = $titulo;
  }

  /**
   * Gets the content of this post
   *
   * @return string The content of this post
   */
  public function getDescripcion() {
    return $this->descripcion;
  }

  /**
   * Sets the content of this post
   *
   * @param string $content the content of this post
   * @return void
   */
  public function setDescripcion($descripcion) {
    $this->descripcion = $descripcion;
  }

  /**
   * Gets the author of this post
   *
   * @return User The author of this post
   */
  public function getVendedor() {
    return $this->vendedor;
  }

  /**
   * Sets the author of this post
   *
   * @param User $author the author of this post
   * @return void
   */
  public function setVendedor(User $vendedor) {
    $this->vendedor = $vendedor;
  }

  /**
   * Gets the list of comments of this post
   *
   * @return mixed The list of comments of this post
   */
  public function getFoto() {
    return $this->foto;
  }

  /**
   * Sets the comments of the post
   *
   * @param mixed $comments the comments list of this post
   * @return void
   */
  public function setFoto($foto) {
    $this->foto = $foto;
  }

  public function getPrecio() {
    return $this->precio;
  }

  public function setPrecio($precio) {
    $this->precio = $precio;
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
      if (strlen(trim($this->titulo)) == 0 ) {
	       $errors["title"] = "title is mandatory";
      }
      if (strlen(trim($this->descripcion)) == 0 ) {
	       $errors["description"] = "content is mandatory";
      }
      if ($this->vendedor == NULL ) {
	       $errors["seller"] = "author is mandatory";
      }
      if (strlen(trim($this->precio))) {
	       $errors["prize"] = "prize is mandatory";
      }
      if (strlen(trim($this->foto)) ){
	       $errors["photo"] = "photo is mandatory";
      }

      if (sizeof($errors) > 0){
	       throw new ValidationException($errors, "product is not valid");
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
      throw new ValidationException($errors, "product is not valid");
    }
  }
}
