<?php

/**
 * User Table Block.
 *
 * @package    block_user_table
 * @copyright  2024 Roman Milko <rvmilko@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use block_user_table\controllers\UserTableController;

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
        $userListAction = \block_user_table\controllers\UserTableController::getInstance('UserListAction');

        if ($this->content !== NULL) {
            return $this->content;
        }

        $userList = $userListAction->execute();

        $this->content = new stdClass;
        $this->content->text = $userList;

        return $this->content;
    }
}
