ATK14 Logger
============

ATK14 Logger provides logging infrastructure for the ATK14 Framework.

Basic usage
-----------

    define("LOGGER_DEFAULT_LOG_FILE","/path/to/app/log/log");
    define("LOGGER_DEFAULT_NOTIFY_EMAIL","webmaster@example.com");

    $logger = new Logger("import_articles");

    // do something

    $logger->info("Total articles to import ".sizeof($articles));

    // in order to write buffered messages to a file, just call flush() method
    $logger->flush();

    // a the end of a script call flushAll();
    $logger->flushAll();

Levels of messages importance
-----------------------------

    $logger->debug("some debug information");
    $logger->info("a message");
    $logger->warn("a warning");
    $logger->error("error message");
    $logger->security("a security message");
