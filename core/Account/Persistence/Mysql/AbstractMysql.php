<?php
namespace Core\Account\Persistence\Mysql;

abstract class AbstractMysql
{
    protected $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }
}
