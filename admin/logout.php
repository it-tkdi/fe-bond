<?php
session_destroy();

print "<meta http-equiv=\"refresh\" content=\"0;URL=./index.php\">";
echo "<script>alert('Logout berhasil');</script>";
?>