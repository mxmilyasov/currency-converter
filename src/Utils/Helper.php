<?php

namespace Mxmilyasov\Converter\Utils;

class Helper
{

    public static function getJsonDecodeContent(string $url): array
    {
        $content = file_get_contents($url);
        if ($content === false) {
            throw new \RuntimeException("Could not load file $url");
        }

        $result = json_decode($content, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException("$url does not contain valid JSON: " . json_last_error_msg());
        }

        return $result;
    }
}
