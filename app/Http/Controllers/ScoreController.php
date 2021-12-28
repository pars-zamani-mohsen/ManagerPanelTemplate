<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ScoreController extends Controller
{
    /**
     * @param Request $request
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public function calc(Request $request)
    {
        try {
            $married = false;
            $userScoresList = array();
            $finalUserScoresList = array(
                'human_capital_factors' => array(
                    'age' => 0,
                    'level_of_education' => 0,
                    'official_languages' => array(
                        'first_official_language' => 0,
                        'second_official_language' => 0
                    ),
                    'canadian_work_experience' => 0,
                ),
                'spouse_factors' => array(
                    'level_of_education' => 0,
                    'first_official_languages' => 0,
                    'canadian_work_experience' => 0,
                ),
                'skill_transferability_factors' => array(
                    'education' => array(
                        'official_language_proficiency_and_education' => 0,
                        'canadian_work_experience_and_education' => 0,
                    ),
                    'foreign_work_experience' => array(
                        'official_language_proficiency_and_foreign_work_experience' => 0,
                        'canadian_and_foreign_work_experience' => 0,
                    ),
                    'certificate_of_qualification' => 0
                ),
                'additional_points' => array(
                    'provincial_nomination' => 0,
                    'job_offer' => 0,
                    'study_in_canada' => 0,
                    'sibling_in_canada' => 0,
                    'french_language_skills' => 0,
                ),
            );

            /* check married user and get scores list */
            if (
                (isset($request->q1) && ($request->q1 == 'B' || $request->q1 == 'E')) &&
                (isset($request->q2ii) && ($request->q2ii == 'B'))
            ) {
                $married = true;
            }
            $ScoresList = $this->getScore($married);

            /* get user base score */
            foreach ($request->all() as $request_key => $request_item) {
                if ($request_item == 'badvalue') continue;
                if (array_key_exists($request_key, $ScoresList)) {
                    if (array_key_exists($request_item, $ScoresList[$request_key])) {
                        $userScoresList[$request_key] = $ScoresList[$request_key][$request_item];
                    }
                }
            }

            //* Human capital factors */
            $official_languages = $this->official_languages($userScoresList, $married);
            if (isset($userScoresList['q3'])) $finalUserScoresList['human_capital_factors']['age'] = $userScoresList['q3'];
            if (isset($userScoresList['q4'])) $finalUserScoresList['human_capital_factors']['level_of_education'] = $userScoresList['q4'];
            $finalUserScoresList['human_capital_factors']['official_languages']['first_official_language'] = $official_languages['firstOfficialLanguage'];
            $finalUserScoresList['human_capital_factors']['official_languages']['second_official_language'] = $official_languages['secondOfficialLanguage'];
            if (isset($userScoresList['q6i'])) $finalUserScoresList['human_capital_factors']['canadian_work_experience'] = $userScoresList['q6i'];

            //* Spouse factors */
            if ($married) {
                if (isset($userScoresList['q10'])) $finalUserScoresList['spouse_factors']['level_of_education'] = $userScoresList['q10'];
                $finalUserScoresList['spouse_factors']['first_official_languages'] = $this->spouse_official_languages($request, $userScoresList);
                if (isset($userScoresList['q11'])) $finalUserScoresList['spouse_factors']['canadian_work_experience'] = $userScoresList['q11'];
            }

            /* Skill transferability factors */
            $finalUserScoresList['skill_transferability_factors']['education']['official_language_proficiency_and_education'] = $this->official_language_proficiency_and_education($request);
            $finalUserScoresList['skill_transferability_factors']['education']['canadian_work_experience_and_education'] = $this->canadian_work_experience_and_education($request);
            $finalUserScoresList['skill_transferability_factors']['foreign_work_experience']['official_language_proficiency_and_foreign_work_experience'] = $this->official_language_proficiency_and_foreign_work_experience($request);
            $finalUserScoresList['skill_transferability_factors']['foreign_work_experience']['canadian_and_foreign_work_experience'] = $this->canadian_and_foreign_work_experience($request);
            $finalUserScoresList['skill_transferability_factors']['certificate_of_qualification'] = $this->certificate_of_qualification($request);

            //* Additional points */
            if (isset($userScoresList['q9'])) $finalUserScoresList['additional_points']['provincial_nomination'] = $userScoresList['q9'];
            if (isset($userScoresList['q8a'])) $finalUserScoresList['additional_points']['job_offer'] = $userScoresList['q8a'];
            if (isset($userScoresList['q4c'])) $finalUserScoresList['additional_points']['study_in_canada'] = $userScoresList['q4c'];
            if (isset($userScoresList['q10i'])) $finalUserScoresList['additional_points']['sibling_in_canada'] = $userScoresList['q10i'];
            $finalUserScoresList['additional_points']['french_language_skills'] = $this->french_language_skills($request);

//        dd($this->total_calculator($finalUserScoresList, $married));
            return $this->total_calculator($finalUserScoresList, $married);

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * @param bool $married
     * @return \Illuminate\Http\RedirectResponse|\int[][]
     */
    public function getScore(bool $married = false)
    {
        try {
            if ($married) {
                /* married */
                $response = array(
                    "q3" => array('A' => 90, 'B' => 95, 'C' => 100, 'D' => 100, 'E' => 100, 'F' => 100, 'G' => 100, 'H' => 100, 'I' => 100, 'J' => 100, 'K' => 100, 'L' => 100, 'M' => 100, 'N' => 95, 'O' => 90, 'P' => 85, 'Q' => 80, 'R' => 75, 'S' => 70, 'T' => 65, 'U' => 60, 'V' => 55, 'W' => 50, 'X' => 45, 'Y' => 35, 'Z' => 25, 'AA' => 15, 'AB' => 5, 'AC' => 0),
                    "q4" => array('A' => 0, 'B' => 28, 'C' => 84, 'D' => 91, 'E' => 112, 'F' => 119, 'G' => 126, 'H' => 140),
                    "q4c" => array('A' => 0, 'B' => 15, 'C' => 30),
                    "q5i-b-speaking" => array('A' => 0, 'B' => 6, 'C' => 6, 'D' => 8, 'E' => 16, 'F' => 22, 'G' => 29, 'H' => 32),
                    "q5i-b-listening" => array('A' => 0, 'B' => 6, 'C' => 6, 'D' => 8, 'E' => 16, 'F' => 22, 'G' => 29, 'H' => 32),
                    "q5i-b-reading" => array('A' => 0, 'B' => 6, 'C' => 6, 'D' => 8, 'E' => 16, 'F' => 22, 'G' => 29, 'H' => 32),
                    "q5i-b-writing" => array('A' => 0, 'B' => 6, 'C' => 6, 'D' => 8, 'E' => 16, 'F' => 22, 'G' => 29, 'H' => 32),
                    "q5ii-sol-speaking" => array('A' => 0, 'B' => 0, 'C' => 1, 'D' => 1, 'E' => 3, 'F' => 3, 'G' => 6, 'H' => 6),
                    "q5ii-sol-listening" => array('A' => 0, 'B' => 0, 'C' => 1, 'D' => 1, 'E' => 3, 'F' => 3, 'G' => 6, 'H' => 6),
                    "q5ii-sol-reading" => array('A' => 0, 'B' => 0, 'C' => 1, 'D' => 1, 'E' => 3, 'F' => 3, 'G' => 6, 'H' => 6),
                    "q5ii-sol-writing" => array('A' => 0, 'B' => 0, 'C' => 1, 'D' => 1, 'E' => 3, 'F' => 3, 'G' => 6, 'H' => 6),
                    "q6i" => array('A' => 0, 'B' => 35, 'C' => 46, 'D' => 56, 'E' => 63, 'F' => 70),
                    "q8a" => array('A' => 200, 'B' => 50, 'C' => 0),
                    "q10i" => array('A' => 0, 'B' => 15),
                    "q9" => array('A' => 0, 'B' => 600),
                    "q10" => array('A' => 0, 'B' => 2, 'C' => 6, 'D' => 7, 'E' => 8, 'F' => 9, 'G' => 10, 'H' => 10),
                    "q11" => array('A' => 0, 'B' => 5, 'C' => 7, 'D' => 8, 'E' => 9, 'F' => 10),
                    "q12ii-fol-speaking" => array('A' => 0, 'B' => 0, 'C' => 1, 'D' => 1, 'E' => 3, 'F' => 3, 'G' => 5, 'H' => 5),
                    "q12ii-fol-listening" => array('A' => 0, 'B' => 0, 'C' => 1, 'D' => 1, 'E' => 3, 'F' => 3, 'G' => 5, 'H' => 5),
                    "q12ii-fol-reading" => array('A' => 0, 'B' => 0, 'C' => 1, 'D' => 1, 'E' => 3, 'F' => 3, 'G' => 5, 'H' => 5),
                    "q12ii-fol-writing" => array('A' => 0, 'B' => 0, 'C' => 1, 'D' => 1, 'E' => 3, 'F' => 3, 'G' => 5, 'H' => 5),
                );
            } else {
                /* single */
                $response = array(
                    "q3" => array('A' => 0, 'B' => 99, 'C' => 105, 'D' => 110, 'E' => 105, 'F' => 110, 'G' => 110, 'H' => 110, 'I' => 110, 'J' => 110, 'K' => 110, 'L' => 110, 'M' => 110, 'N' => 105, 'O' => 99, 'P' => 94, 'Q' => 88, 'R' => 83, 'S' => 77, 'T' => 72, 'U' => 66, 'V' => 61, 'W' => 55, 'X' => 50, 'Y' => 39, 'Z' => 28, 'AA' => 17, 'AB' => 6, 'AC' => 0),
                    "q4" => array('A' => 0, 'B' => 30, 'C' => 90, 'D' => 98, 'E' => 120, 'F' => 128, 'G' => 135, 'H' => 150),
                    "q4c" => array('A' => 0, 'B' => 15, 'C' => 30),
                    "q5i-b-speaking" => array('A' => 0, 'B' => 6, 'C' => 6, 'D' => 9, 'E' => 17, 'F' => 23, 'G' => 31, 'H' => 34),
                    "q5i-b-listening" => array('A' => 0, 'B' => 6, 'C' => 6, 'D' => 9, 'E' => 17, 'F' => 23, 'G' => 31, 'H' => 34),
                    "q5i-b-reading" => array('A' => 0, 'B' => 6, 'C' => 6, 'D' => 9, 'E' => 17, 'F' => 23, 'G' => 31, 'H' => 34),
                    "q5i-b-writing" => array('A' => 0, 'B' => 6, 'C' => 6, 'D' => 9, 'E' => 17, 'F' => 23, 'G' => 31, 'H' => 34),
                    "q5ii-sol-speaking" => array('A' => 0, 'B' => 0, 'C' => 1, 'D' => 1, 'E' => 3, 'F' => 3, 'G' => 6, 'H' => 6),
                    "q5ii-sol-listening" => array('A' => 0, 'B' => 0, 'C' => 1, 'D' => 1, 'E' => 3, 'F' => 3, 'G' => 6, 'H' => 6),
                    "q5ii-sol-reading" => array('A' => 0, 'B' => 0, 'C' => 1, 'D' => 1, 'E' => 3, 'F' => 3, 'G' => 6, 'H' => 6),
                    "q5ii-sol-writing" => array('A' => 0, 'B' => 0, 'C' => 1, 'D' => 1, 'E' => 3, 'F' => 3, 'G' => 6, 'H' => 6),
                    "q6i" => array('A' => 0, 'B' => 40, 'C' => 53, 'D' => 64, 'E' => 72, 'F' => 80),
                    "q8a" => array('A' => 200, 'B' => 50, 'C' => 0),
                    "q9" => array('A' => 0, 'B' => 600),
                    "q10i" => array('A' => 0, 'B' => 15),
                );
            }
            return $response;

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * @param $userScoresList
     * @param $married
     * @return \Illuminate\Http\RedirectResponse|int[]
     */
    public function official_languages($userScoresList, $married)
    {
        try {
            $firstOfficialLanguage = floatval($userScoresList['q5i-b-speaking']) +
                floatval($userScoresList['q5i-b-listening']) +
                floatval($userScoresList['q5i-b-reading']) +
                floatval($userScoresList['q5i-b-writing']);
            if ($married) {
                $firstOfficialLanguage = ($firstOfficialLanguage >= 128) ? 128 : $firstOfficialLanguage;
            }

            if (isset($userScoresList['q5ii-sol-speaking'])) {
                $secondOfficialLanguage = floatval($userScoresList['q5ii-sol-speaking']) +
                    floatval($userScoresList['q5ii-sol-listening']) +
                    floatval($userScoresList['q5ii-sol-reading']) +
                    floatval($userScoresList['q5ii-sol-writing']);
                if ($married) {
                    $secondOfficialLanguage = ($secondOfficialLanguage >= 22) ? 22 : $secondOfficialLanguage;
                }
            } else {
                $secondOfficialLanguage = 0;
            }

            return array('firstOfficialLanguage' => $firstOfficialLanguage, 'secondOfficialLanguage' => $secondOfficialLanguage);

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * @param $request
     * @param $userScoresList
     * @return float|\Illuminate\Http\RedirectResponse|int
     */
    public function spouse_official_languages($request, $userScoresList)
    {
        try {
            if ($request['q12i'] == "E") {
                $firstOfficialLanguage = 0;
            } else {
                $firstOfficialLanguage = floatval($userScoresList['q12ii-fol-speaking']) +
                    floatval($userScoresList['q12ii-fol-listening']) +
                    floatval($userScoresList['q12ii-fol-reading']) +
                    floatval($userScoresList['q12ii-fol-writing']);
            }
            return $firstOfficialLanguage;

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * @param $request
     * @return \Illuminate\Http\RedirectResponse|int
     */
    public function official_language_proficiency_and_education($request)
    {
        try {
            $response = 0;
            if (
                in_array($request['q5i-b-speaking'], array('H', 'G')) &&
                in_array($request['q5i-b-listening'], array('H', 'G')) &&
                in_array($request['q5i-b-reading'], array('H', 'G')) &&
                in_array($request['q5i-b-writing'], array('H', 'G'))
            ) {
                if (in_array($request['q4'], array('C', 'D', 'E'))) $response = 25;
                elseif (in_array($request['q4'], array('F', 'G', 'H'))) $response = 50;

            } elseif (
                in_array($request['q5i-b-speaking'], array('H', 'G', 'F', 'E')) &&
                in_array($request['q5i-b-listening'], array('H', 'G', 'F', 'E')) &&
                in_array($request['q5i-b-reading'], array('H', 'G', 'F', 'E')) &&
                in_array($request['q5i-b-writing'], array('H', 'G', 'F', 'E'))
            ) {
                if (in_array($request['q4'], array('C', 'D', 'E'))) $response = 13;
                elseif (in_array($request['q4'], array('F', 'G', 'H'))) $response = 25;
            }

            return $response;

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * @param $request
     * @return \Illuminate\Http\RedirectResponse|int
     */
    public function canadian_work_experience_and_education($request)
    {
        try {
            $response = 0;
            if (in_array($request['q4'], array('H', 'G', 'F'))) {
                if (in_array($request['q6i'], array('C', 'D', 'E', 'F'))) $response = 50;
                elseif ($request['q6i'] == 'B') $response = 25;

            } elseif (in_array($request['q4'], array('E', 'D', 'C'))) {
                if (in_array($request['q6i'], array('C', 'D', 'E', 'F'))) $response = 25;
                elseif ($request['q6i'] == 'B') $response = 13;
            }

            return $response;

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * @param $request
     * @return \Illuminate\Http\RedirectResponse|int
     */
    public function official_language_proficiency_and_foreign_work_experience($request)
    {
        try {
            $result = 0;
            if (
                in_array($request['q5i-b-speaking'], array('H', 'G')) &&
                in_array($request['q5i-b-listening'], array('H', 'G')) &&
                in_array($request['q5i-b-reading'], array('H', 'G')) &&
                in_array($request['q5i-b-writing'], array('H', 'G'))
            ) {
                if ($request['q6ii'] == "B" || $request['q6ii'] == "C") $result = 25;
                elseif ($request['q6ii'] == "D") $result = 50;

            } elseif (
                in_array($request['q5i-b-speaking'], array('H', 'G', 'F', 'E')) &&
                in_array($request['q5i-b-listening'], array('H', 'G', 'F', 'E')) &&
                in_array($request['q5i-b-reading'], array('H', 'G', 'F', 'E')) &&
                in_array($request['q5i-b-writing'], array('H', 'G', 'F', 'E'))
            ) {
                if ($request['q6ii'] == "B" || $request['q6ii'] == "C") $result = 13;
                elseif ($request['q6ii'] == "D") $result = 25;
            }

            return $result;

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * @param $request
     * @return \Illuminate\Http\RedirectResponse|int
     */
    public function canadian_and_foreign_work_experience($request)
    {
        try {
            $result = 0;
            if ($request['q6ii'] == "B" || $request['q6ii'] == "C") {
                if ($request['q6i'] == 'B') $result = 13;
                else if (in_array($request['q6i'], array('C', 'D', 'E', 'F'))) $result = 25;

            } elseif ($request['q6ii'] == "D") {
                if ($request['q6i'] == 'B') $result = 25;
                else if (in_array($request['q6i'], array('C', 'D', 'E', 'F'))) $result = 50;
            }

            return $result;

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * @param $request
     * @return \Illuminate\Http\RedirectResponse|int
     */
    public function certificate_of_qualification($request)
    {
        try {
            $result = 0;
            if (
                in_array($request['q5i-b-speaking'], array('H', 'G', 'F', 'E')) &&
                in_array($request['q5i-b-listening'], array('H', 'G', 'F', 'E')) &&
                in_array($request['q5i-b-reading'], array('H', 'G', 'F', 'E')) &&
                in_array($request['q5i-b-writing'], array('H', 'G', 'F', 'E'))
            ) {
                if ($request['q7'] == "B") $result = 50;

            } elseif (
                in_array($request['q5i-b-speaking'], array('H', 'G', 'F', 'E', 'D', 'C')) &&
                in_array($request['q5i-b-listening'], array('H', 'G', 'F', 'E', 'D', 'C')) &&
                in_array($request['q5i-b-reading'], array('H', 'G', 'F', 'E', 'D', 'C')) &&
                in_array($request['q5i-b-writing'], array('H', 'G', 'F', 'E', 'D', 'C'))
            ) {
                if ($request['q7'] == "B") $result = 25;
            }

            return $result;

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * @param $request
     * @return \Illuminate\Http\RedirectResponse|int
     */
    public function french_language_skills($request)
    {
        try {
            $french_language_skills = 0;
            if ($request['q5i-a'] == "C" || $request['q5i-a'] == "D") {
                if (
                (
                    in_array($request['q5i-b-speaking'], array('H', 'G', 'F', 'E')) &&
                    in_array($request['q5i-b-listening'], array('H', 'G', 'F', 'E')) &&
                    in_array($request['q5i-b-reading'], array('H', 'G', 'F', 'E')) &&
                    in_array($request['q5i-b-writing'], array('H', 'G', 'F', 'E'))
                )
                ) {
                    if (
                        in_array($request['q5ii'], array('A', 'B')) &&
                        (
                            in_array($request['q5ii-sol-speaking'], array('H', 'G', 'F', 'E', 'D', 'C')) &&
                            in_array($request['q5ii-sol-listening'], array('H', 'G', 'F', 'E', 'D', 'C')) &&
                            in_array($request['q5ii-sol-reading'], array('H', 'G', 'F', 'E', 'D', 'C')) &&
                            in_array($request['q5ii-sol-writing'], array('H', 'G', 'F', 'E', 'D', 'C'))
                        )
                    ) {
                        $french_language_skills = 50;
                    } else {
                        $french_language_skills = 25;
                    }
                }
            } elseif ($request['q5ii'] == "A" || $request['q5ii'] == "B") {
                if (
                (
                    in_array($request['q5ii-sol-speaking'], array('H', 'G', 'F', 'E')) &&
                    in_array($request['q5ii-sol-listening'], array('H', 'G', 'F', 'E')) &&
                    in_array($request['q5ii-sol-reading'], array('H', 'G', 'F', 'E')) &&
                    in_array($request['q5ii-sol-writing'], array('H', 'G', 'F', 'E'))
                )
                ) {
                    if (
                    (
                        in_array($request['q5i-b-speaking'], array('H', 'G', 'F', 'E', 'D', 'C')) &&
                        in_array($request['q5i-b-listening'], array('H', 'G', 'F', 'E', 'D', 'C')) &&
                        in_array($request['q5i-b-reading'], array('H', 'G', 'F', 'E', 'D', 'C')) &&
                        in_array($request['q5i-b-writing'], array('H', 'G', 'F', 'E', 'D', 'C'))
                    )
                    ) {
                        $french_language_skills = 50;
                    } else {
                        $french_language_skills = 25;
                    }
                }
            }

            return $french_language_skills;

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * @param $finalUserScoresList
     * @param $married
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public function total_calculator($finalUserScoresList, $married)
    {
        try {
            // 1.start 500 point maximum (With a spouse or common-law partner: Maximum 460)
            $total = floatval($finalUserScoresList['human_capital_factors']['age']) +
                floatval($finalUserScoresList['human_capital_factors']['level_of_education']) +
                floatval($finalUserScoresList['human_capital_factors']['official_languages']['first_official_language']) +
                floatval($finalUserScoresList['human_capital_factors']['official_languages']['second_official_language']) +
                floatval($finalUserScoresList['human_capital_factors']['canadian_work_experience']);
            if ($married) {
                $finalUserScoresList['human_capital_factors']['total'] = ($total >= 460) ? 460 : $total;
            } else {
                $finalUserScoresList['human_capital_factors']['total'] = $total;
            }

            $total = floatval($finalUserScoresList['spouse_factors']['level_of_education']) +
                floatval($finalUserScoresList['spouse_factors']['first_official_languages']) +
                floatval($finalUserScoresList['spouse_factors']['canadian_work_experience']);
            $finalUserScoresList['spouse_factors']['total'] = $total;

            $total = floatval($finalUserScoresList['human_capital_factors']['total']) + floatval($finalUserScoresList['spouse_factors']['total']);
            $finalUserScoresList['human_capital_factors']['human_capital_spouse_total'] = ($total >= 500) ? 500 : $total;
            // 1.end

            // 2.start 100 point maximum
            $total = floatval($finalUserScoresList['skill_transferability_factors']['education']['official_language_proficiency_and_education']) +
                floatval($finalUserScoresList['skill_transferability_factors']['education']['canadian_work_experience_and_education']);
            $finalUserScoresList['skill_transferability_factors']['education']['total'] = $total;

            $total = floatval($finalUserScoresList['skill_transferability_factors']['foreign_work_experience']['official_language_proficiency_and_foreign_work_experience']) +
                floatval($finalUserScoresList['skill_transferability_factors']['foreign_work_experience']['canadian_and_foreign_work_experience']);
            $finalUserScoresList['skill_transferability_factors']['foreign_work_experience']['total'] = $total;

            $total = floatval($finalUserScoresList['skill_transferability_factors']['education']['total']) +
                floatval($finalUserScoresList['skill_transferability_factors']['foreign_work_experience']['total']) +
                floatval($finalUserScoresList['skill_transferability_factors']['certificate_of_qualification']);
            $finalUserScoresList['skill_transferability_factors']['total'] = ($total >= 100) ? 100 : $total;
            // 2.end

            // 3.start 600 point maximum
            $total = floatval($finalUserScoresList['additional_points']['provincial_nomination']) +
                floatval($finalUserScoresList['additional_points']['job_offer']) +
                floatval($finalUserScoresList['additional_points']['study_in_canada']) +
                floatval($finalUserScoresList['additional_points']['sibling_in_canada']) +
                floatval($finalUserScoresList['additional_points']['french_language_skills']);
            $finalUserScoresList['additional_points']['total'] = ($total >= 600) ? 600 : $total;
            // 3.end

            $finalUserScoresList['total'] = floatval($finalUserScoresList['human_capital_factors']['human_capital_spouse_total']) +
                floatval($finalUserScoresList['skill_transferability_factors']['total']) +
                floatval($finalUserScoresList['additional_points']['total']);

            return $finalUserScoresList;

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }
}
