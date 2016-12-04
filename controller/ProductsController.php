<?php
//file: controller/PostController.php

require_once(__DIR__."/../model/Comment.php");
require_once(__DIR__."/../model/Post.php");
require_once(__DIR__."/../model/ProductMapper.php");
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
class ProductsController extends BaseController {

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
    if (isset($_GET["category"])){
      $products = $this->productMapper->findCategory($_GET["category"]);

    }else if (isset($_POST["search"])){
      $products = $this->productMapper->findSearch($_POST["search"]);
    }else{
      $products = $this->productMapper->findAll();
    }

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
 public function viewMyProducts(){

    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. See your products requires login");
        $this->view->render("users", "login");
    }
    // find the Product object in the database


    if(isset($_GET["alias"])){
      $products = $this->productMapper->findBySeller($_GET["alias"]);
    }else{
      $products = $this->productMapper->findBySeller($this->currentUser->getAlias());
    }
    // put the Product object to the view
    $this->view->setVariable("products", $products);

    // check if comment is already on the view (for example as flash variable)
    // if not, put an empty Comment for the view

    /* ESTO SOBRA
    $comment = $this->view->getVariable("comment");
    $this->view->setVariable("comment", ($comment==NULL)?new Comment():$comment);
    */

    // render the view (/view/products/myproducts.php)
    $this->view->render("products", "myproducts");

  }

  public function view(){

    if (!isset($_GET["id"])) {
			throw new Exception("id is mandatory");
		}
		$productid = $_GET["id"];
    // find the Product object in the database
    $product = $this->productMapper->findById($productid);


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

    $product = new Product();

    if (isset($_POST["submit"])) { // reaching via HTTP Post...

      // populate the Post object with data form the form
      $product->setTitle($_POST["title"]);
      $product->setDescription($_POST["description"]);
      $product->setPrize($_POST["prize"]);
      $product->setCategory($_POST["category"]);

      //Upload image to server if everything's ok
      if ($_FILES['photo']['name'] != NULL){
        $target_dir = 'imgs/producto/';
        $target_file = $target_dir . basename($_FILES['photo']['name']);
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        $temp = explode (".", $_FILES['photo']['name']);
        $nombreImagen = round (microtime(true)) . '.' . end($temp);
        // Comprueba la longitud del archivo
        if ($_FILES["photo"]["size"] > 1000000 ) {
            throw new Exception("Image is too big to be uploaded");
        }
        // Permiso de tipos de imagenes: JPG, JPEG, PNG & GIF
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG"
        && $imageFileType != "GIF" ) {
            throw new Exception("Format of this image is not allowed");
        }

      }else{
        $nombreImagen = null;
      }



      $product->setPhoto($nombreImagen);

      // The user of the Post is the currentUser (user in session)
      $product->setSeller($this->currentUser);

      try {
      	// validate Post object
      	$product->checkIsValidForCreate(); // if it fails, ValidationException

        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_dir . $nombreImagen);

      	// save the Product object into the database
      	$this->productMapper->save($product);

      	// POST-REDIRECT-GET
      	// Everything OK, we will redirect the user to the list of products
      	// We want to see a message after redirection, so we establish
      	// a "flash" message (which is simply a Session variable) to be
      	// get in the view after redirection.
      	$this->view->setFlash(sprintf(i18n("Product \"%s\" successfully added."),$product ->getTitle()));

      	// perform the redirection. More or less:
      	// header("Location: index.php?controller=products&action=index")
      	// die();
      	$this->view->redirect("products", "viewmyproducts");

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
    $this->view->render("products", "add");

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
    if (!isset($_GET["product_id"])) {
      throw new Exception("id is mandatory");
    }
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Deleting products requires login");
    }

     // Get the Post object from the database
    $productid = $_REQUEST["product_id"];
    $product = $this->productMapper->findById($productid);

    // Does the post exist?
    if ($product == NULL) {
      throw new Exception("no such product with id: ".$productid);
    }

    // Check if the Post author is the currentUser (in Session)
    if ($product->getSeller()->getAlias() != $this->currentUser->getAlias()) {
      throw new Exception("Product seller is not the logged user");
    }

    // Delete the Product object from the database
    $this->productMapper->delete($product);

    // POST-REDIRECT-GET
    // Everything OK, we will redirect the user to the list of posts
    // We want to see a message after redirection, so we establish
    // a "flash" message (which is simply a Session variable) to be
    // get in the view after redirection.
    $this->view->setFlash(sprintf(i18n("Product \"%s\" successfully deleted."),$product ->getTitle()));

    // perform the redirection. More or less:
    // header("Location: index.php?controller=posts&action=index")
    // die();
    $this->view->redirect("products", "index");

  }
}
