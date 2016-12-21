<?php

namespace App;

use cebe\markdown\GithubMarkdown;

class WikiMarkdown extends GithubMarkdown
{
    public function __construct()
    {
        $this->enableNewlines = true;
        $this->html5 = true;
    }

    /**
     * @marker [[
     * @marker ]]
     */
    protected function parseBracketTag($markdown)
    {
        if (preg_match('/^\[\[(.+?)\]\]/', $markdown, $matches)) {
            return [
                ['bracket', $this->parseInline($matches[1])],
                strlen($matches[0]),
            ];
        }

        return [['text', substr($markdown, 0, 2)], 2];
    }

    protected function renderBracket($element)
    {
        $title = $this->renderAbsy($element[1]);
        $url = route('pages.show', $title);

        return sprintf('<a href="%s" class="router-link">%s</a>', $url, $title);
    }
}
