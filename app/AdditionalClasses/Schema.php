<?php


namespace App\AdditionalClasses;


use App\AdditionalClasses\Date;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;

class Schema
{
    /**
     * Create schema for product
     *
     * @param $instance
     * @return \Illuminate\Http\RedirectResponse|string|null
     */
    public function createProductSchema($instance)
    {
        try {
            if (!$instance) return null;

            $schema = array(
                '@context' => 'https://schema.org',
                '@type' => "Product",
                'name' => $instance->title,
                'image' => asset("/images/product/$instance->pic1"),
                'description' => $instance->meta_desc,
                'brand' => array('@type' => 'Brand', 'name' => 'پارس پندار نهاد'),
//                'offers' => array(
//                    '@type' => 'Offer',
//                    'url' => \url("/course/$instance->slug"),
//                    "priceCurrency" => "IRR",
//                    "price" => floatval($instance->price) * 10,
//                    "priceValidUntil" => date('Y-m-d'),
//                    "availability" => "https://schema.org/InStock",
//                    "itemCondition" => "https://schema.org/UsedCondition"
//                ),
            );

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }

        // return $schema;
        return '<script type="application/ld+json">' . json_encode($schema) . '</script>';
    }

    /**
     * Create schema for article and blog and news
     *
     * @param $instance
     * @param string $type 'Article'|'BlogPosting'|'NewsArticle'
     * @return \Illuminate\Http\RedirectResponse|string|null
     */
    public function createArticleBlogSchema($instance, string $type = 'Article')
    {
        try {
            if (!$instance) return null;
            if (!in_array($type, array('Article', 'BlogPosting', 'NewsArticle'))) $type = 'Article';

            $schema = array(
                '@context' => 'https://schema.org',
                '@type' => $type,
                'mainEntityOfPage' => array('@type' => 'WebPage', '@id' => URL::to('/') . '/' . $instance->slug),
                'headline' => $instance->title,
//            'description' => '',
                'image' => asset($instance->picture),
                'author' => array('@type' => 'Person', 'name' => $instance->publisher->name, 'url' => URL::to('/') . '/author/' . $instance->publisher->id),
//            'publisher' => array(
//                '@type' => 'Organization',
//                'name' => '',
//                'logo' => array('@type' => 'ImageObject', 'url' => ''),
//            ),
                'datePublished' => Date::timestampToShamsiWithDay_andNameOfMonth($instance->created_at),
                'dateModified' => Date::timestampToShamsiWithDay_andNameOfMonth($instance->updated_at),
            );

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }

        //        return $schema;
        return '<script type="application/ld+json">' . json_encode($schema) . '</script>';
    }

    /**
     * Create schema for FAQ Page
     *
     * @param $instance
     * @return \Illuminate\Http\RedirectResponse|string|null
     */
    public function createFAQSchema($instance)
    {
        try {
            if (!$instance) return null;

            $faq = array();
            foreach ($instance as $item) {
                $faq[] = array(
                    '@type' => 'Question',
                    'name' => $item->title,
                    'acceptedAnswer' => array('@type' => 'Answer', 'text' => $item->content),
                );
            }

            $schema = array(
                '@context' => 'https://schema.org',
                '@type' => 'FAQPage',
                'mainEntity' => $faq,
            );

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }

//        return $schema;
        return '<script type="application/ld+json">' . json_encode($schema) . '</script>';
    }

    /**
     * Create schema for video object
     *
     * @param $instance
     * @return \Illuminate\Http\RedirectResponse|string|null
     */
    public function createVideoSchema($instance)
    {
        try {
            if (!$instance) return null;
            $schema = array(
                '@context' => 'https://schema.org',
                '@type' => 'VideoObject',
                'name' => $instance->video->title,
                'description' => $instance->video->description,
                'thumbnailUrl' => asset($instance->video->picture),
                'uploadDate' => Date::timestampToShamsiWithDay($instance->created_at),
                'duration' => $this->createTimeInterval($instance->duration),
//            'publisher' => array(
//                '@type' => 'Organization',
//                'name' => $instance,
//                'logo' => array('@type' => 'ImageObject', 'url' => '', 'width' => '', 'height' => ''),
//            ),
                'contentUrl' => asset($instance->file),
//            'embedUrl' => $instance,
//            'potentialAction' => array(
//                '@type' => 'SeekToAction',
//                'target' => "seektoaction targer url '$instance'={seek_to_second_number}",
//                "startOffset-input" => "required name=seek_to_second_number",
//            ),
            );

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }

        return '<script type="application/ld+json">' . json_encode($schema) . '</script>';
    }

    /**
     * Create schema for Breadcrumb
     *
     * @param $instance
     * @return \Illuminate\Http\RedirectResponse|string|null
     */
    public function createBreadcrumbSchema($instance)
    {
        try {
            if (!$instance) return null;
            $listItem = array();
            foreach ($instance as $key => $item) {
                $listItem[] = array(
                    '@type' => 'ListItem',
                    'position' => ++$key,
                    'name' => $item['title'],
                    'item' => ($item['slug']) ? $item['slug'] : '',
                );
            }
            $schema = array(
                '@context' => 'https://schema.org',
                '@type' => 'BreadcrumbList',
                'itemListElement' => $listItem,
            );

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }

//        return $schema;
        return '<script type="application/ld+json">' . json_encode($schema) . '</script>';
    }

    /**
     * Create time interval
     *
     * @param int $second
     * @return \Illuminate\Http\RedirectResponse|string
     * @Example PT01M13S
     */
    public function createTimeInterval(int $second)
    {
        try {
            $minutes = floor($second / 60);
            $second_m = $second % 60;
            $minutes = (strlen((string) floor($second / 60)) == 1) ? '0' . floor($second / 60) : floor($second / 60);

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }

        return 'PT'.$minutes.'M'.$second_m.'S';
    }
}
