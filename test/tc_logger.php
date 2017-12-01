<?php
class TcLogger extends TcBase{
	function test(){
		global $LOGGER_CONFIGURATION; // see initialize.php

		$this->_test_log_file_creation(new Logger("robot"),"default.log");

		//

		$this->_test_log_file_creation(new Logger("cache_remover"),"cache_remover.log");

		//
		 
		$this->_test_log_file_creation(new Logger("import_data"),"import.log");

		//
		$this->_test_log_file_creation(new Logger("special_robot"),"default.log");
		$this->_test_log_file_creation(new Logger("special_robot",array("default_log_file" => __DIR__."/log/another.log")),"another.log");

		$LOGGER_CONFIGURATION["special_robot"] = array(
			"log_file" => __DIR__."/log/special.log",
		);

		$this->_test_log_file_creation(new Logger("special_robot"),"special.log");
		$this->_test_log_file_creation(new Logger("special_robot",array("default_log_file" => __DIR__."/log/another.log")),"special.log");
	}

	function _test_log_file_creation($logger,$log_name){
		$this->assertFalse(file_exists($f = __DIR__."/log/$log_name"));

		$logger->start();
		$logger->info("doing some normal job");
		$logger->error("Damn, this is bad!");
		$logger->stop();
		$logger->flushAll();

		$this->assertTrue(file_exists($f));

		$content = Files::GetFileContent($f);

		$this->assertContains("START",$content);
		$this->assertContains("doing some normal job",$content);
		$this->assertContains("ERROR: Damn, this is bad!",$content);
		$this->assertContains("STOP",$content);

		unlink($f);
	}

	function test_levels(){
		$logger = new Logger();

		$this->assertEquals("error",$logger->level_to_str("4"));
		$this->assertEquals(4,$logger->level_to_int("error"));

		$this->assertEquals("#d00b00",$logger->level_to_color(4));
		$this->assertEquals("#d00b00",$logger->level_to_color("4"));
		$this->assertEquals("#d00b00",$logger->level_to_color("error"));

		$this->assertEquals("#c66905",$logger->level_to_color("warn"));
		$this->assertEquals("#c66905",$logger->level_to_color("warn++"));
		$this->assertEquals("#c66905",$logger->level_to_color("2"));
		$this->assertEquals("#c66905",$logger->level_to_color("3"));
	}
}
