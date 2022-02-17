<?php


namespace App\AdditionalClasses;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class MyCookies
{
    /**
     * @param string $cookieName
     * @return \Illuminate\Http\RedirectResponse|mixed|null
     */
    public static function getCookie(string $cookieName)
    {
        try {
            if (Cookie::get($cookieName)) {
                $cookie_data = json_decode(Cookie::get($cookieName), true);
            }

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }

        return $cookie_data ?? null;
    }

    /**
     * @param array $data
     * @param string $cookieName
     * @return false|\Illuminate\Http\RedirectResponse|string|null
     */
    public static function setCookie(array $data, string $cookieName)
    {
        try {
            $cookie_data = json_encode($data);
            Cookie::queue(Cookie::make($cookieName, $cookie_data, 120));

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }

        return $cookie_data ?? null;
    }

    /**
     * @param string $cookieName
     * @return mixed
     */
    public function getSession(/*Request $request, */string $cookieName)
    {
        return json_decode(session($cookieName), true);
//        return $request->session()->get($cookieName);
    }

    /**
     * @param array $data
     * @param string $cookieName
     * @return void
     */
    public function setSession(/*Request $request, */array $data, string $cookieName)
    {
        $session_data = json_encode($data);
        session([$cookieName => $session_data]);
//        $request->session()->put($cookieName, $session_data);
    }
}
