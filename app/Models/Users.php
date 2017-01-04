<?php

namespace App\Models;

use File;
use Illuminate\Database\Eloquent\Model;
use ChrisKonnertz\OpenGraph\OpenGraph;

class Users extends Content
{
    protected $table = 'users';
    protected $templatePath = 'public/pages';
    protected $contentId = 'page';
//    protected $appends = ['identifier', 'callouts', 'videos', 'carousels'];

//    protected $fillable = [
//        'title',
//        'slug',
//        'template',
//        'meta_title',
//        'meta_description',
//    ];

    public function getEmail(){
        return $this->email;
    }

    public function getIdentifierAttribute()
    {
        return $this->contentId.$this->id;
    }

    public function callouts()
    {
        return $this->belongsToMany(Callout::class, 'page_callouts', 'page_id', 'callout_id');
    }

    public function getCalloutsAttribute()
    {
        return $this->callouts()->get();
    }

    public function videos()
    {
        return $this->belongsToMany(Video::class, 'page_videos', 'page_id', 'video_id');
    }

    public function getVideosAttribute()
    {
        return $this->videos()->get();
    }

    public function carousels()
    {
        return $this->belongsToMany(Carousel::class, 'page_carousels', 'page_id', 'carousel_id');
    }

    public function getCarouselsAttribute()
    {
        return $this->carousels()->first();
    }

    public static function getContent($slug)
    {
        $page = Page::where('slug', $slug)->first();
        if($page){
            $og = new OpenGraph();
            $og->title(@$page->meta_title)
                ->type('website')
                ->image(@$page->meta_image)
                ->description(@$page->meta_description)
                ->url();
            $page->og = $og;
            $page = $page->toArray();
        }

        return $page;
    }

}
