<?php

require_once('main.php');
require_once('backend/conf/init.php');

use framework\components\DatabaseConnection;

$usersTable = 'users';

DatabaseConnection::get()->execute(<<<QUERY
CREATE TABLE IF NOT EXISTS `{$usersTable}` (
    `id` BIGINT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `birth_date` INT NOT NULL
)ENGINE=InnoDB;
QUERY
);

DatabaseConnection::get()->execute(<<<QUERY
INSERT INTO `{$usersTable}` (`name`, `email`, `birth_date`) VALUES
    ('John, Doe1', 'dummy1@mail.com', 1498387957),
    ('John, Doe2', 'dummy2@mail.com', 1498387957),
    ('John, Doe3', 'dummy3@mail.com', 1498387957),
    ('John, Doe4', 'dummy4@mail.com', 1498387957);
QUERY
);
