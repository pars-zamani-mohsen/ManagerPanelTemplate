<?php


namespace App\AdditionalClasses;


use DOMDocument;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;

class TagOptimization
{
    /**
     * Laravel live form optimization
     *
     * @param string $html_text
     * @return \Illuminate\Http\RedirectResponse
     */
    public function LaravelLiveFormOptimization(string $html_text)
    {
        try {
            // create new DOMDocument
            $document = new DOMDocument('1.0', 'UTF-8');

            // set error level
            $internalErrors = libxml_use_internal_errors(true);

            // load HTML
            $document->loadHTML(mb_convert_encoding($html_text, 'HTML-ENTITIES', 'UTF-8'));

            $document->preserveWhiteSpace = false;

            // Restore error level
            libxml_use_internal_errors($internalErrors);
            $document = $this->FormUrlOptimization($document);
            $document = $this->TokenTagOptimization($document);

            return $document->saveHTML(); // saveXML // saveHTML

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Laravel form tag dynamic action
     *
     * @param $document
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    private function FormUrlOptimization($document)
    {
        try {
            foreach ($document->getElementsByTagName('form') as $a_element) {
                /*
                    help for dom: https://www.php.net/manual/en/class.domdocument.php
                */
                $element['action'] = $a_element->getAttribute('action');
                $element['method'] = $a_element->getAttribute('method');
                $a_element->setAttribute("action", \url($element['action'] ));
            }

            return $document;

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Laravel token input tag optimized
     *
     * @param $document
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    private function TokenTagOptimization($document)
    {
        try {
            foreach ($document->getElementsByTagName('input') as $a_element) {
                /*
                    help for dom: https://www.php.net/manual/en/class.domdocument.php
                */
                $element['type'] = $a_element->getAttribute('type');
                $element['name'] = $a_element->getAttribute('name');
                $element['value'] = $a_element->getAttribute('value');

                /* check href link */
                if ($element['name'] == '_token' && $element['type'] == 'hidden') {
                    $_tag = $document->createElement('input');
                    $_tag->nodeValue = $a_element->nodeValue;
                    $_tag->setAttribute('type', $element['type']);
                    $_tag->setAttribute('name', $element['name']);
                    $_tag->setAttribute('value', csrf_token());

                    $a_element->parentNode->replaceChild($_tag, $a_element);
                }
            }

            return $document;

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Seo: Check tags and optimization
     *
     * @param string $html_text
     * @return \Illuminate\Http\RedirectResponse
     */
    public function SeoTagOptimization(string $html_text)
    {
        try {
            // create new DOMDocument
            $document = new DOMDocument('1.0', 'UTF-8');

            // set error level
            $internalErrors = libxml_use_internal_errors(true);

            // load HTML
            $document->loadHTML(mb_convert_encoding($html_text, 'HTML-ENTITIES', 'UTF-8'));

            $document->preserveWhiteSpace = false;

            // Restore error level
            libxml_use_internal_errors($internalErrors);
            $document = $this->SeoATagOptimization($document);
            $document = $this->SeoImgTagOptimization($document);

            return $document->saveHTML(); // saveXML // saveHTML

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Seo: Check "a" tag and optimized
     *
     * @param $document
     * @return mixed
     */
    private function SeoATagOptimization($document)
    {
        try {
            foreach ($document->getElementsByTagName('a') as $a_element) {
                /*
                    help for dom: https://www.php.net/manual/en/class.domdocument.php
                */
                $href = $a_element->getAttribute('href');
                $class = $a_element->getAttribute('class');
                $style = $a_element->getAttribute('style');
                $target = $a_element->getAttribute('target');
                $rel = $a_element->getAttribute('rel');
                $data_anchor = $a_element->getAttribute('data-anchor');
                $title = $a_element->getAttribute('title');

                /* check href link */
                if (strpos($href, 'http://') !== false || strpos($href, 'https://') !== false) {
                    /* check link location */
                    if (strpos($href, URL::to('/')) !== false) {
                        /* internal link */
                        $rel = 'follow';

                    } else {
                        /* external link */
                        $_tagFollow = 'follow';
                        if (strpos($rel, 'unfollow') !== false) { $_tagFollow = 'unfollow'; }
                        $rel = "noopener, noreferrer, $_tagFollow";
                        $target = '_blank';
                    }

                } else {
                    /* site marker */
                    if (strpos($href, '#') !== false) {
                        $rel = '';
                        $target = '';
                        $title = ($title) ? ($title . ' ' . $a_element->nodeValue) : $a_element->nodeValue;
                    }
                }

                $_tag = $document->createElement('a');
                $_tag->nodeValue = $a_element->nodeValue;
                $_tag->setAttribute('href', $href);
                if ($class) $_tag->setAttribute('class', $class);
                if ($style) $_tag->setAttribute('style', $style);
                if ($target) $_tag->setAttribute('target', $target);
                if ($rel) $_tag->setAttribute('rel', $rel);
                if ($data_anchor) $_tag->setAttribute('data-anchor', $data_anchor);
                if ($title) $_tag->setAttribute('title', $title);

                $a_element->parentNode->replaceChild($_tag, $a_element);
            }

            return $document;

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Seo: Check "img" tag and optimized
     *
     * @param $document
     * @return mixed
     */
    private function SeoImgTagOptimization($document)
    {
        try {
            foreach ($document->getElementsByTagName('img') as $a_element) {
                /*
                    help for dom: https://www.php.net/manual/en/class.domdocument.php
                */
                $src = $a_element->getAttribute('src');
                $class = $a_element->getAttribute('class');
                $style = $a_element->getAttribute('style');
                $alt = $a_element->getAttribute('alt');
                $title = $a_element->getAttribute('title');
                $width = $a_element->getAttribute('width');
                $height = $a_element->getAttribute('height');

                /* create new element */
                $_tag = $document->createElement('img');
                $_tag->setAttribute('src', $src);
                if ($class) $_tag->setAttribute('class', $class);
                if ($style) $_tag->setAttribute('style', $style);
                if ($title) $_tag->setAttribute('title', $title);
                if ($alt) $_tag->setAttribute('alt', $alt);
                if ($width) $_tag->setAttribute('width', $width);
                if ($height) $_tag->setAttribute('height', $height);
                $_tag->setAttribute('loading', "lazy");

                $a_element->parentNode->replaceChild($_tag, $a_element);
            }

            return $document;

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }
}

