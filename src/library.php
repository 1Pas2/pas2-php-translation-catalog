<?php
declare(strict_types=1);
namespace Pas2\TranslationCatalog;

final class Catalog
{
    public function __construct(
        private array $messages,
        private string $fallback = "en",
    ) {}
    public function get(string $locale, string $key, array $values = []): string
    {
        $message =
            $this->messages[$locale][$key] ??
            ($this->messages[$this->fallback][$key] ?? $key);
        if (!is_string($message)) {
            throw new \UnexpectedValueException("Messages must be strings");
        }
        $replace = [];
        foreach ($values as $name => $value) {
            if (!is_scalar($value) && $value !== null) {
                throw new \InvalidArgumentException(
                    "Scalar placeholder values required",
                );
            }
            $replace["{" . $name . "}"] = (string) $value;
        }
        return strtr($message, $replace);
    }
}
