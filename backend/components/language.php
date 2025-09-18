<?php
/**
 * Language Selection Component
 * Reusable language selection component
 */

function renderLanguageSelector($currentLang = 'en', $showFlags = true) {
    $languages = [
        'en' => ['name' => 'English', 'flag' => '🇺🇸'],
        'tr' => ['name' => 'Türkçe', 'flag' => '🇹🇷']
    ];
    
    echo "
    <div class=\"language-selector\">
        <div class=\"language-current\" onclick=\"toggleLanguageMenu()\">
            " . ($showFlags ? "<span class=\"language-flag\">{$languages[$currentLang]['flag']}</span>" : "") . "
            <span class=\"language-name\">{$languages[$currentLang]['name']}</span>
            <span class=\"language-arrow\">▼</span>
        </div>
        
        <div class=\"language-menu\" id=\"language-menu\" style=\"display: none;\">
            <div class=\"language-options\">";
    
    foreach ($languages as $code => $lang) {
        $activeClass = ($code === $currentLang) ? 'active' : '';
        echo "
                <button class=\"language-option {$activeClass}\" data-action=\"set-language\" data-lang=\"{$code}\">
                    " . ($showFlags ? "<span class=\"language-flag\">{$lang['flag']}</span>" : "") . "
                    <span class=\"language-name\">{$lang['name']}</span>
                </button>";
    }
    
    echo "
            </div>
        </div>
    </div>";
}

function renderLanguageToggle($currentLang = 'en') {
    $nextLang = ($currentLang === 'en') ? 'tr' : 'en';
    $languages = [
        'en' => ['name' => 'English', 'flag' => '🇺🇸'],
        'tr' => ['name' => 'Türkçe', 'flag' => '🇹🇷']
    ];
    
    echo "
    <button class=\"language-toggle\" data-action=\"toggle-language\" data-current=\"{$currentLang}\">
        <span class=\"language-flag\">{$languages[$currentLang]['flag']}</span>
        <span class=\"language-name\">{$languages[$currentLang]['name']}</span>
        <span class=\"language-switch\">🔄</span>
    </button>";
}
?>
