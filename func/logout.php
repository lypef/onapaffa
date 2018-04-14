<?php
session_start();
session_destroy();
?>
<script>
  location.href = "../index.php?bye=true";
</script>
