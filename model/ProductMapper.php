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
      $product["precio"], $product["foto"], $product["categoria"]));
    }

    return $products;
  }

  public function findCategory($category) {
    $stmt = $this->db->prepare("SELECT * FROM usuario, producto WHERE usuario.alias = producto.vendedor AND producto.categoria=?");
    $stmt->execute(array($category));
    $products_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $products = array();

    foreach ($products_db as $product) {
      //Suponiendo que la clase para Usuario se acabe llamando User
      $vendedor = new User($product["nombre"], $product["alias"], $product["password"], $product["perfil"]);
      array_push($products, new Product($product["id_producto"], $product["titulo"], $product["descripcion"], $vendedor,
      $product["precio"], $product["foto"], $product["categoria"]));
    }

    return $products;
  }

  public function findSearch($search) {
    $stmt = $this->db->query("SELECT * FROM usuario, producto WHERE usuario.alias = producto.vendedor AND
      (producto.categoria LIKE '%$search%' OR
        producto.titulo LIKE '%$search%' OR
          producto.vendedor LIKE '%$search%' OR
              producto.descripcion LIKE '%$search%')");
    $products_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $products = array();

    foreach ($products_db as $product) {
      //Suponiendo que la clase para Usuario se acabe llamando User
      $vendedor = new User($product["nombre"], $product["alias"], $product["password"], $product["perfil"]);
      array_push($products, new Product($product["id_producto"], $product["titulo"], $product["descripcion"], $vendedor,
      $product["precio"], $product["foto"], $product["categoria"]));
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
    $stmt = $this->db->prepare("SELECT * FROM producto, usuario WHERE usuario.alias=producto.vendedor AND producto.id_producto=?");
    $stmt->execute(array($productid));
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if($product != null) {
      //Suponiendo que la clase para Usuario se acabe llamando User
      return new Product($product["id_producto"], $product["titulo"], $product["descripcion"], new User(NULL,$product["vendedor"],NULL,$product["perfil"]),
      $product["precio"], $product["foto"]);

    } else {
      return NULL;
    }
  }

  public function findBySeller($sellerAlias){
    $stmt = $this->db->prepare("SELECT * FROM producto WHERE vendedor=?");
    $stmt->execute(array($sellerAlias));
    $products_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt2 = $this->db->prepare("SELECT * FROM usuario WHERE alias=?");
    $stmt2->execute(array($sellerAlias));
    $user_db = $stmt2->fetch(PDO::FETCH_ASSOC);
    $user = new User ($user_db ["nombre"], $user_db ["alias"], $user_db ["password"], $user_db ["perfil"]);

    $products = array();

    foreach ($products_db as $product) {

      array_push($products, new Product($product["id_producto"], $product["titulo"], $product["descripcion"],
      $user, $product["precio"], $product["foto"], $product["categoria"]));
    }

    return $products;
  }

  public function save(Product $product) {
    $stmt = $this->db->prepare("INSERT INTO producto (titulo, descripcion, precio, foto, id_producto, vendedor, categoria) values (?,?,?,?,?,?,?)");
    $stmt->execute(array($product->getTitle(), $product->getDescription(), $product->getPrize(), $product->getPhoto(),
    $product->getId(), $product->getSeller()->getName(), $product->getCategory()));
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
    $stmt = $this->db->prepare("UPDATE producto set titulo=?, descripcion=?, precio=?, foto=? where id_producto=?");
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
    $stmt = $this->db->prepare("DELETE from producto WHERE id_producto=?");
    $stmt->execute(array($product->getId()));
  }

}
