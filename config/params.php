<?php

use Cekurte\Environment\Environment;

return [
    'email_from' => Environment::get('SMTP_USERNAME'),
    'icon-framework' => \kartik\icons\Icon::TYP,
];
