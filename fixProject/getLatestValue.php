<?php
    require 'function.php';

    global $queue;

    echo json_encode($queue->dequeue());
?>