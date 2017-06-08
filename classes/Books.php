<?php
class Book {
    public $id = null;
    public $categoryId = null;
    public $author = null;
    public $title = null;
    public $file = null;
    
    public function __construct( $data=array() ) {
	if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
	if ( isset( $data['categoryId'] ) ) $this->categoryId = (int) $data['categoryId'];
	if ( isset( $data['author'] ) ) $this->author = $data['author'];
	if ( isset( $data['title'] ) ) $this->title =  $data['title'];
	if ( isset( $data['file'] ) ) $this->file =  $data['file'];
    }
    
    public function storeFormValues ( $params ) {
    
        // Store all the parameters
            $this->__construct( $params );
    }
    
    public static function getById( $id ) {
	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD);
	$sql = "select * from books where id = :id";
	$st = $conn->prepare($sql);
	$st->bindValue( ":id", $id, PDO::PARAM_INT );
	$st->execute();
	$row = $st->fetch();
	$conn = null;
	if ( $row ) return new Books( $row );
	
    }
    
    public static function getList($param,$sql) {
	$st = $param->prepare( $sql );
	$st->execute();
	$list = array();
	while ( $row = $st->fetch() ) {
	    $book = new Book( $row );
	    $list[] = $book;
	}
	$param = null;
	return ( array ( "results" => $list ) );
    }
    
    
    public function insert($param) {
	if ( !is_null($this->id)) trigger_error ("Book::insert(): Attempt to insert a Book object that already has its ID property set (to $this->id).", E_USER_ERROR);
	 $sql = 'select * from books';
	 $st = $param->prepare($sql);
	$st->execute();
	 $i = 0;
         $a = $this->title;
         while ($row = $st -> fetch()) {
        $category = new Book($row);
        if ($a == $category->title) {
        $i++;
        }
      }
      if ($i == 0) {
	$sql = "insert into books (categoryId, author, title, file) values (:categoryId,:author,:title,:file)";
        $st = $param->prepare($sql);
        $st->bindValue(":categoryId", $this->categoryId, PDO::PARAM_INT );
        $st->bindValue(":author", $this->author, PDO::PARAM_STR );
        $st->bindValue(":title", $this->title, PDO::PARAM_STR );
        $st->bindValue(":file", $this->file, PDO::PARAM_STR );
        $st->execute();
        $this->id=$param->lastInsertId();
        $added = "ok";
    }
    else {
	$added = "notok";
    }
    $param = null;
    return $added;
    }
    
     
    
    public function update() {
	if ( is_null( $this->id ) ) trigger_error ( "Book::update(): Attempt to update an Article object that does not have its ID property set.", E_USER_ERROR );
	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD);
	$sql = "update books set categoryId =:categoryId, author=:author,title=:title where id=:id";
	$st = $conn->prepare($sql);
	 $st->bindValue( ":categoryId", $this->categoryId, PDO::PARAM_INT );
	 $st->bindValue( ":author", $this->author, PDO::PARAM_STR );
	 $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
	 $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
	 $st->execute();
	 $conn = null;
	
	
    }
    
    public function delete() {
	if ( is_null( $this->id ) ) trigger_error ( "Book::delete(): Attempt to delete an Article object that does not have its ID property set.", E_USER_ERROR );
	// Delete the Book
	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
	$st = $conn->prepare ( "DELETE FROM articles WHERE id = :id LIMIT 1" );
	$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
	$st->execute();
	$conn = null;
	                        
    }
}
?>