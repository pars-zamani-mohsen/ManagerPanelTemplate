<?php


namespace App\AdditionalClasses;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class CustomValidator
{
    /**
     * @param $phone_number
     * @return bool
     */
    public static function mobile_validator($phone_number)
    {
        $pattern = "/^(?:\+?98|0)[9]{1}[0-9]{9}$/";
        if (preg_match($pattern, Date::convertPersianNumToEnglish($phone_number))) {
            return true;
        }
        return false;
    }

    /**
     * @return mixed
     */
    public static function getPreviousRouteName()
    {
        return app('router')->getRoutes(url()->previous())->match(app('request')->create(url()->previous()))->getName();
    }

    /**
     * remove Url parameter(for paginate pages)
     *
     * @param string $url
     * @param string $parameter
     * @return string
     */
    public static function removeUrlParameter(string $url, string $parameter)
    {
        list($urlpart, $qspart) = array_pad(explode('?', $url), 2, '');
        parse_str($qspart, $qsvars);
        unset($qsvars[$parameter]);
        $newqs = http_build_query($qsvars);
        return $urlpart . '?' . $newqs;
    }

    /**
     * Store file from URL
     *
     * @param string $filename
     * @param string $url
     * @param string $path
     * @return string
     */
    public static function store_file(string $filename, string $url, string $path): string
    {
        try {
            $path = "files/$path/$filename";
            if (!Storage::disk('local')->exists($path)) {
                Storage::disk('local')->put($path, file_get_contents($url)); //storage: 'public' | 'local'
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return $path;
    }

    /**
     * @param string $text
     * @param int $count
     * @return string
     */
    public static function str_limit(string $text, int $count): string
    {
        return \Illuminate\Support\Str::limit(strip_tags(html_entity_decode($text)), $count);
    }

    /**
     * @param $post
     * @return string
     */
    public static function estimated_reading_time($post)
    {
        $words = self::count_unicode_words(strip_tags(html_entity_decode($post)));
        $minutes = floor($words / 120);
        $seconds = floor($words % 120 / (120 / 60));

        if (1 <= $minutes) {
            $estimated_time = $minutes . ' دقیقه';// . ', ' . $seconds . ' ثانیه';
        } else {
            $estimated_time = $seconds . ' ثانیه';
        }

        return $estimated_time;
    }

    /**
     * @param $unicode_string
     * @return int
     */
    public static function count_unicode_words($unicode_string)
    {
        // First remove all the punctuation marks & digits
        $unicode_string = preg_replace('/[[:punct:][:digit:]]/', '', $unicode_string);

        // Now replace all the whitespaces (tabs, new lines, multiple spaces) by single space
        $unicode_string = preg_replace('/[[:space:]]/', ' ', $unicode_string);

        // The words are now separated by single spaces and can be splitted to an array
        // I have included \n\r\t here as well, but only space will also suffice
        $words_array = preg_split("/[\n\r\t ]+/", $unicode_string, 0, PREG_SPLIT_NO_EMPTY);

        // Now we can get the word count by counting array elments
        return count($words_array);
    }
}
