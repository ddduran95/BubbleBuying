<?php
// file: model/ChatMapper.php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../model/Chat.php");
require_once(__DIR__."/../model/Mensaje.php");
require_once(__DIR__."/../model/Product.php");
require_once(__DIR__."/../model/ProductMapper.php");

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
  public function findAll(User $currentuser) {
    $stmt = $this->db->query("SELECT * FROM chat, usuario WHERE (usuario.alias = chat.vendedor OR usuario.alias = chat.comprador) AND usuario.alias = '{$currentuser->getAlias()}'");
    $chat_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $chats = array();
    $UserMapper = new UserMapper();
    $ProductMapper = new ProductMapper();
    if($chat_db != null) {
      foreach ($chat_db as $chat) {
        $producto = $ProductMapper->findById($chat["producto"]);
        $vendedor = $UserMapper->findByAlias($chat["vendedor"]);
        $comprador = $UserMapper->findByAlias($chat["comprador"]);
        $chats[$chat["chat"]] = new Chat($chat["chat"], $producto, $comprador, $vendedor);
      }
      return $chats;
    }else {
      return NULL;
    }

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
    $stmt = $this->db->prepare("SELECT * FROM chat WHERE chat=?");
    $stmt->execute(array($chatid));
    $chat = $stmt->fetch(PDO::FETCH_ASSOC);

    if($chat != null) {
        $UserMapper = new UserMapper();
        $ProductMapper = new ProductMapper();
        $producto = $ProductMapper->findById($chat["producto"]);
        $vendedor = $UserMapper->findByAlias($chat["vendedor"]);
        $comprador = $UserMapper->findByAlias($chat["comprador"]);
        $chat = new Chat($chat["chat"], $producto, $comprador, $vendedor);
        return $chat;
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
  public function findByIdWithMensajes($chatid){
    $stmt = $this->db->prepare("SELECT
	C.chat as 'chat.chat',
	C.producto as 'chat.producto',
	C.Comprador as 'chat.comprador',
	C.vendedor as 'chat.vendedor',
	M.chat as 'mensaje.chat',
	M.autor as 'mensaje.autor',
    M.mensaje as 'mensaje.mensaje',
	M.tiempo as 'mensaje.tiempo'

	FROM chat C LEFT OUTER JOIN mensajes M ON C.chat = M.chat
	WHERE C.chat=?
    ORDER BY M.tiempo");

    $stmt->execute(array($chatid));
    $chat_wt_mensajes= $stmt->fetchAll(PDO::FETCH_ASSOC);

    $UserMapper = new UserMapper();
    $ProductMapper = new ProductMapper();

    if (sizeof($chat_wt_mensajes) > 0) {

        $producto = $ProductMapper->findById($chat_wt_mensajes[0]["chat.producto"]);
        $vendedor = $UserMapper->findByAlias($chat_wt_mensajes[0]["chat.vendedor"]);
        $comprador = $UserMapper->findByAlias($chat_wt_mensajes[0]["chat.comprador"]);

        $mensajes_array = array();
        if ($chat_wt_mensajes[0]["mensaje.chat"]!=null) {
            foreach ($chat_wt_mensajes as $mensaje){
                $chat_id = $mensaje["mensaje.chat"];
                $contenido =  $mensaje["mensaje.mensaje"];
                $autor = $mensaje["mensaje.autor"];
                $tiempo = $mensaje["mensaje.tiempo"];

                $mensaje = new Mensaje($autor,$this->findById($chat_id),$contenido,$tiempo);
                array_push($mensajes_array, $mensaje);
            }
        }

      $chat = new Chat($chat_wt_mensajes[0]["chat.chat"], $producto, $comprador, $vendedor,$mensajes_array);
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
    $stmt = $this->db->prepare("INSERT INTO chat(producto, comprador, vendedor) values (?,?,?)");
    $stmt->execute(array($chat->getProduct()->getId(), $chat->getComprador()->getAlias(), $chat->getVendedor()->getAlias()));
    return $this->db->lastInsertId();
  }

  /**
   * checkIfExist a Chat in the database
   *
   * @param Chat $chat The chat to be checked
   * @throws PDOException if a database error occurs
   * @return void
   */
  public function checkIfExist(Chat $chat) {
    $stmt = $this->db->prepare("SELECT * FROM chat WHERE producto = ? AND vendedor = ? AND comprador = ?");
    $stmt->execute(array($chat->getProduct()->getId(), $chat->getVendedor()->getAlias(), $chat->getComprador()->getAlias()));
    $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(sizeof($array) == 1)
        return $array[0]["chat"];
    else
        return "no_existe";
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
