<?php

/**
 * Helper Functions for GeStock App
 * 
 * This file contains utility functions used throughout the application
 * for common operations like formatting, validation, and data manipulation.
 */

/**
 * Format currency values
 *
 * @param float $amount The amount to format
 * @param string $currency Currency code (default: USD)
 * @return string Formatted currency string
 */
function formatCurrency($amount, $currency = 'USD')
{
    $currencySymbols = [
        'USD' => '$',
        'EUR' => '€',
        'GBP' => '£',
        'JPY' => '¥',
        'CAD' => 'C$',
        'AUD' => 'A$',
    ];

    $symbol = $currencySymbols[$currency] ?? $currency;
    return $symbol . number_format($amount, 2, '.', ',');
}

/**
 * Format date to human-readable format
 *
 * @param string|int $date Date string or timestamp
 * @param string $format PHP date format (default: Y-m-d H:i:s)
 * @return string Formatted date string
 */
function formatDate($date, $format = 'Y-m-d H:i:s')
{
    if (is_numeric($date)) {
        return date($format, (int)$date);
    }

    $timestamp = strtotime($date);
    return $timestamp ? date($format, $timestamp) : $date;
}

/**
 * Sanitize string input
 *
 * @param string $input The input to sanitize
 * @return string Sanitized string
 */
function sanitizeInput($input)
{
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

/**
 * Validate email address
 *
 * @param string $email Email address to validate
 * @return bool True if valid, false otherwise
 */
function isValidEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Validate phone number (basic validation)
 *
 * @param string $phone Phone number to validate
 * @return bool True if valid, false otherwise
 */
function isValidPhone($phone)
{
    return preg_match('/^\+?[1-9]\d{1,14}$/', sanitizeInput($phone));
}

/**
 * Generate a unique ID/UUID
 *
 * @return string UUID v4
 */
function generateUUID()
{
    $data = openssl_random_pseudo_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

/**
 * Get current UTC timestamp
 *
 * @return string Current date and time in UTC (YYYY-MM-DD HH:MM:SS format)
 */
function getCurrentTimestamp()
{
    return gmdate('Y-m-d H:i:s');
}

/**
 * Convert timestamp to UTC
 *
 * @param string|int $date Date or timestamp to convert
 * @return string UTC timestamp in YYYY-MM-DD HH:MM:SS format
 */
function toUTC($date)
{
    $timestamp = is_numeric($date) ? (int)$date : strtotime($date);
    return gmdate('Y-m-d H:i:s', $timestamp);
}

/**
 * Calculate percentage
 *
 * @param float $value The value
 * @param float $total The total
 * @param int $decimals Number of decimal places
 * @return float Calculated percentage
 */
function calculatePercentage($value, $total, $decimals = 2)
{
    if ($total == 0) {
        return 0;
    }

    return round(($value / $total) * 100, $decimals);
}

/**
 * Calculate discount amount
 *
 * @param float $originalPrice Original price
 * @param float $discountPercent Discount percentage
 * @return float Discount amount
 */
function calculateDiscount($originalPrice, $discountPercent)
{
    return round($originalPrice * ($discountPercent / 100), 2);
}

/**
 * Calculate final price after discount
 *
 * @param float $originalPrice Original price
 * @param float $discountPercent Discount percentage
 * @return float Final price
 */
function getFinalPrice($originalPrice, $discountPercent)
{
    return round($originalPrice - calculateDiscount($originalPrice, $discountPercent), 2);
}

/**
 * Slug a string for use in URLs
 *
 * @param string $string The string to slugify
 * @return string URL-friendly slug
 */
function slugify($string)
{
    $string = mb_strtolower($string, 'UTF-8');
    $string = preg_replace('/[^a-z0-9]+/', '-', $string);
    return trim($string, '-');
}

/**
 * Truncate string to specified length
 *
 * @param string $string The string to truncate
 * @param int $length Maximum length
 * @param string $suffix Suffix to append (default: '...')
 * @return string Truncated string
 */
function truncate($string, $length = 50, $suffix = '...')
{
    if (mb_strlen($string) <= $length) {
        return $string;
    }

    return mb_substr($string, 0, $length) . $suffix;
}

/**
 * Check if value is null or empty
 *
 * @param mixed $value The value to check
 * @return bool True if null or empty, false otherwise
 */
function isEmpty($value)
{
    return $value === null || $value === '' || (is_array($value) && count($value) === 0);
}

/**
 * Get array value safely with default fallback
 *
 * @param array $array The array to search
 * @param string $key The key to retrieve
 * @param mixed $default Default value if key doesn't exist
 * @return mixed The value or default
 */
function arrayGet($array, $key, $default = null)
{
    return isset($array[$key]) ? $array[$key] : $default;
}

/**
 * Log a message or data
 *
 * @param string $message The message to log
 * @param mixed $data Optional data to log
 * @param string $level Log level (info, warning, error)
 * @return void
 */
function logMessage($message, $data = null, $level = 'info')
{
    $timestamp = getCurrentTimestamp();
    $logMessage = "[$timestamp] [$level] $message";

    if (!isEmpty($data)) {
        $logMessage .= " | Data: " . json_encode($data);
    }

    error_log($logMessage);
}

/**
 * Redirect to a URL
 *
 * @param string $url The URL to redirect to
 * @param int $statusCode HTTP status code (default: 302)
 * @return void
 */
function redirect($url, $statusCode = 302)
{
    header("Location: $url", true, $statusCode);
    exit;
}

/**
 * Generate CSRF token
 *
 * @return string CSRF token
 */
function generateCSRFToken()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

/**
 * Verify CSRF token
 *
 * @param string $token The token to verify
 * @return bool True if valid, false otherwise
 */
function verifyCSRFToken($token)
{
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Convert array to query string
 *
 * @param array $params Array of parameters
 * @return string Query string
 */
function arrayToQueryString($params)
{
    return http_build_query($params);
}

/**
 * Get status badge color based on status
 *
 * @param string $status The status value
 * @return string Bootstrap badge class
 */
function getStatusBadgeClass($status)
{
    $statuses = [
        'active' => 'badge-success',
        'inactive' => 'badge-secondary',
        'pending' => 'badge-warning',
        'cancelled' => 'badge-danger',
        'completed' => 'badge-info',
    ];

    return $statuses[strtolower($status)] ?? 'badge-secondary';
}
