<?php
/**
 * HTML karakterek biztonságos formázása kimenet előtt.
 *
 * @param string $value A kimeneti érték.
 * @return string A biztonságos, formázott string.
 */
function e($value):string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}