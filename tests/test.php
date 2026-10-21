<?php
declare(strict_types=1);
namespace Pas2\TranslationCatalog;

require __DIR__ . "/../src/library.php";
function check(bool $condition, string $message): void
{
    if (!$condition) {
        throw new \RuntimeException($message);
    }
}
function fails(callable $fn): void
{
    try {
        $fn();
    } catch (\Throwable) {
        return;
    }
    throw new \RuntimeException("Expected failure");
}
$c = new Catalog([
    "en" => ["hello" => "Hi {name}", "only" => "Fallback"],
    "fr" => ["hello" => "Salut {name}"],
]);
check($c->get("fr", "hello", ["name" => "Ada"]) === "Salut Ada", "locale");
check($c->get("fr", "only") === "Fallback", "fallback");
check($c->get("xx", "unknown") === "unknown", "missing");
check(
    $c->get("en", "hello", ["name" => "{x}", "x" => "wrong"]) === "Hi {x}",
    "not recursive",
);
echo "All checks passed\n";
