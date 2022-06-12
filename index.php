<?php
require_once 'vendor/autoload.php';
require_once 'Database/DB.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;


$loader = new FilesystemLoader('templates');
$twig = new Environment($loader);
$template = $twig->load('main.html');
try {
    echo $template->render(
        [
            'products' => DB::getProducts()
        ]
    );
} catch (\Doctrine\DBAL\Exception $e) {
    echo 'error while getting Products: ' . $e;
}