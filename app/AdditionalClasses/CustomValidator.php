<?php


namespace App\AdditionalClasses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CustomValidator
{
    /**
     * @param $phone_number
     * @return bool
     */
    public static function mobile_validator($phone_number)
    {
        $pattern = "/^(?:\+?98|0)[9]{1}[0-9]{9}$/";
        if(preg_match($pattern, Date::convertPersianNumToEnglish($phone_number))) {
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
     * remove Url parameter
     *
     * @param string $url
     * @param string $parameter
     * @return string
     */
    public static function removeUrlParameter(string $url, string $parameter) {
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
     * @return bool
     */
    public static function store_file(string $filename, string $url, string $path): bool
    {
        try {
            $path = "files/$path/$filename";
            if (!Storage::disk('public')->exists($path)) {
                $result = Storage::disk('public')->put($path, file_get_contents($url)); //storage: 'public' | 'local'
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return $result ?? false;
    }
}
