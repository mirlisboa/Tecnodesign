<?php
/**
 * Database abstraction
 *
 * PHP version 5.6
 *
 * @category  Database
 * @package   Model
 * @author    Guilherme Capilé, Tecnodesign <ti@tecnodz.com>
 * @copyright 2016 Tecnodesign
 * @link      https://tecnodz.com/
 */
class Tecnodesign_Query_Mysql extends Tecnodesign_Query_Sql
{
    public static $options=array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_PERSISTENT => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ),
    $tableDefault='ENGINE=InnoDB DEFAULT CHARSET=utf8';
}