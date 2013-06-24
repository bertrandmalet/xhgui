#!/usr/bin/env php
<?php
$options = getopt('f:h', array('file:','help'));

if (isset($options['h']) || isset($options['help'])) {
    print <<<EOT
-f|--file           Specify the file path
-h|--help           Print this usage information

EOT;
    return;
}

if (isset($options['f'])) {
    $options['file'] = $options['f'];
}
if (!isset($options['file'])) {
    throw new UnexpectedValueException('File parameter must be set');
}

if (!is_readable($options['file'])) {
    throw new InvalidArgumentException($options['file'].' is unreadable');
}

$handle = fopen($options['file'], 'r');

require dirname(__DIR__) . '/bootstrap.php';

$db = Xhgui_Db::connect();
while (($data = fgets($handle)) !== FALSE) {
    if ($save = json_decode($data)) {
        try {
            $profiles = new Xhgui_Profiles($db->results);
            $profiles->insert($save, array('w' => false));
        } catch (Exception $e) {
            error_log('xhgui - ' . $e->getMessage());
        }
    }
}
fclose($handle);