<?php
class Category {
    public $id = null;
    public $name = null;
        
    
    public function __construct( $data=array() ) {
	if (isset($data['id'])) $this->id = (int) $data['id'];
	if (isset($data['name'])) $this->name = $data['name'];
    }
    
    public function storeFormValues ( $params ) {
    
        // Store all the parameters
            $this->__construct( $params );
    }

    public static function getList($param) {
	$sql = "select * from categories";
	$st = $param->prepare($sql);
	$st->execute();
	$list = array();
	while ($row = $st->fetch()) {
	    $category = new Category($row);
	    $list[] =  $category;
	    
	}
	$param = null;
        return ( array ( "results" => $list));
    }
    public function insert($param) {
	 // У объекта Category уже есть ID?
        if ( !is_null( $this->id ) ) trigger_error ( "Category::insert(): Attempt to insert a Category object that already has its ID property set (to $this->id).", E_USER_ERROR );
        // Вставляем категорию
        $sql = 'select * from categories';
        $st = $param->prepare($sql);
        $st->execute();
        $i = 0;
        $a = $this->name;
        while ($row = $st -> fetch()) {
    	    $category = new Category($row);
    	    if ($a == $category->name) {
    	    $i++;
    	    }
         }
        if ($i == 0) {
    	    $sql = 'insert into categories (name) values (:name)';
    	    $st = $param->prepare($sql);
    	    $st->bindValue(':name', $this->name, PDO::PARAM_STR);
    	    $st->execute();
    	    $this->id = $conn->lastInsertId();
    	    self::konec("added");
          }
        else {
    	    self::konec("notadded");
    	    
        }
        $param = null;
    }
    public function konec($a) {
	header ("Location: addCategory.php?action=$a");
    }
}

?>
