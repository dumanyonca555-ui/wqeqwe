<?php
/**
 * Multi-Language System
 * Centralized language loading and translation functions
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Default language
$default_lang = 'en';

// Get current language from session, fallback to default
$current_lang = $_SESSION['lang'] ?? $default_lang;

// Validate language (only allow 'en' and 'tr')
if (!in_array($current_lang, ['en', 'tr'])) {
    $current_lang = $default_lang;
    $_SESSION['lang'] = $current_lang;
}

// Load translation array
$translations = [];
$lang_file = __DIR__ . "/../lang/{$current_lang}.php";

if (file_exists($lang_file)) {
    $translations = include $lang_file;
} else {
    // Fallback to English if language file doesn't exist
    $fallback_file = __DIR__ . "/../lang/en.php";
    if (file_exists($fallback_file)) {
        $translations = include $fallback_file;
    }
}

// Translation function
function __($key, $default = null) {
    global $translations;
    
    if (isset($translations[$key])) {
        return $translations[$key];
    }
    
    // Return default value or key itself if not found
    return $default !== null ? $default : $key;
}

// Echo translation function (for direct output)
function _e($key, $default = null) {
    echo __($key, $default);
}

// Get current language
function get_current_language() {
    global $current_lang;
    return $current_lang;
}

// Set language
function set_language($lang) {
    if (in_array($lang, ['en', 'tr'])) {
        $_SESSION['lang'] = $lang;
        return true;
    }
    return false;
}

// Get language name
function get_language_name($lang = null) {
    if ($lang === null) {
        $lang = get_current_language();
    }
    
    $names = [
        'en' => 'English',
        'tr' => 'Türkçe'
    ];
    
    return $names[$lang] ?? 'English';
}

// Get language flag
function get_language_flag($lang = null) {
    if ($lang === null) {
        $lang = get_current_language();
    }
    
    $flags = [
        'en' => '🇺🇸',
        'tr' => '🇹🇷'
    ];
    
    return $flags[$lang] ?? '🇺🇸';
}

// Check if language is Turkish
function is_turkish() {
    return get_current_language() === 'tr';
}

// Check if language is English
function is_english() {
    return get_current_language() === 'en';
}

// Get all available languages
function get_available_languages() {
    return [
        'en' => [
            'name' => 'English',
            'flag' => '🇺🇸',
            'code' => 'en'
        ],
        'tr' => [
            'name' => 'Türkçe',
            'flag' => '🇹🇷',
            'code' => 'tr'
        ]
    ];
}

// Format number according to language
function format_number($number, $decimals = 0) {
    if (is_turkish()) {
        return number_format($number, $decimals, ',', '.');
    } else {
        return number_format($number, $decimals, '.', ',');
    }
}

// Format date according to language
function format_date($date, $format = null) {
    if ($format === null) {
        $format = is_turkish() ? 'd.m.Y H:i' : 'm/d/Y H:i';
    }
    
    if (is_string($date)) {
        $date = new DateTime($date);
    }
    
    return $date->format($format);
}

// Get HTML lang attribute
function get_html_lang() {
    return get_current_language();
}

// Get body data-lang attribute
function get_body_lang() {
    return get_current_language();
}

// Initialize language-specific settings
function init_language_settings() {
    // Set HTML lang attribute
    if (!isset($GLOBALS['html_lang_set'])) {
        $GLOBALS['html_lang_set'] = true;
    }
    
    // Set body data-lang attribute
    if (!isset($GLOBALS['body_lang_set'])) {
        $GLOBALS['body_lang_set'] = true;
    }
}

// Auto-initialize
init_language_settings();

// Make functions available globally
if (!function_exists('__')) {
    function __($key, $default = null) {
        global $translations;
        
        if (isset($translations[$key])) {
            return $translations[$key];
        }
        
        return $default !== null ? $default : $key;
    }
}

if (!function_exists('_e')) {
    function _e($key, $default = null) {
        echo __($key, $default);
    }
}
?>
