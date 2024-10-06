<?php

/**
 * Privacy Subsystem implementation for block_user_table.
 *
 * @package    block_user_table
 * @copyright  2024 Roman Milko <rvmilko@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_user_table\privacy;

defined('MOODLE_INTERNAL') || die();

/**
 * Privacy Subsystem for block_user_table implementing null_provider.
 *
 * @copyright  2024 Roman Milko <rvmilko@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements \core_privacy\local\metadata\null_provider {

    /**
     * Get the language string identifier with the component's language
     * file to explain why this plugin stores no data.
     *
     * @return  string
     */
    public static function get_reason(): string {
        return 'privacy:metadata';
    }
}
