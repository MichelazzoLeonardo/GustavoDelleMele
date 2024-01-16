<?php
setcookie('user', null, time() + 86400, '/');
header('Location:showRecipes.php');