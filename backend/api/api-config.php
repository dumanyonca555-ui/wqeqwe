<?php
// ========================================
// NEURAL CHAT - API ENDPOINTS CONFIG
// ========================================

// API Endpoints Configuration
const API_ENDPOINTS = [
    'chat' => [
        'main' => '/api/chat/main',
        'private' => '/api/chat/private',  
        'history' => '/api/chat/history',
        'send' => '/api/chat/send',
        'markRead' => '/api/chat/mark-read',
        'typing' => '/api/chat/typing',
        'online' => '/api/chat/online'
    ],
    'story' => [
        'main' => '/api/story/main',
        'progress' => '/api/story/progress',
        'unlock' => '/api/story/unlock',
        'save' => '/api/story/save'
    ],
    'characters' => [
        'routes' => '/api/characters/routes',
        'affinity' => '/api/characters/affinity',
        'status' => '/api/characters/status',
        'profile' => '/api/characters/profile'
    ],
    'calls' => [
        'history' => '/api/calls/history',
        'answer' => '/api/calls/answer',
        'decline' => '/api/calls/decline',
        'missed' => '/api/calls/missed',
        'callback' => '/api/calls/callback'
    ]
];

// API Response Helper Functions
function api_response($success = true, $data = null, $message = '', $code = 200) {
    http_response_code($code);
    header('Content-Type: application/json');
    
    $response = [
        'success' => $success,
        'data' => $data,
        'message' => $message,
        'timestamp' => date('Y-m-d H:i:s'),
        'request_id' => uniqid()
    ];
    
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

function api_error($message = 'An error occurred', $code = 400, $details = null) {
    api_response(false, $details, $message, $code);
}

function api_success($data = null, $message = 'Success') {
    api_response(true, $data, $message);
}

// CSRF Token Validation
function validate_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// Rate Limiting
function check_rate_limit($endpoint, $user_id, $limit = 60, $window = 60) {
    $key = "rate_limit_{$endpoint}_{$user_id}";
    $current_time = time();
    $window_start = $current_time - $window;
    
    // Simple rate limiting (in production, use Redis)
    if (!isset($_SESSION[$key])) {
        $_SESSION[$key] = [];
    }
    
    // Clean old entries
    $_SESSION[$key] = array_filter($_SESSION[$key], function($timestamp) use ($window_start) {
        return $timestamp > $window_start;
    });
    
    // Check if limit exceeded
    if (count($_SESSION[$key]) >= $limit) {
        return false;
    }
    
    // Add current request
    $_SESSION[$key][] = $current_time;
    return true;
}

// Input Validation
function validate_input($data, $rules) {
    $errors = [];
    
    foreach ($rules as $field => $rule) {
        $value = $data[$field] ?? null;
        
        if (isset($rule['required']) && $rule['required'] && empty($value)) {
            $errors[$field] = "{$field} is required";
            continue;
        }
        
        if (isset($rule['type'])) {
            switch ($rule['type']) {
                case 'email':
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $errors[$field] = "{$field} must be a valid email";
                    }
                    break;
                case 'int':
                    if (!is_numeric($value)) {
                        $errors[$field] = "{$field} must be a number";
                    }
                    break;
                case 'string':
                    if (!is_string($value)) {
                        $errors[$field] = "{$field} must be a string";
                    }
                    break;
            }
        }
        
        if (isset($rule['min_length']) && strlen($value) < $rule['min_length']) {
            $errors[$field] = "{$field} must be at least {$rule['min_length']} characters";
        }
        
        if (isset($rule['max_length']) && strlen($value) > $rule['max_length']) {
            $errors[$field] = "{$field} must be no more than {$rule['max_length']} characters";
        }
    }
    
    return $errors;
}

// Database Connection Helper
function get_db_connection() {
    global $pdo;
    if (!$pdo) {
        require_once __DIR__ . '/../config/database.php';
    }
    return $pdo;
}

// Logging Helper
function log_api_request($endpoint, $user_id, $data = null, $response = null) {
    $log_entry = [
        'timestamp' => date('Y-m-d H:i:s'),
        'endpoint' => $endpoint,
        'user_id' => $user_id,
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
        'data' => $data,
        'response' => $response
    ];
    
    // In production, log to file or database
    error_log("API Request: " . json_encode($log_entry));
}

// CORS Headers
function set_cors_headers() {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization, X-CSRF-Token');
    header('Access-Control-Max-Age: 86400');
    
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit;
    }
}

// Initialize API
function init_api() {
    session_start();
    set_cors_headers();
    
    // Generate CSRF token if not exists
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    
    // Demo mode bypass for Episode 1 testing
    if (isset($_GET['demo']) && $_GET['demo'] === '1') {
        $_SESSION['user_id'] = 1; // Demo user ID
        $_SESSION['username'] = 'demo';
        $_SESSION['email'] = 'demo@example.com';
        return;
    }
    
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        api_error('Authentication required', 401);
    }
}

// Pagination Helper
function paginate($page = 1, $per_page = 20, $total = 0) {
    $page = max(1, (int)$page);
    $per_page = max(1, min(100, (int)$per_page));
    $total = max(0, (int)$total);
    
    $total_pages = ceil($total / $per_page);
    $offset = ($page - 1) * $per_page;
    
    return [
        'page' => $page,
        'per_page' => $per_page,
        'total' => $total,
        'total_pages' => $total_pages,
        'offset' => $offset,
        'has_next' => $page < $total_pages,
        'has_prev' => $page > 1
    ];
}

// Export API endpoints for JavaScript
function get_api_endpoints_js() {
    return json_encode(API_ENDPOINTS, JSON_UNESCAPED_UNICODE);
}
