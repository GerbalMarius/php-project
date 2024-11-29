<?php

require __DIR__ ."/../../vendor/autoload.php";
require __DIR__."/../config.php";

require "create/create_users.php";
require "create/create_roles.php";
require "create/create_user_roles.php";
require "create/create_items.php";
require "create/create_wallets.php";
echo "Created succesfully";