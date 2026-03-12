<?php
/**
 * Decor Dreams - Configuration and contact loader
 * Reads company contacts from text file(s)
 */

// Path to contacts file (relative to project root)
define('CONTACTS_FILE', dirname(__DIR__) . '/data/contacts.txt');

/**
 * Load and parse contacts from text file
 * @return array Parsed contact sections
 */
function load_contacts() {
    $contacts = [];
    if (!file_exists(CONTACTS_FILE)) {
        return [['title' => 'Contacts', 'lines' => ['Contact file not found.']]];
    }
    $content = file_get_contents(CONTACTS_FILE);
    $lines = explode("\n", $content);
    $current_section = ['title' => 'General', 'lines' => []];
    foreach ($lines as $line) {
        $line = rtrim($line);
        if (preg_match('/^---\s*(.+?)\s*---$/', $line, $m)) {
            if (!empty($current_section['lines'])) {
                $contacts[] = $current_section;
            }
            $current_section = ['title' => trim($m[1]), 'lines' => []];
        } elseif (strlen(trim($line)) > 0 && strpos($line, '===') !== 0) {
            $current_section['lines'][] = $line;
        }
    }
    if (!empty($current_section['lines'])) {
        $contacts[] = $current_section;
    }
    return $contacts;
}
