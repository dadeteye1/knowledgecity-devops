<?php
include 'analytics.php';
echo "Hello from PHP Monolith!<br>";
log_event("user123", "page_view");
?>