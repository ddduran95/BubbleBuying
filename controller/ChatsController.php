<?php
//file: controller/ChatController.php

require_once(__DIR__."/../model/Mensaje.php");
require_once(__DIR__."/../model/Chat.php");
require_once(__DIR__."/../model/ChatMapper.php");
require_once(__DIR__."/../model/User.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

/**
 * Class ChatsController
 *
 * Controller to make a CRUDL of Chats entities
 *
 * @author lipido <lipido@gmail.com>
 */
class ChatsController extends BaseController {

  /**
   * Reference to the ChatMapper to interact
   * with the database
   *
   * @var ChatMapper
   */
  private $chatMapper;

  public function __construct() {
    parent::__construct();

    $this->chatMapper = new ChatMapper();
  }

  /**
   * Action to list chats
   *
   * Loads all the chats from the database.
   * No HTTP parameters are needed.
   *
   * The views are:
   * <ul>
   * <li>chats/index (via include)</li>
   * </ul>
   */
  public function index() {

    // obtain the data from the database
    $chats = $this->chatMapper->findAll();

    // put the array containing Chat object to the view
    $this->view->setVariable("chats", $chats);

    // render the view (/view/chats/index.php)
    $this->view->render("chats", "index");
  }

  /**
   * Action to view a given chat
   *
   * This action should only be called via GET
   *
   * The expected HTTP parameters are:
   * <ul>
   * <li>id: Id of the chat (via HTTP GET)</li>
   * </ul>
   *
   * The views are:
   * <ul>
   * <li>chats/view: If chat is successfully loaded (via include).  Includes these view variables:</li>
   * <ul>
   *  <li>chat: The current Chat retrieved</li>
   *  <li>mensaje: The current Mensaje instance, empty or
   *  being added (but not validated)</li>
   * </ul>
   * </ul>
   *
   * @throws Exception If no such chat of the given id is found
   * @return void
   *
   */
  public function view(){
    if (!isset($_GET["id"])) {
      throw new Exception("id is mandatory");
    }

    $chatid = $_GET["id"];

    // find the Chat object in the database
    $chat = $this->chatMapper->findByIdWithMensajes($chatid);

    if ($chat == NULL) {
      throw new Exception("no such chat with id: ".$chatid);
    }

    // put the Chat object to the view
    $this->view->setVariable("chat", $chat);

    // check if mensaje is already on the view (for example as flash variable)
    // if not, put an empty Mensaje for the view
    $mensaje = $this->view->getVariable("mensaje");
    $this->view->setVariable("mensaje", ($mensaje==NULL)?new Mensaje():$mensaje);

    // render the view (/view/chats/view.php)
    $this->view->render("chats", "view");

  }

  /**
   * Action to add a new chat
   *
   * When called via GET, it shows the add form
   * When called via POST, it adds the chat to the
   * database
   *
   * The expected HTTP parameters are:
   * <ul>
   * <li>title: Title of the chat (via HTTP POST)</li>
   * <li>content: Content of the chat (via HTTP POST)</li>
   * </ul>
   *
   * The views are:
   * <ul>
   * <li>chats/add: If this action is reached via HTTP GET (via include)</li>
   * <li>chats/index: If chat was successfully added (via redirect)</li>
   * <li>chats/add: If validation fails (via include). Includes these view variables:</li>
   * <ul>
   *  <li>chat: The current Chat instance, empty or
   *  being added (but not validated)</li>
   *  <li>errors: Array including per-field validation errors</li>
   * </ul>
   * </ul>
   * @throws Exception if no user is in session
   * @return void
   */
  public function add() {
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Adding chats requires login");
    }

    $chat = new Chat();

    if (isset($_POST["submit"])) { // reaching via HTTP Chat...

      // populate the Chat object with data form the form
      $chat->setTitle($_POST["title"]);
      $chat->setContent($_POST["content"]);

      // The user of the Chat is the currentUser (user in session)
      $chat->setAuthor($this->currentUser);

      try {
	// validate Chat object
	$chat->checkIsValidForCreate(); // if it fails, ValidationException

	// save the Chat object into the database
	$this->chatMapper->save($chat);

	// POST-REDIRECT-GET
	// Everything OK, we will redirect the user to the list of chats
	// We want to see a message after redirection, so we establish
	// a "flash" message (which is simply a Session variable) to be
	// get in the view after redirection.
	$this->view->setFlash(sprintf(i18n("Chat \"%s\" successfully added."),$chat ->getTitle()));

	// perform the redirection. More or less:
	// header("Location: index.php?controller=chats&action=index")
	// die();
	$this->view->redirect("chats", "index");

      }catch(ValidationException $ex) {
	// Get the errors array inside the exepction...
	$errors = $ex->getErrors();
	// And put it to the view as "errors" variable
	$this->view->setVariable("errors", $errors);
      }
    }

    // Put the Chat object visible to the view
    $this->view->setVariable("chat", $chat);

    // render the view (/view/chats/add.php)
    $this->view->render("chats", "add");

  }

  /**
   * Action to edit a chat
   *
   * When called via GET, it shows an edit form
   * including the current data of the Chat.
   * When called via POST, it modifies the chat in the
   * database.
   *
   * The expected HTTP parameters are:
   * <ul>
   * <li>id: Id of the chat (via HTTP POST and GET)</li>
   * <li>title: Title of the chat (via HTTP POST)</li>
   * <li>content: Content of the chat (via HTTP POST)</li>
   * </ul>
   *
   * The views are:
   * <ul>
   * <li>chats/edit: If this action is reached via HTTP GET (via include)</li>
   * <li>chats/index: If chat was successfully edited (via redirect)</li>
   * <li>chats/edit: If validation fails (via include). Includes these view variables:</li>
   * <ul>
   *  <li>chat: The current Chat instance, empty or being added (but not validated)</li>
   *  <li>errors: Array including per-field validation errors</li>
   * </ul>
   * </ul>
   * @throws Exception if no id was provided
   * @throws Exception if no user is in session
   * @throws Exception if there is not any chat with the provided id
   * @throws Exception if the current logged user is not the author of the chat
   * @return void
   */
  public function edit() {
    if (!isset($_REQUEST["id"])) {
      throw new Exception("A chat id is mandatory");
    }

    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Editing chats requires login");
    }


    // Get the Chat object from the database
    $chatid = $_REQUEST["id"];
    $chat = $this->chatMapper->findById($chatid);

    // Does the chat exist?
    if ($chat == NULL) {
      throw new Exception("no such chat with id: ".$chatid);
    }

    // Check if the Chat author is the currentUser (in Session)
    if ($chat->getAuthor() != $this->currentUser) {
      throw new Exception("logged user is not the author of the chat id ".$chatid);
    }

    if (isset($_POST["submit"])) { // reaching via HTTP Chat...

      // populate the Chat object with data form the form
      $chat->setTitle($_POST["title"]);
      $chat->setContent($_POST["content"]);

      try {
	// validate Chat object
	$chat->checkIsValidForUpdate(); // if it fails, ValidationException

	// update the Chat object in the database
	$this->chatMapper->update($chat);

	// POST-REDIRECT-GET
	// Everything OK, we will redirect the user to the list of chats
	// We want to see a message after redirection, so we establish
	// a "flash" message (which is simply a Session variable) to be
	// get in the view after redirection.
	$this->view->setFlash(sprintf(i18n("Chat \"%s\" successfully updated."),$chat ->getTitle()));

	// perform the redirection. More or less:
	// header("Location: index.php?controller=chats&action=index")
	// die();
	$this->view->redirect("chats", "index");

      }catch(ValidationException $ex) {
	// Get the errors array inside the exepction...
	$errors = $ex->getErrors();
	// And put it to the view as "errors" variable
	$this->view->setVariable("errors", $errors);
      }
    }

    // Put the Chat object visible to the view
    $this->view->setVariable("chat", $chat);

    // render the view (/view/chats/add.php)
    $this->view->render("chats", "edit");
  }

  /**
   * Action to delete a chat
   *
   * This action should only be called via HTTP POST
   *
   * The expected HTTP parameters are:
   * <ul>
   * <li>id: Id of the chat (via HTTP POST)</li>
   * </ul>
   *
   * The views are:
   * <ul>
   * <li>chats/index: If chat was successfully deleted (via redirect)</li>
   * </ul>
   * @throws Exception if no id was provided
   * @throws Exception if no user is in session
   * @throws Exception if there is not any chat with the provided id
   * @throws Exception if the author of the chat to be deleted is not the current user
   * @return void
   */
  public function delete() {
    if (!isset($_POST["id"])) {
      throw new Exception("id is mandatory");
    }
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Editing chats requires login");
    }

     // Get the Chat object from the database
    $chatid = $_REQUEST["id"];
    $chat = $this->chatMapper->findById($chatid);

    // Does the chat exist?
    if ($chat == NULL) {
      throw new Exception("no such chat with id: ".$chatid);
    }

    // Check if the Chat author is the currentUser (in Session)
    if ($chat->getAuthor() != $this->currentUser) {
      throw new Exception("Chat author is not the logged user");
    }

    // Delete the Chat object from the database
    $this->chatMapper->delete($chat);

    // POST-REDIRECT-GET
    // Everything OK, we will redirect the user to the list of chats
    // We want to see a message after redirection, so we establish
    // a "flash" message (which is simply a Session variable) to be
    // get in the view after redirection.
    $this->view->setFlash(sprintf(i18n("Chat \"%s\" successfully deleted."),$chat ->getTitle()));

    // perform the redirection. More or less:
    // header("Location: index.php?controller=chats&action=index")
    // die();
    $this->view->redirect("chats", "index");

  }
}
