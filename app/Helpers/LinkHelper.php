<?php

namespace App\Helpers;

use App\Models\Link;

function replaceWordsWithLinks($content, $links)
{
    $replacements = [];

    foreach ($links as $link) {
        $replacements[$link->word] = '<a href="' . $link->url . '" target="_blank" class="text-blue-500 underline">' . $link->word . '</a>';
    }

    return str_replace(array_keys($replacements), array_values($replacements), $content);
}
