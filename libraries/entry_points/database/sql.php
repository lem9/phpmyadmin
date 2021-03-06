<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Database SQL executor
 *
 * @package PhpMyAdmin
 */
declare(strict_types=1);

use PhpMyAdmin\Controllers\Database\SqlController;
use PhpMyAdmin\DatabaseInterface;
use PhpMyAdmin\Response;
use PhpMyAdmin\SqlQueryForm;

if (! defined('PHPMYADMIN')) {
    exit;
}

global $containerBuilder;

/** @var Response $response */
$response = $containerBuilder->get(Response::class);

/** @var DatabaseInterface $dbi */
$dbi = $containerBuilder->get(DatabaseInterface::class);

/** @var SqlController $controller */
$controller = $containerBuilder->get(SqlController::class);

/** @var SqlQueryForm $sqlQueryForm */
$sqlQueryForm = $containerBuilder->get('sql_query_form');

$header = $response->getHeader();
$scripts = $header->getScripts();
$scripts->addFile('makegrid.js');
$scripts->addFile('vendor/jquery/jquery.uitablefilter.js');
$scripts->addFile('sql.js');

$response->addHTML(
    $controller->index(
        [
            'delimiter' => $_POST['delimiter'] ?? null,
        ],
        $sqlQueryForm
    )
);
