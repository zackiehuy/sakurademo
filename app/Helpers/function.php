<?php



if (!function_exists('table_action')) {
    /**
     * @param  $actions
     * @return string
     * @author Minh Hao
     * @throws Throwable
     */
    function table_action($actions)
    {

        return view('blocks.action', compact('actions'))->render();
    }

    if (!function_exists('format_numeric')) {
        function format_numeric($item)
        {
            if (is_numeric($item)) {
                $formatter = new Stillat\Numeral\Numeral();
                return $formatter->format($item, '0,0');
            }
        }
    }

    if (!function_exists('recruitment_status')) {
        function recruitment_status($status, $color)
        {
            return view('blocks.status', ['status' => $status, 'color' => $color]);
        }
    }

    if (!function_exists('format_date')) {
        /**
         * @param $time
         * @param string $format
         * @return mixed
         * @author Minh Hao
         */
        function format_date($time, $format = 'd-m-Y')
        {
            if (empty($time)) {
                return $time;
            }
            if (gettype($time) == 'string') {
                $date = strtotime($time);
                return date($format, $date);
            }
            return $time->format($format);
        }
    }
}

if (!function_exists('get_avatar')) {
    /**
     * Get the setting instance.
     *
     * @param string $name
     * @return string|null
     */

    function get_avatar(string $name)
    {
        $words = explode(" ", $name);
        $length = (int)count($words);
        $avatar = "";
        if ($length > 1) {
            $avatar = mb_substr($words[$length-2], 0, 1).''.mb_substr($words[$length-1], 0, 1);
        } else {
            $avatar = mb_substr($words[0], 0, 2);
        }
        return strtoupper($avatar);
    }
}

if (! function_exists('isCurrentFunction')) {
    function isCurrentFunction($names)
    {
        $names = array_map('trim', explode(',', $names));
        return in_array(\Route::currentRouteName(), $names, true);
    }
}

if (! function_exists('linkHref')) {
    function linkHref($names)
    {
        if (isCurrentFunction($names)) {
            return ' c-active ';
        }
        return '';
    }
}

if (! function_exists('dropdownHref')) {
    function dropdownHref($names)
    {
        if (isCurrentFunction($names)) {
            return ' c-show ';
        }
        return '';
    }
}


if (!function_exists('format_phone')) {
    /**
     * @param $time
     * @param string $format
     * @return mixed
     * @author Minh Hao
     */
    function format_phone($phone)
    {
        if (empty($phone)) {
            return $phone;
        }
        $parts = str_split($phone, 4);
        $final = implode(" ", $parts);
        return $final;
    }
}

if (!function_exists('format_currency')) {
    /**
     * @param $time
     * @param string $format
     * @return mixed
     * @author Minh Hao
     */
    function format_currency($currency)
    {
        if (empty($currency)) {
            return 0;
        }
        $currency = str_replace(',', '', $currency);
        $value = 0;
        $mod = 0;
        if (strlen($currency) > 9) {
            $value = intval($currency) / 1e9;
            $mod = intval($currency) % 1e9;
        } elseif (strlen($currency) > 6) {
            $value = intval($currency) / 1e6;
            $mod = intval($currency) % 1e6;
        } elseif (strlen($currency) > 3) {
            $value = intval($currency) / 1e3;
            $mod = intval($currency) % 1e6;
        }
            return number_format($value, $mod, ',', "");
    }
}


if (!function_exists('format_salary')) {
    /**
     * @param $time
     * @param string $format
     * @return mixed
     * @author Minh Hao
     */
    function format_salary($salary_from, $salary_to)
    {
        if ($salary_from == null && $salary_to == null) {
            return 'CÓ THỂ THƯƠNG LƯỢNG';
        } elseif ($salary_to != null && $salary_from != null) {
            $from= format_currency($salary_from);
            $to = format_currency($salary_to);
            $denomination = '';
            $denomination_from = '';
            $length_diff = strlen($salary_to) - strlen($salary_from);
            if ($length_diff <= 2) {
                $check = false;
                if (strlen($salary_to) > 12 && strlen($salary_from) <= 12) {
                    $check = true;
                } elseif (strlen($salary_to) > 8 && strlen($salary_from) <= 8) {
                    $check = true;
                }
                if ($check) {
                    if (strlen($salary_to) > 8) {
                        $denomination_from = ' TRIỆU';
                    } elseif (strlen($salary_to) > 4) {
                        $denomination_from = ' NGHÌN';
                    }
                }
            }
            if (strlen($salary_to) > 12) {
                $denomination = ' TỶ';
            } elseif (strlen($salary_to) > 8) {
                $denomination = ' TRIỆU';
            } elseif (strlen($salary_to) > 4) {
                $denomination = ' NGHÌN';
            }
            return $from . $denomination_from . ' - ' . $to . $denomination;
        } elseif ($salary_to != null && $salary_from == null) {
            $to = format_currency($salary_to);
            $denomination = '';
            if (strlen($salary_to) > 12) {
                $denomination = ' TỶ';
            } elseif (strlen($salary_to) > 8) {
                $denomination = ' TRIỆU';
            } elseif (strlen($salary_to) > 4) {
                $denomination = ' NGHÌN';
            }
            return 'TỐI ĐA ' .  $to . $denomination;
        } elseif ($salary_to == null && $salary_from != null) {
            $from= format_currency($salary_from);
            $denomination = '';
            if (strlen($salary_from) > 12) {
                $denomination = ' TỶ';
            } elseif (strlen($salary_from) > 8) {
                $denomination = ' TRIỆU';
            } elseif (strlen($salary_from) > 4) {
                $denomination = ' NGHÌN';
            }
            return 'TỐI THIỂU ' . $from . $denomination;
        }
    }
}
if (!function_exists('map_address')) {
    /**
     * @param $time
     * @param string $format
     * @return mixed
     * @author Minh Hao
     */
    function map_address($address)
    {
        if (empty($address)) {
            return '';
        }
        return 'http://maps.google.com/maps?q=' . urlencode($address);
    }
}

if (!function_exists('logo_job_company')) {
    /**
     * @param $time
     * @param string $format
     * @return mixed
     * @author Minh Hao
     */
    function logo_job_company($job)
    {
        if (empty($job)) {
            return '';
        }
        if ($job->company_id == null) {
            if ($job->branches->company->logo != null) {
                return asset('storage/images/company') . '/' . $job->branches->company->logo;
            } elseif ($job->branches->company->default_logo != null) {
                return url($job->branches->company->default_logo);
            } else {
                return asset('img/logo_company/sakura.png');
            }
        } else {
            if ($job->company->logo != null) {
                return asset('storage/images/company/'.$job->company->logo);
            } elseif ($job->company->default_logo != null) {
                return url($job->company->default_logo);
            } else {
                return asset('img/logo_company/sakura.png');
            }
        }
    }
}

if (!function_exists('branch_name')) {
    /**
     * @param $time
     * @param string $format
     * @return mixed
     * @author Minh Hao
     */
    function branch_name($job)
    {
        if (empty($job)) {
            return '';
        }
        if ($job->branch_id != null) {
            return '<p>'. $job->branches->name .'</p>';
        } else {
            return '';
        }
    }
}

if (!function_exists('is_company')) {
    /**
     * @param $time
     * @param string $format
     * @return mixed
     * @author Minh Hao
     */
    function is_company($id)
    {
        if (empty($id)) {
            return '';
        }
        if (strpos($id, 'company')) {
            return true;
        }
        return false;
    }
}

if (!function_exists('split_sake')) {
    /**
     * @param $time
     * @param string $format
     * @return mixed
     * @author Minh Hao
     */
    function split_sake($name, $is_name)
    {
        if (empty($name)) {
            return '';
        }

        if (!$is_name) {
            return implode(" ", explode(" ", $name, -1));
        } else {
            $pieces = explode(' ', $name);
            $last_word = array_pop($pieces);
            return $last_word;
        }
    }
}
