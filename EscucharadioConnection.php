<?php

require_once 'Connection.php';

class EscucharadioConnection extends Connection {
    
    /* private $username = "root";
      private $password = "vitalnoc";
      private $server = "localhost";
      private $database = "escucharadio"; */

    private $username = "escuchar";
    private $password = "3scch4ra";
    private $server = "escucharadio.com.mx";
    private $database = "escuchar_escucharadio";

    //==========================================================================
    public function __construct() {
        parent::__construct($this->username, $this->password, $this->server, $this->database);
    }

}

?>
