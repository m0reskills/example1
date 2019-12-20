<?php

namespace App\Entity\Currency;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = ['rate'];
    protected $list = [];


    public function getRate(){
        $url = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req='.date('d.m.Y', time());
        $xml = simplexml_load_file($url);

        if($xml){
            foreach ($xml as $item){
                $code = strval($item->CharCode);
                $curs = $item->Value;
                $this->list[$code] = round( floatval( str_replace(',', '.', $curs)), 2);
            }
            return true;
        } else {
            return false;
        }
    }

    public function get($cur){
        return isset($this->list[$cur]) ? $this->list[$cur] : 0;
    }

    public function saveCurrency($rate)
    {
        if ($this->getRate()) {
            return $this->get($rate);
        }
    }

    static function currentRate ()
    {
        $rates = Rate::all()->last();
        return $rates->rate;
    }
}
