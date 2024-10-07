<?php

use block_user_table\controller\UserTableController;

defined('MOODLE_INTERNAL') || die();

/**
 * The user table block class
 */
class block_user_table extends block_base {
    function init(): void
    {
        $this->title = get_string('pluginname', 'block_user_table');
    }

    /**
     * @throws Exception
     */
    function get_content(): ?stdClass
    {
        if ($this->content !== NULL) {
            return $this->content;
        }

        $this->content = new stdClass;
        $this->content->text = '';


        $userListAction = UserTableController::getInstance('UserListAction');

        $this->content->text = $userListAction->execute();

        $this->content->footer = '';

        return $this->content;
    }
}
