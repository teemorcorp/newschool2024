<?php
class UpdateNotes {

    private $con;
    private $errorArray = array();

    public function __construct($con) {
        $this->con = $con;
    }

    public function PDO_con($nt, $ns) {
    
        // Create connection
        $con = new mysqli('localhost', 'school2', '1nh15nam3', 'school2');
        // Check connection
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
    
        $id = 1;
        $sql = "UPDATE notes SET newstitle=?, news=? WHERE noteid=?";
        $stmt= $con->prepare($sql);
        $stmt->bind_param("ssi", $newstitle, $news, $id);
        $stmt->execute();
        return;
    }

}
?>