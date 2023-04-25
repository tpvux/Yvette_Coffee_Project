<?php
ob_start();

    session_start();
    session_unset();
    session_destroy();
?>
<script>
    window.close();
</script>