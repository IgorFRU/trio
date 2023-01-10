<?php

namespace App\Http\Middleware;

use App\BlackIp;
use Closure;

class BlockIp
{
    protected $ip;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->ip = $request->ip;
        if ($this->badIP()) {
            return abort(403);
        }

        return $next($request);
    }

    public function badIP() {
        $ip = BlackIp::all();
        // dd($ip);
        if (count($ip)) {
            foreach ($ip as $key => $value) {
                if ($value->ip) {
                    $ip = $value->ip;
                    $arr = preg_split("/[.]/", $ip);
                    $arr_user = preg_split("/[.]/", $this->ip);
                    if ($arr_user[0] == $arr[0]) {
                        if ($arr_user[1] == $arr[1]) {
                            if ($arr[2] == '*' || $arr[3] == '*') {
                                $first_1 = ($arr[2] == '*') ? '0' : $arr[2] ;
                                $first_2 = ($arr[2] == '*') ? '255' : $arr[2] ;
                                $second_1 = ($arr[3] == '*') ? '0' : $arr[3] ;
                                $second_2 = ($arr[3] == '*') ? '255' : $arr[3] ;

                                if ($this->diapasoneCheck(collect([$arr[0], $arr[1], $first_1, $second_1]), collect([$arr[0], $arr[1], $first_2, $second_2]))) {
                                    return true;
                                } else {
                                    return false;
                                }                                
                            } else {
                                if ($this->ip == $ip) {
                                    return true;
                                }
                            }
                        }
                    }                   
                    
                } else {
                    # code...
                }                
            }
        } else {
            return false;
        }
    }

    public function diapasoneCheck($start, $stop) {
        // dd($start, $stop);        
        for ($i=$start[2]; $i <= $stop[2] ; $i++) { 
            for ($j=$start[3]; $j <= $stop[3] ; $j++) { 
                // dd(collect([$start[0], $start[1], $i, $j])->implode('.'));
                if ($this->ip == collect([$start[0], $start[1], $i, $j])->implode('.')) {
                    return true;
                }
            }
        }

        return false;
    }
}
