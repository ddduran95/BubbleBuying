<?php
// file: model/ChatMapper.php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Chat.php");
require_once(__DIR__."/../model/Mensaje.php");
require_once(__DIR__."/../model/Product.php");

/**
 * Class ChatMapper
 *
 * Database interface for Chat entities
 *
 * @vendedor lipido <lipido@gmail.com>
 */
class ChatMapper {

  /**
   * Reference to the PDO connection
   * @var PDO
   */
  private $db;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }

  /**
   * Retrieves all chat
   *
   * Note: Mensajess are not added to the Chat instances
   *
   * @throws PDOException if a database error occurs
   * @return mixed Array of Chat instances (without mensajes)
   */
  public function findAll() {
    $stmt = $this->db->query("SELECT * FROM chat, usuario WHERE usuario.alias = chat.vendedor");
    $chat_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $chats = array();

    foreach ($chat_db as $chat) {
      $producto = new Product($chat["producto"]);
      $vendedor = new User($chat["vendedor"]);
      $comprador = new User($chat["comprador"]);

      array_push($chats, new Chat($chat["chat"], $producto, $comprador, $vendedor));
    }

    return $chats;
  }

  /**
   * Loads a Chat from the database given its id
   *
   * Note: Mensajess are not added to the Chat
   *
   * @throws PDOException if a database error occurs
   * @return Chat The Chat instances (without mensajes). NULL
   * if the Chat is not found
   */
  public function findById($chatid){
    $stmt = $this->db->prepare("SELECT * FROM chat WHERE id=?");
    $stmt->execute(array($chatid));
    $chat = $stmt->fetch(PDO::FETCH_ASSOC);

    if($chat != null) {
      return new Chat(
	$chat["id"],
	$chat["title"],
	$chat["content"],
	new User($chat["vendedor"]));
    } else {
      return NULL;
    }
  }

  /**
   * Loads a Chat from the database given its id
   *
   * It includes all the mensajes
   *
   * @throws PDOException if a database error occurs
   * @return Chat The Chat instances (without mensajes). NULL
   * if the Chat is not found
   */
  public function findByIdWithMensajess($chatid){
    $stmt = $this->db->prepare("SELECT
	P.id as 'chat.id',
	P.title as 'chat.title',
	P.content as 'chat.content',
	P.vendedor as 'chat.vendedor',
	C.id as 'comment.id',
	C.content as 'comment.content',
	C.chat as 'comment.chat',
	C.vendedor as 'comment.vendedor'

	FROM chat P LEFT OUTER JOIN mensajes C
	ON P.id = C.chat
	WHERE
	P.id=? ");

    $stmt->execute(array($chatid));
    $chat_wt_mensajes= $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (sizeof($chat_wt_mensajes) > 0) {
      $chat = new Chat($chat_wt_mensajes[0]["chat.id"],
		       $chat_wt_mensajes[0]["chat.title"],
		       $chat_wt_mensajes[0]["chat.content"],
		       new User($chat_wt_mensajes[0]["chat.vendedor"]));
      $mensajes_array = array();
      if ($chat_wt_mensajes[0]["comment.id"]!=null) {
        foreach ($chat_wt_mensajes as $comment){
          $comment = new Mensajes( $comment["comment.id"],
                                  $comment["comment.content"],
                                  new User($comment["comment.vendedor"]),
                                  $chat);
          array_push($mensajes_array, $comment);
        }
      }
      $chat->setMensajess($mensajes_array);

      return $chat;
    }else {
      return NULL;
    }
  }

  /**
   * Saves a Chat into the database
   *
   * @param Chat $chat The chat to be saved
   * @throws PDOException if a database error occurs
   * @return int The mew chat id
   */
  public function save(Chat $chat) {
    $stmt = $this->db->prepare("INSERT INTO chat(title, content, vendedor) values (?,?,?)");
    $stmt->execute(array($chat->getTitle(), $chat->getContent(), $chat->getAuthor()->getUsername()));
    return $this->db->lastInsertId();
  }

  /**
   * Updates a Chat in the database
   *
   * @param Chat $chat The chat to be updated
   * @throws PDOException if a database error occurs
   * @return void
   */
  public function update(Chat $chat) {
    $stmt = $this->db->prepare("UPDATE chat set title=?, content=? where id=?");
    $stmt->execute(array($chat->getTitle(), $chat->getContent(), $chat->getId()));
  }

  /**
   * Deletes a Chat into the database
   *
   * @param Chat $chat The chat to be deleted
   * @throws PDOException if a database error occurs
   * @return void
   */
  public function delete(Chat $chat) {
    $stmt = $this->db->prepare("DELETE from chat WHERE id=?");
    $stmt->execute(array($chat->getId()));
  }

}
