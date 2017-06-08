<?php
class Victorina {
    public $id = null;
    public $score = null;
    public $question = null;
    public $answer = null;
    
    public function __construct( $data=array() ) {
	if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
	if ( isset( $data['score'] ) ) $this->score = (int) $data['score'];
	if ( isset( $data['answer'] ) ) $this->answer = $data['answer'];
        if ( isset( $data['question'] ) ) $this->question =  $data['question'];
        }
        
    public static function getList($param,$sql) {
	$st = $param->prepare( $sql );
	$st->execute();
	$list=0;
	while ( $row = $st->fetch() ) {
	    $book = new Victorina($row);
	    if (!empty($book))
	    return ($book);
	    
	    }
	    $param = null;
#         $list = $book -> question;
#	}
#	$param = null;
#	return ($list);
	
    }
    
    public function insert($param,$user,$score) {
	if( !is_null($this->id)) trigger_error ("Book::insert(): Attempt to insert a Book object that already has its ID property set (to $this->id");
	 $sql = 'select * from users';
	 $st = $param->prepare($sql);
	 $st->execute();
	 $i = 0;

	    $sql = "insert into users (user,score) values ('$user','$score')";
        $st = $param->prepare($sql);
        $st->execute();
        $this->id=$param->lastInsertId();
        $added = "ok";
    $param = null;
    return $added;
    }


}
?>