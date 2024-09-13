<?php

namespace lib\models;

use lib\models\DBManager;

/**
 * Abstract class that centralise all methods common to all DB entities managers. It automatically gets the DB manager.
 */
abstract class AbstractEntityManager
{
    protected $db;

    /**
     * Class constructor.
     * It automatically gets DBManager instance.
     */
    public function __construct()
    {
        $this->db = DBManager::getInstance();
    }
}