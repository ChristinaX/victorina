<?php
class Users {
    public $id = null;
    public $user = null;
     public $score = null;
    public $added = null;
    public function __construct( $data=array() ) {
	if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
	if ( isset( $data['user'] ) ) $this->user =  $data['user'];
	if ( isset( $data['score'] ) ) $this->score =  $data['score'];
    }

    public function storeFormValues ( $params ) {

        // Store all the parameters
            $this->__construct( $params );
    }

    public function insert($param,$user) {
	 // У объекта Category уже есть ID?
        if ( !is_null( $this->id ) ) trigger_error ( "Category::insert(): Attempt to insert a Category object that already has its ID property set (to$this->id).", E_USER_ERROR );
        // Вставляем категорию
        $sql = 'select * from users';
        $st = $param->prepare($sql);
        $st->execute();
        $i = 0;
        $a = $user;
	if (!empty($a)) {
	
        while ($row = $st -> fetch()) {
	    $category = new Users($row);
	    if ($a == $category->user) {
		$i++;
	    }
         }
        if ($i == 0) {
	    $sql = "insert into users (user) values ('$user')";
#	    $sql = 'insert into users (user) values (:user)';
	    $st = $param->prepare($sql);
#	    $st->bindValue(':user', $this->user, PDO::PARAM_STR);
	    $st->execute();
#	    $this->id = $conn->lastInsertId();
	    $this->id=$param->lastInsertId();
#	    self::konec("added",$a);
	    $this -> added = 'added';
	}
        else {
	    $this -> added = 'notadded';
#	    self::konec("notadded",$a);
        }
	}
	else {
	    $this -> added = 'empty';
#	    self::konec("empty",$a);
	}
	return $this->added;
        $param = null;
    }
    public function konec($a,$b) {
	header ("Location: victorina.php?action=$a&user=$b");
    }
    public function addScore($param,$score,$user) {
	if ( !is_null( $this->id ) ) trigger_error ( "Category::insert(): Attempt to insert a Category object that already has its ID property set (to$this->id).", E_USER_ERROR );
	$sql = "update users set score='$score' where user='$user'";
	$st = $param->prepare($sql);
	$st->execute();
	$param = null;
    }
    public static function getScore($param,$sql) {
#	$sql = "select score from users where user='$user'";
	$st = $param->prepare($sql);
	$st->execute();
	while ($row = $st->fetch()) {
	    $score = new Users($row);
	    return $score->score;
#	    if (!empty($score)) {
	
	}
	$param = null;
#        return ($score);
    }

    public static function getList($param,$sql) {
        $st = $param->prepare( $sql );
	$st->execute();
	$list = array();
	while ( $row = $st->fetch() ) {
	    $book = new Users( $row );
	    $list[] = $book;
	}
	$param = null;
	return ( array ( "results" => $list ) );
    }
}
?>