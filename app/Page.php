<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use cebe\markdown\GithubMarkdown as Markdown;
use App\WikiMarkdown as Markdown;

class Page extends Model
{
    protected $fillable = [
        'title', 'body',
    ];

    public function url()
    {
        return route('pages.show', $this->title);
    }

    public function getUrlAttribute()
    {
        return $this->url();
    }

    public function parse()
    {
        $parser = new Markdown();

        return $parser->parse($this->body);
    }

    public function getMarkdownBodyAttribute()
    {
        return $this->parse();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'title';
    }
}
