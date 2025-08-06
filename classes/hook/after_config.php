<?php
namespace local_banner_messages\hook;

defined('MOODLE_INTERNAL') || die();

class after_config {
    public static function execute(): void {
        global $CFG;
        require_once($CFG->dirroot.'/local/banner_messages/lib.php');
    }
}