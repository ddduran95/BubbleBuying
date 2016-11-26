<?php
//file: controller/PostController.php

require_once(__DIR__."/../model/Comment.php");
require_once(__DIR__."/../model/Post.php");
require_once(__DIR__."/../model/PostMapper.php");
require_once(__DIR__."/../model/User.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

/**
 * Class PostsController
 *
 * Controller to make a CRUDL of Posts entities
 *
 * @author lipido <lipido@gmail.com>
 */
class ProductController extends BaseController {

  /**
   * Reference to the PostMapper to interact
   * with the database
   *
   * @var PostMapper
   */
  private $productMapper;

  public function __construct() {
    parent::__construct();

    $this->productMapper = new ProductMapper();
  }

  /**
   * Action to list posts
   *
   * Loads all the posts from the database.
   * No HTTP parameters are needed.
   *
   * The views are:
   * <ul>
   * <li>posts/index (via include)</li>
   * </ul>
   */
  public function index() {

    // obtain the data from the database
    $products = $this->productMapper->findAll();

    // put the array containing Product object to the view
    $this->view->setVariable("products", $products);

    // render the view (/view/products/index.php)
    $this->view->render("products", "index");
  }

  /**
   * Action to view a given post
   *
   * This action should only be called via GET
   *
   * The expected HTTP parameters are:
   * <ul>
   * <li>id: Id of the post (via HTTP GET)</li>
   * </ul>
   *
   * The views are:
   * <ul>
   * <li>posts/view: If post is successfully loaded (via include).  Includes these view variables:</li>
   * <ul>
   *  <li>post: The current Post retrieved</li>
   *  <li>comment: The current Comment instance, empty or
   *  being added (but not validated)</li>
   * </ul>
   * </ul>
   *
   * @throws Exception If no such post of the given id is found
   * @return void
   *
   */
  public function view(){
    if (!isset($_GET["id"])) {
      throw new Exception("id is mandatory");
    }

    $productid = $_GET["id"];

    // find the Product object in the database
    $product = $this->productMapper->findById($productid);

    if ($product == NULL) {
      throw new Exception("no such product with id: ".$productid);
    }

    // put the Product object to the view
    $this->view->setVariable("product", $product);

    // check if comment is already on the view (for example as flash variable)
    // if not, put an empty Comment for the view

    /* ESTO SOBRA
    $comment = $this->view->getVariable("comment");
    $this->view->setVariable("comment", ($comment==NULL)?new Comment():$comment);
    */

    // render the view (/view/products/view.php)
    $this->view->render("products", "view");

  }

  /**
   * Action to add a new post
   *
   * When called via GET, it shows the add form
   * When called via POST, it adds the post to the
   * database
   *
   * The expected HTTP parameters are:
   * <ul>
   * <li>title: Title of the post (via HTTP POST)</li>
   * <li>content: Content of the post (via HTTP POST)</li>
   * </ul>
   *
   * The views are:
   * <ul>
   * <li>posts/add: If this action is reached via HTTP GET (via include)</li>
   * <li>posts/index: If post was successfully added (via redirect)</li>
   * <li>posts/add: If validation fails (via include). Includes these view variables:</li>
   * <ul>
   *  <li>post: The current Post instance, empty or
   *  being added (but not validated)</li>
   *  <li>errors: Array including per-field validation errors</li>
   * </ul>
   * </ul>
   * @throws Exception if no user is in session
   * @return void
   */
  public function add() {
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Adding products requires login");
    }

    $product = new Post();

    if (isset($_POST["submit"])) { // reaching via HTTP Post...

      // populate the Post object with data form the form
      $product->setTitulo($_POST["title"]);
      $product->setContent($_POST["description"]);
      $product->setPrecio($_POST["prize"]);
      $product->setFoto($_POST["photo"]);

      // The user of the Post is the currentUser (user in session)
      $product->setVendedor($this->currentUser);

      try {
      	// validate Post object
      	$product->checkIsValidForCreate(); // if it fails, ValidationException

      	// save the Product object into the database
      	$this->productMapper->save($product);

      	// POST-REDIRECT-GET
      	// Everything OK, we will redirect the user to the list of products
      	// We want to see a message after redirection, so we establish
      	// a "flash" message (which is simply a Session variable) to be
      	// get in the view after redirection.
      	$this->view->setFlash(sprintf(i18n("Product \"%s\" successfully added."),$product ->getTitulo()));

      	// perform the redirection. More or less:
      	// header("Location: index.php?controller=products&action=index")
      	// die();
      	$this->view->redirect("products", "index");

      }catch(ValidationException $ex) {
      	// Get the errors array inside the exepction...
      	$errors = $ex->getErrors();
      	// And put it to the view as "errors" variable
      	$this->view->setVariable("errors", $errors);
      }
    }

    // Put the Product object visible to the view
    $this->view->setVariable("product", $product);

    // render the view (/view/product/add.php)
    $this->view->render("product", "add");

  }

  /**
   * Action to edit a post
   *
   * When called via GET, it shows an edit form
   * including the current data of the Post.
   * When called via POST, it modifies the post in the
   * database.
   *
   * The expected HTTP parameters are:
   * <ul>
   * <li>id: Id of the post (via HTTP POST and GET)</li>
   * <li>title: Title of the post (via HTTP POST)</li>
   * <li>content: Content of the post (via HTTP POST)</li>
   * </ul>
   *
   * The views are:
   * <ul>
   * <li>posts/edit: If this action is reached via HTTP GET (via include)</li>
   * <li>posts/index: If post was successfully edited (via redirect)</li>
   * <li>posts/edit: If validation fails (via include). Includes these view variables:</li>
   * <ul>
   *  <li>post: The current Post instance, empty or being added (but not validated)</li>
   *  <li>errors: Array including per-field validation errors</li>
   * </ul>
   * </ul>
   * @throws Exception if no id was provided
   * @throws Exception if no user is in session
   * @throws Exception if there is not any post with the provided id
   * @throws Exception if the current logged user is not the author of the post
   * @return void
   */
  public function edit() {
    if (!isset($_REQUEST["id"])) {
      throw new Exception("A product id is mandatory");
    }

    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Editing products requires login");
    }


    // Get the Product object from the database
    $productid = $_REQUEST["id"];
    $product = $this->productMapper->findById($productid);

    // Does the post exist?
    if ($product == NULL) {
      throw new Exception("no such product with id: ".$productid);
    }

    // Check if the Post author is the currentUser (in Session)
    if ($product->getVendedor() != $this->currentUser) {
      throw new Exception("logged user is not the seller of the product id ".$productid);
    }

    if (isset($_POST["submit"])) { // reaching via HTTP Post...

      // populate the Post object with data form the form
      $product->setTitulo($_POST["title"]);
      $product->setDescripcion($_POST["description"]);
      $product->setPrecio($_POST["prize"]);
      $product->setFoto($_POST["photo"]);

      try {
      	// validate Post object
      	$product->checkIsValidForUpdate(); // if it fails, ValidationException

      	// update the Post object in the database
      	$this->productMapper->update($product);

      	// POST-REDIRECT-GET
      	// Everything OK, we will redirect the user to the list of posts
      	// We want to see a message after redirection, so we establish
      	// a "flash" message (which is simply a Session variable) to be
      	// get in the view after redirection.
      	$this->view->setFlash(sprintf(i18n("Product \"%s\" successfully updated."),$product ->getTitulo()));

      	// perform the redirection. More or less:
      	// header("Location: index.php?controller=posts&action=index")
      	// die();
      	$this->view->redirect("products", "index");

      }catch(ValidationException $ex) {
      	// Get the errors array inside the exepction...
      	$errors = $ex->getErrors();
      	// And put it to the view as "errors" variable
      	$this->view->setVariable("errors", $errors);
      }
    }

    // Put the Product object visible to the view
    $this->view->setVariable("product", $product);

    // render the view (/view/products/edit.php)
    $this->view->render("products", "edit");
  }

  /**
   * Action to delete a post
   *
   * This action should only be called via HTTP POST
   *
   * The expected HTTP parameters are:
   * <ul>
   * <li>id: Id of the post (via HTTP POST)</li>
   * </ul>
   *
   * The views are:
   * <ul>
   * <li>posts/index: If post was successfully deleted (via redirect)</li>
   * </ul>
   * @throws Exception if no id was provided
   * @throws Exception if no user is in session
   * @throws Exception if there is not any post with the provided id
   * @throws Exception if the author of the post to be deleted is not the current user
   * @return void
   */
  public function delete() {
    if (!isset($_POST["id"])) {
      throw new Exception("id is mandatory");
    }
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Deleting products requires login");
    }

     // Get the Post object from the database
    $productid = $_REQUEST["id"];
    $product = $this->productMapper->findById($productid);

    // Does the post exist?
    if ($product == NULL) {
      throw new Exception("no such product with id: ".$productid);
    }

    // Check if the Post author is the currentUser (in Session)
    if ($product->getVendedor() != $this->currentUser) {
      throw new Exception("Product seller is not the logged user");
    }

    // Delete the Product object from the database
    $this->productMapper->delete($product);

    // POST-REDIRECT-GET
    // Everything OK, we will redirect the user to the list of posts
    // We want to see a message after redirection, so we establish
    // a "flash" message (which is simply a Session variable) to be
    // get in the view after redirection.
    $this->view->setFlash(sprintf(i18n("Product \"%s\" successfully deleted."),$product ->getTitulo()));

    // perform the redirection. More or less:
    // header("Location: index.php?controller=posts&action=index")
    // die();
    $this->view->redirect("products", "index");

  }
}
