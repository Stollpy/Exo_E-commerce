<?php

require '../src/functions.php';


logout();

addFlashMessage('Au revoir !');
header('Location: index.php');
exit;