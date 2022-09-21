<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * $local_banner_messages file description here.
 *
 * @package    local_banner_messages
 * @copyright  2022 Jock Coats <jock.coats@brookes.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$GLOBALS['banner_holds'] = 1;

require_once('../../config.php');
require_once($CFG->dirroot. '/local/banner_messages/message_form.php');

if ($USER->id == 0) {
    redirect(new moodle_url('/'));
}

$PAGE->set_context(context_system::instance());
$PAGE->set_url(new moodle_url('/local/banner_messages/banner_holds.php'));
$messageform = new local_banner_messages_message_form();

if ($data = $messageform->get_data()) {
    if ($data->understand == 'yes') {
        $GLOBALS['banner_holds'] = 0;
        require_logout();
        redirect(new moodle_url('/'));
    }
}

$PAGE->set_pagelayout('base');
$PAGE->set_title($SITE->fullname);
$PAGE->set_heading(get_string('bannerholdsheader', 'local_banner_messages'));


echo $OUTPUT->header();
$messageform->display();
echo $OUTPUT->footer();
