<?php

/**
 * Perform the post-install procedures.
 */
function xmldb_block_user_table_install() {
    global $DB;

    // Disable user_table on new installs by default.
    $DB->set_field('block', 'visible', 0, ['name' => 'user_table']);
}
