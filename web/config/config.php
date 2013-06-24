<?php
/**
 * Configuration for Xhgui
 */
return array(
    'db.host' => 'mongodb://localhost:27017',
    'db.db' => 'xhprof',
    'date.format' => 'M jS H:i:s',
    'detail.count' => 6,
    'page.limit' => 25,
    'save.handler' => 'mongodb', //mongodb|json
    'save.date.format' => 'Ymd_H'
);
