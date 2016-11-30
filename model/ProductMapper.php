<?php
// file: model/PostMapper.php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Post.php");
require_once(__DIR__."/../model/Comment.php");
require_once(__DIR__."/../model/Product.php");


/**
 * Class PostMapper
 *
 * Database interface for Post entities
 *
 * @author lipido <lipido@gmail.com>
 */
class ProductMapper {

  /**
   * Reference to the PDO connection
   * @var PDO
   */
  private $db;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }

  /**
   * Retrieves all posts
   *
   * Note: Comments are not added to the Post instances
   *
   * @throws PDOException if a database error occurs
   * @return mixed Array of Post instances (without comments)
   */
  public function findAll() {
    $stmt = $this->db->query("SELECT * FROM usuario, producto WHERE usuario.alias = producto.vendedor");
    $products_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $products = array();

    foreach ($products_db as $product) {
      //Suponiendo que la clase para Usuario se acabe llamando User
      $vendedor = new User($product["nombre"], $product["alias"], $product["password"], $product["perfil"]);
      array_push($products, new Product($product["id_producto"], $product["titulo"], $product["descripcion"], $vendedor,
      $product["precio"], $product["foto"]));
    }

    return $products;
  }

  /**
   * Loads a Post from the database given its id
   *
   * Note: Comments are not added to the Post
   *
   * @throws PDOException if a database error occurs
   * @return Post The Post instances (without comments). NULL
   * if the Post is not found
   */
  public function findById($productid){
    $stmt = $this->db->prepare("SELECT * FROM producto WHERE id=?");
    $stmt->execute(array($productid));
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if($product != null) {
      //Suponiendo que la clase para Usuario se acabe llamando User
      return new Product($product["id"], $product["titulo"], $product["descripcion"], new User($product["author"],
      $product["precio"], $product["foto"]));
    } else {
      return NULL;
    }
  }

  /**
   * Loads a Post from the database given its id
   *
   * It includes all the comments
   *
   * @throws PDOException if a database error occurs
   * @return Post The Post instances (without comments). NULL
   * if the Post is not found
   */

  /* ESTE EN PRINCIPIO NO HACE FALTA NADA PARECIDO
  public function findByIdWithComments($postid){
    $stmt = $this->db->prepare("SELECT
	P.id as 'post.id',
	P.title as 'post.title',
	P.content as 'post.content',
	P.author as 'post.author',
	C.id as 'comment.id',
	C.content as 'comment.content',
	C.post as 'comment.post',
	C.author as 'comment.author'

	FROM posts P LEFT OUTER JOIN comments C
	ON P.id = C.post
	WHERE
	P.id=? ");

    $stmt->execute(array($postid));
    $post_wt_comments= $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (sizeof($post_wt_comments) > 0) {
      $post = new Post($post_wt_comments[0]["post.id"],
		       $post_wt_comments[0]["post.title"],
		       $post_wt_comments[0]["post.content"],
		       new User($post_wt_comments[0]["post.author"]));
      $comments_array = array();
      if ($post_wt_comments[0]["comment.id"]!=null) {
        foreach ($post_wt_comments as $comment){
          $comment = new Comment( $comment["comment.id"],
                                  $comment["comment.content"],
                                  new User($comment["comment.author"]),
                                  $post);
          array_push($comments_array, $comment);
        }
      }
      $post->setComments($comments_array);

      return $post;
    }else {
      return NULL;
    }
  }
*/
  /**
   * Saves a Post into the database
   *
   * @param Post $post The post to be saved
   * @throws PDOException if a database error occurs
   * @return int The mew post id
   */
  public function save(Product $product) {
    $stmt = $this->db->prepare("INSERT INTO product(titulo, descripcion, precio, foto, id, vendedor) values (?,?,?,?,?,?,?)");
    $stmt->execute(array($product->getTitulo(), $product->getDescripcion(), $product->getPrecio(), $product->getFoto(),
    $product->getId(), $product->getVendedor()->getAlias()));
    return $this->db->lastInsertId();
  }

  /**
   * Updates a Post in the database
   *
   * @param Post $post The post to be updated
   * @throws PDOException if a database error occurs
   * @return void
   */
  public function update(Product $product) {
    $stmt = $this->db->prepare("UPDATE producto set titulo=?, descripcion=?, precio=?, foto=? where id=?");
    $stmt->execute(array($product->getTitulo(), $product->getDescripcion(), $product->getPrecio(), $product->getFoto(),
    $product->getId()));
  }

  /**
   * Deletes a Post into the database
   *
   * @param Post $post The post to be deleted
   * @throws PDOException if a database error occurs
   * @return void
   */
  public function delete(Product $product) {
    $stmt = $this->db->prepare("DELETE from product WHERE id=?");
    $stmt->execute(array($product->getId()));
  }

}
