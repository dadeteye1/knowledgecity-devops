<?php
function log_event($user_id, $event_type) {
  $ch_url = "http://clickhouse.knowledgecity.svc.cluster.local:8123/?query=";
  $sql = "INSERT INTO analytics.events (event_time, user_id, event_type) VALUES (now(), '$user_id', '$event_type')";
  $url = $ch_url . urlencode($sql);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_exec($ch);
  curl_close($ch);
}
?>