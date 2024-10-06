<?php

namespace block_user_table\controllers;
abstract class AbstractAction
{
    abstract public function execute();

    public static function getInstance()
    {
        return new static();
    }
}
