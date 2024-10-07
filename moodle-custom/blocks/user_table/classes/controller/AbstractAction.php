<?php

namespace block_user_table\controller;

abstract class AbstractAction
{
    abstract public function execute();

    public static function getInstance()
    {
        return new static();
    }
}
