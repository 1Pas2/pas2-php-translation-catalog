<?php
declare(strict_types=1);
namespace Pas2\TranslationCatalog;

require __DIR__ . "/../src/library.php";
$catalog = new Catalog(["en" => ["welcome" => "Hello {name}"]]);
echo $catalog->get("fr", "welcome", ["name" => "Ada"]), PHP_EOL;
