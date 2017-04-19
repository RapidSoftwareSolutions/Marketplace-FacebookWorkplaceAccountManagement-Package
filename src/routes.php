<?php
$routes = [
    'metadata',
    'createAccountForPerson',
    'updateUser',
    'getAllUsers',
    'deactivateUserAccount',
    'deletingUserAccount',
];
foreach($routes as $file) {
    require __DIR__ . '/../src/routes/'.$file.'.php';
}

