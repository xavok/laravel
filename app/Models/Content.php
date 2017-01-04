<?php

namespace App\Models;

use File;
use Illuminate\Database\Eloquent\Model;

class Content extends Model {
    protected $templatePath;
    protected $contentId;

    public function getTemplates()
    {
        $templates = array();

        if($this->templatePath){
            $files = File::files(base_path() . '/resources/views/' . $this->templatePath);

            foreach ($files as $file) {
                $location = str_replace(base_path(), '', $file);
                $segments = explode('/', $location);
                $lastSegment = $segments[sizeof($segments) - 1];
                $lastSegment = explode('.', $lastSegment);

                if (sizeof($lastSegment) != 3) {
                    continue;
                }
                if ($lastSegment[1] != 'blade' and $lastSegment[2] != 'php') {
                    continue;
                }
                $templates[$lastSegment[0]] = $lastSegment[0];
            }
        }

        return $templates;
    }

    public function getAvailableContentBlocks($type = null)
    {
        $blocks = array();
        if( $this->templatePath && $this->template ) {
            $template = file_get_contents(base_path() . '/resources/views/' . $this->templatePath . '/' . $this->template . '.blade.php');

            if($type == 'callout'){
                preg_match_all('/::(?:callout)\((?:\'|")(.*?)(?:\'|")/mi', $template, $blocks);
            }else {
                preg_match_all('/::(?:content)\((?:\'|")(.*?)(?:\'|")/mi', $template, $blocks);
            }

            if (!isset($blocks[1]) || sizeof($blocks[1]) == 0) {
                return array();
            }

            $blocks = array_unique($blocks[1]);
        }

        return $blocks;
    }

    public function getContentBlocks($callout = null)
    {
        $blocks = $this->getAvailableContentBlocks($callout);

        $contentBlocks = ContentBlock::whereIn('slug', $blocks);
        if($this->id && $this->contentId){
            $contentBlocks->where('identifier', $this->contentId.$this->id);
        }
        $contentBlocks = $contentBlocks->get()->keyBy('slug')->toArray();
        $content = array();

        foreach($blocks as $block){
            $content[$block] = @$contentBlocks[$block]['content'];
        }

        return $content;
    }

    public function updateContentBlock($slug, $content)
    {
        $identifier = $this->contentId . $this->id;
        $block = ContentBlock::where('slug', $slug);
        if ($this->id && $this->contentId) {
            $block->where('identifier', $identifier);
        }
        $block = $block->first();

        if(!$block && $content){
            $block = new ContentBlock();
            $block->title = $slug;
            $block->identifier = $identifier;
            $block->slug = $slug;
            $block->content = $content;
            $block->save();
        }elseif($block && $content){
            $block->content = $content;
            $block->save();
        }

        if($content == "" && $block){
            $block->delete();
        }
    }

}
