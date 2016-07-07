<?php
namespace vipnytt\RobotsTxtParser;

/**
 * Interface SQLInterface
 *
 * @package vipnytt\RobotsTxtParser
 */
interface SQLInterface
{
    /**
     * MySQL driver name
     */
    const DRIVER_MYSQL = 'mysql';

    /**
     * Encoding
     */
    const SQL_ENCODING = 'utf8';

    /**
     * Cache table name
     */
    const TABLE_CACHE = 'robotstxt__cache1';

    /**
     * Delay table name
     */
    const TABLE_DELAY = 'robotstxt__delay0';

    /**
     * SQL Readme
     */
    const README_SQL = 'https://github.com/VIPnytt/RobotsTxtParser/blob/master/docs/sql/README.md';

    /**
     * Delay readme
     */
    const README_SQL_CACHE = 'https://github.com/VIPnytt/RobotsTxtParser/blob/master/docs/sql/cache.md';

    /**
     * Delay readme
     */
    const README_SQL_DELAY = 'https://github.com/VIPnytt/RobotsTxtParser/blob/master/docs/sql/delay.md';
}