<?php
require('../model/model.php');
$db = db();
/*The moment minus 15 minutes, delete where the timestamp is smaller than the moment ($time = time() - 900)
Can do the same without cron but i'm testing with cron.*/
$moment = time() - 900;
$update_online = $db->prepare('DELETE FROM online WHERE last_action < :moment');
$update_online->execute(array(
    'moment' => $moment
));