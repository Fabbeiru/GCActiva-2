<?php

include_once ("business.class.php");

User::logout();

header("Location:index.php");