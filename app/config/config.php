<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 */

/*
|--------------------------------------------------------------------------
| LavaLust Version
|--------------------------------------------------------------------------
*/

$config['version'] = '4.6.0';


/*
|--------------------------------------------------------------------------
| Environment
|--------------------------------------------------------------------------
*/

$config['environment'] = getenv('APP_ENV') ?: 'development';


/*
|--------------------------------------------------------------------------
| Timezone
|--------------------------------------------------------------------------
*/

$config['date_default_timezone'] = 'Asia/Manila';


/*
|--------------------------------------------------------------------------
| Base Site URL
|--------------------------------------------------------------------------
|
| Local:
| http://localhost/LavaLust/public/
|
| Render:
| https://yu-princesswinlyn-lavalust.onrender.com/
|
*/

$config['base_url'] = getenv('APP_URL') ?: 'http://localhost/LavaLust/public/';


/*
|--------------------------------------------------------------------------
| Static File Proxies
|--------------------------------------------------------------------------
*/

$config['proxy_enabled'] = FALSE;


/*
|--------------------------------------------------------------------------
| Error Logging
|--------------------------------------------------------------------------
*/

$config['log_threshold'] = 0;
$config['log_dir'] = 'runtime/logs/';


/*
|--------------------------------------------------------------------------
| Composer Autoload
|--------------------------------------------------------------------------
*/

$config['composer_autoload'] = FALSE;


/*
|--------------------------------------------------------------------------
| Allowed URL Characters
|--------------------------------------------------------------------------
*/

$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';


/*
|--------------------------------------------------------------------------
| Character Set
|--------------------------------------------------------------------------
*/

$config['charset'] = 'UTF-8';


/*
|--------------------------------------------------------------------------
| Error View Path
|--------------------------------------------------------------------------
*/

$config['error_view_path'] = '';


/*
|--------------------------------------------------------------------------
| 404 Override
|--------------------------------------------------------------------------
*/

$config['404_override'] = '';


/*
|--------------------------------------------------------------------------
| Language
|--------------------------------------------------------------------------
*/

$config['language'] = 'en-US';


/*
|--------------------------------------------------------------------------
| Subclass Prefix
|--------------------------------------------------------------------------
*/

$config['subclass_prefix'] = 'MY_';


/*
|--------------------------------------------------------------------------
| Session
|--------------------------------------------------------------------------
|
| LavaLust uses file-based sessions here.
|
*/

$config['sess_driver']             = 'file';
$config['sess_table']              = 'sessions';
$config['sess_cookie_name']        = 'LLSession';
$config['sess_expiration']         = 7200;
$config['sess_save_path']          = '';
$config['sess_match_ip']           = FALSE;
$config['sess_match_fingerprint']  = FALSE;
$config['sess_time_to_update']     = 300;
$config['sess_regenerate_destroy'] = FALSE;
$config['sess_expire_on_close']    = FALSE;

$config['max_invalid_attempts']     = 5;
$config['invalid_window']           = 600;
$config['lock_duration_invalid']    = 900;

$config['max_session_creations']    = 10;
$config['creation_window']          = 60;
$config['lock_duration_creation']   = 120;

$config['security_file']            = ROOT_DIR . 'runtime/session/session_security.json';

$config['sess_inactivity_timeout']  = 1800;

$config['session_hmac_secret']      = getenv('APP_KEY') ?: '';


/*
|--------------------------------------------------------------------------
| Cookies
|--------------------------------------------------------------------------
*/

$config['cookie_prefix']     = '';
$config['cookie_domain']     = '';
$config['cookie_path']       = '/';

/*
| APP_COOKIE_SECURE should be:
| false = localhost
| true  = Render/HTTPS
*/

$config['cookie_secure']     = filter_var(
    getenv('APP_COOKIE_SECURE') ?: 'false',
    FILTER_VALIDATE_BOOLEAN
);

$config['cookie_expiration'] = 86400;
$config['cookie_httponly']   = TRUE;
$config['cookie_samesite']   = 'Lax';


/*
|--------------------------------------------------------------------------
| Cache
|--------------------------------------------------------------------------
*/

$config['cache_driver']          = 'php';
$config['cache_dir']             = ROOT_DIR . 'runtime/cache/';
$config['cache_default_expires'] = 0;

$config['lock_lock_timeout']     = 5;
$config['lock_lock_sleep']       = 100000;


/*
|--------------------------------------------------------------------------
| Encryption Key
|--------------------------------------------------------------------------
*/

$config['encryption_key'] = getenv('APP_KEY') ?: '';


/*
|--------------------------------------------------------------------------
| Soft Delete
|--------------------------------------------------------------------------
*/

$config['soft_delete']        = FALSE;
$config['soft_delete_column'] = 'deleted_at';


/*
|--------------------------------------------------------------------------
| Timestamps
|--------------------------------------------------------------------------
*/

$config['timestamps']        = FALSE;
$config['created_at_column'] = 'created_at';
$config['updated_at_column'] = 'updated_at';


/*
|--------------------------------------------------------------------------
| CSRF
|--------------------------------------------------------------------------
*/

$config['csrf_protection']   = FALSE;
$config['csrf_exclude_uris'] = array();

$config['csrf_token_name']   = 'csrf_test_name';
$config['csrf_cookie_name']  = 'csrf_cookie_name';
$config['csrf_expire']       = 7200;
$config['csrf_regenerate']   = FALSE;

?>