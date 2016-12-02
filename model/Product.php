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
  private $title;

  /**
   * The desxription of this product
   * @var string
   */
  private $description;

  /**
   * The prize of this product
   * @var User
   */
  private $prize;

  /**
   * The photo of this product
   * @var mixed
   */
  private $photo;

  /**
   * The seller of this product
   * @var mixed
   */
  private $seller;

  private $category;


  /**
   * The constructor
   *
   * @param string $id The id of the post
   * @param string $title The id of the post
   * @param string $content The content of the post
   * @param User $author The author of the post
   * @param mixed $comments The list of comments
   */
  public function __construct($id=NULL, $title=NULL, $description=NULL, User $seller=NULL, $prize=NULL, $photo=NULL, $category=NULL) {
    $this->id = $id;
    $this->title = $title;
    $this->description = $description;
    $this->seller = $seller;
    $this->prize = $prize;
    $this->photo = $photo;
    $this->category = $category;

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
  public function getTitle() {
    return $this->title;
  }

  /**
   * Sets the title of this post
   *
   * @param string $title the title of this post
   * @return void
   */
  public function setTitle($title) {
    $this->title = $title;
  }

  /**
   * Gets the content of this post
   *
   * @return string The content of this post
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * Sets the content of this post
   *
   * @param string $content the content of this post
   * @return void
   */
  public function setDescription($description) {
    $this->description = $description;
  }

  /**
   * Gets the author of this post
   *
   * @return User The author of this post
   */
  public function getSeller() {
    return $this->seller;
  }

  /**
   * Sets the author of this post
   *
   * @param User $author the author of this post
   * @return void
   */
  public function setSeller(User $seller) {
    $this->seller = $seller;
  }

  /**
   * Gets the list of comments of this post
   *
   * @return mixed The list of comments of this post
   */
  public function getPhoto() {
    return $this->photo;
  }

  /**
   * Sets the comments of the post
   *
   * @param mixed $comments the comments list of this post
   * @return void
   */
  public function setPhoto($photo) {
    $this->photo = $photo;
  }

  public function getPrize() {
    return $this->prize;
  }

  public function setPrize($prize) {
    $this->prize = $prize;
  }

  public function getCategory() {
    return $this->category;
  }

  public function setCategory($category) {
    $this->category = $category;
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
      if (strlen(trim($this->title)) == 0 ) {
	       $errors["title"] = i18n("Title is mandatory.");
      }
      if (strlen(trim($this->title)) > 15 ) {
	       $errors["title"] = i18n("The title must be less than 15 characters");
      }
      if (strlen(trim($this->description)) == 0 ) {
	       $errors["description"] = i18n("Description is mandatory.");
      }
      if ($this->seller == NULL ) {
	       $errors["seller"] = i18n("Seller is mandatory.");
      }
      if (strlen(trim($this->prize)) == 0) {
	       $errors["prize"] = i18n("Prize is mandatory.");
      }
      if (strlen(trim($this->photo)) == 0 ){
	       $errors["photo"] = i18n("Image is mandatory.");
      }

      if (sizeof($errors) > 0){
	       throw new ValidationException($errors, "product is not valid");
      }
  }


}
