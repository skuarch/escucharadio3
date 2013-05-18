<?php 

	require_once 'EscucharadioConnection.php';
	require_once 'PHPUnit/Framework.php';


	class Test extends PHPUnit_Framework_TestCase {


			function testExecuteQuery(){

				$c = new EscucharadioConnection();
				$array = $c->executeQuery("or 1=1;");

				$this->assertEquals(0, sizeof($array));
				
			}


	}
