<?php

require 'vendor/autoload.php';

require 'vendor/facebook/php-sdk/src/facebook.php';

date_default_timezone_set('UTC');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler('pw.log', Logger::WARNING));

// add records to the log
$log->addWarning('Foo');
$log->addError('Bar');


$facebook = new Facebook(array(
  'appId'  => '628634493869371',
  'secret' => 'd2de4ae4eec14042d23daebe49d2b7bc',
));

// Get User ID
$user = $facebook->getUser();
if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

?>
