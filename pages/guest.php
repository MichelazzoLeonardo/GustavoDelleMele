<?php
setcookie('user', 'guest', time() + 86400, '/');
header('Location:community.php');