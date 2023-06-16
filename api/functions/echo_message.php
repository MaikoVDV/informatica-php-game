<?php
// Small helper function to clean up code.
// Messages that get echoed here are eventually flushed and sent to the client.
function echo_message($event_type, $data) {
  echo "event: $event_type\n",
    "data: $data\n\n";
}
?>
