<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /*
        Description: Import Data to DB
        Created By: Basit Ali
        Date: 12/1/2020
    */
    public function import(){
        $url = "http://www.cbr.ru/scripts/XML_daily.asp";
        $fileContents= file_get_contents($url);
        $fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);
        $fileContents = trim(str_replace('"', "'", $fileContents));
        $simpleXml = simplexml_load_string($fileContents);
        $json = json_decode(json_encode($simpleXml)); // Remove // if you want to store the result in $json variable
        $currencyDate = $json->{'@attributes'}->Date;
        $formatedDate = date('Y-m-d', strtotime($currencyDate));
        $checkDateExist = Currency::whereDate('date', '=', $formatedDate)->first();

        if(empty($checkDateExist)){
            foreach($json->Valute as $obj){
                $attr_id = $obj->{'@attributes'}->ID;
                $cur = new Currency();
                $cur->attr_id = $attr_id;
                $cur->name = $obj->Name;
                $value = str_replace(',', '', $obj->Value);
                $cur->value = $value;
                $cur->num_code = $obj->NumCode;
                $cur->char_code = $obj->CharCode;
                $cur->nominal = $obj->Nominal;
                $cur->date = $formatedDate;
                $cur->save();
            }
            echo "Data inserted successfully";
        }else{
            echo "The Given date list already in system";
        }
    }
}
