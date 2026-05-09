<?php
define("TEST",true);
define("LOGGER_DEFAULT_LOG_FILE",__DIR__."/log/default.log");
define("SENDMAIL_DO_NOT_SEND_MAILS",true);

require("../src/logger.php");
require("./logger_proxy.php");
require("../vendor/autoload.php");

$LOGGER_CONFIGURATION = [
	"cache_remover" => [
		"log_file" => __DIR__."/log/cache_remover.log",
	],
	"import_*" => [
		"notify_email" => "import.notification@doe.com",
		"log_file" => __DIR__."/log/import.log",
	],
];
