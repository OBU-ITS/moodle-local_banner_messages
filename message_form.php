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
defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');

class local_banner_messages_message_form extends moodleform {

    /**
     * Define the form.
     */

    public function definition() {
        global $USER;

        if ((strpos($USER->profile['person_holds'], 'F3')) && (strpos($USER->profile['person_holds'], 'RX')) && (strpos($USER->profile['person_holds'], 'V2')) == true) {
            $bannerholdmessage = get_string('academicholdmessage', 'local_banner_messages');
            $bannerholdmessage = $bannerholdmessage.get_string('joinstring', 'local_banner_messages');
            $bannerholdmessage = $bannerholdmessage.get_string('financeholdmessage', 'local_banner_messages');
            $bannerholdmessage = $bannerholdmessage.get_string('joinstring', 'local_banner_messages');
            $bannerholdmessage = $bannerholdmessage.get_string('visaholdmessage', 'local_banner_messages');
        }
        else if ((strpos($USER->profile['person_holds'], 'F3')) && (strpos($USER->profile['person_holds'], 'RX')) == true) {
            $bannerholdmessage = get_string('academicholdmessage', 'local_banner_messages');
            $bannerholdmessage = $bannerholdmessage.get_string('joinstring', 'local_banner_messages');
            $bannerholdmessage = $bannerholdmessage.get_string('financeholdmessage', 'local_banner_messages');
        }
        else if ((strpos($USER->profile['person_holds'], 'F3')) && (strpos($USER->profile['person_holds'], 'V2')) == true) {
            $bannerholdmessage = get_string('financeholdmessage', 'local_banner_messages');
            $bannerholdmessage = $bannerholdmessage.get_string('joinstring', 'local_banner_messages');
            $bannerholdmessage = $bannerholdmessage.get_string('visaholdmessage', 'local_banner_messages');
        }
        else if ((strpos($USER->profile['person_holds'], 'RX')) && (strpos($USER->profile['person_holds'], 'V2')) == true) {
            $bannerholdmessage = get_string('academicholdmessage', 'local_banner_messages');
            $bannerholdmessage = $bannerholdmessage.get_string('joinstring', 'local_banner_messages');
            $bannerholdmessage = $bannerholdmessage.get_string('visaholdmessage', 'local_banner_messages');
        }
        else if ((strpos($USER->profile['person_holds'], 'RX')) == true) {
            $bannerholdmessage = get_string('academicholdmessage', 'local_banner_messages');
        }
        else if ((strpos($USER->profile['person_holds'], 'F3')) == true) {
            $bannerholdmessage = get_string('financeholdmessage', 'local_banner_messages');
        }
        else if ((strpos($USER->profile['person_holds'], 'V2')) == true) {
            $bannerholdmessage = get_string('visaholdmessage', 'local_banner_messages');
        }

        $mform    = $this->_form; // Don't forget the underscore!

        $mform->addElement('html', $bannerholdmessage);
        $mform->addElement('hidden', 'understand', 'yes');
        $buttonlabel = get_string('acknowledge', 'local_banner_messages');
        $mform->addElement('submit', 'submitmessage', $buttonlabel);

    }


}
