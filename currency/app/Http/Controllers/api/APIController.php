<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response as IlluminateResponse;
use Response;
use App\Currency;
use DateTime;

/**
 * Base API Controller.
 */
class APIController extends Controller
{
    /**
     * default status code.
     *
     * @var int
     */
    protected $statusCode = 200;

    /**
     * get the status code.
     *
     * @return statuscode
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * set the status code.
     *
     * @param [type] $statusCode [description]
     *
     * @return statuscode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Respond.
     *
     * @param array $data
     * @param array $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    /**
     * respond with pagincation.
     *
     * @param Paginator $items
     * @param array     $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithPagination($items, $data)
    {
        $data = array_merge($data, [
            'paginator' => [
                'total_count'  => $items->total(),
                'total_pages'  => ceil($items->total() / $items->perPage()),
                'current_page' => $items->currentPage(),
                'limit'        => $items->perPage(),
             ],
        ]);

        return $this->respond($data);
    }

    /**
     * Respond Created.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondCreated($data)
    {
        return $this->setStatusCode(201)->respond([
            'data' => $data,
        ]);
    }

    /**
     * Respond Created with data.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondCreatedWithData($data)
    {
        return $this->setStatusCode(201)->respond($data);
    }

    /**
     * respond with error.
     *
     * @param $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithError($message)
    {
        return $this->respond([
                'error' => [
                    'message'     => $message,
                    'status_code' => $this->getStatusCode(),
                ],
            ]);
    }

    /**
     * responsd not found.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondNotFound($message = 'Not Found')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message);
    }

    /**
     * Respond with error.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondInternalError($message = 'Internal Error')
    {
        return $this->setStatusCode(500)->respondWithError($message);
    }

    /**
     * Respond with unauthorized.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondUnauthorized($message = 'Unauthorized')
    {
        return $this->setStatusCode(401)->respondWithError($message);
    }

    /**
     * Respond with forbidden.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondForbidden($message = 'Forbidden')
    {
        return $this->setStatusCode(403)->respondWithError($message);
    }

    /**
     * Respond with no content.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithNoContent()
    {
        return $this->setStatusCode(204)->respond(null);
    }

    /**Note this function is same as the below function but instead of responding with error below function returns error json
     * Throw Validation.
     *
     * @param string $message
     *
     * @return mix
     */
    public function throwValidation($message)
    {
        return $this->setStatusCode(422)
            ->respondWithError($message);
    }

    /*
        Description: get currency Details
        Created By: Basit Ali
        Date: 12/1/2020
    */
    public function currencyDetails(Request $request){
        $page = $request->page;
        $items_per_page = $request->page_size;  //for example
        $offset = 0;  //initial offset
        if ($page != 1) {
            $offset = ($page * $items_per_page) - $items_per_page;
        }
        $currency = Currency::select('attr_id','value')->limit($items_per_page)->offset($offset)->get();
        return $currency ? $currency : 'No record found';

    }

    /*
        Description: get currency History
        Created By: Basit Ali
        Date: 12/1/2020
    */
    public function currencyHistory(Request $request){
        $id = $request->id;
        $from = $request->from_date;
        $to = $request->to_date;
        $page = $request->page;
        $items_per_page = $request->page_size;  //for example
        $offset = 0;  //initial offset
        if ($page != 1) {
            $offset = ($page * $items_per_page) - $items_per_page;
        }
        $currency = Currency::select('attr_id','value','date')->where('attr_id',$id)->where('date','>=',$from)->where('date','<=',$to)->limit($items_per_page)->offset($offset)->get();
        return $currency ? $currency : 'No record found';

    }
    /*
        Description: Currency list
        Created By: Basit Ali
        Date: 12/1/2020
    */
    public function currencyList(Request $request){
        $this->validate($request,[
            'page'=>'required',
            'page_size'=>'required'
        ]);
        
        $page = $request->page;
        $items_per_page = $request->page_size;  //for example
        $offset = 0;  //initial offset
        if ($page != 1) {
            $offset = ($page * $items_per_page) - $items_per_page;
        }
        $current_date_time = new DateTime("now");
        $user_current_date = $current_date_time->format("Y-m-d");
        $currency = Currency::where('date','=',$user_current_date)->limit($items_per_page)->offset($offset)->get();
        return $currency ? $currency : 'No record found';
    }
    
    /*
        Description: Single Currency History
        Created By: Basit Ali
        Date: 12/1/2020
    */
    public function currencySingleHistory($id){
        
        $currency = Currency::where('attr_id',$id)->get();
        return $currency ? $currency : 'No record found';
    }

    /*
        Description: History of Currency
        Created By: Basit Ali
        Date: 12/1/2020
    */
    public function historyOfCurrency(Request $request){
        $this->validate($request,[
            'page'=>'required',
            'page_size'=>'required',
            'from'=>'required',
            'to'=>'required'
        ]);
        $id = $request->id;
        $from = $request->from;
        $to = $request->to;
        $page = $request->page;
        $items_per_page = $request->page_size;  //for example
        $offset = 0;  //initial offset
        if ($page != 1) {
            $offset = ($page * $items_per_page) - $items_per_page;
        }
        $currency = Currency::where('date','>=',$from)->where('date','<=',$to)->limit($items_per_page)->offset($offset)->get();
        return $currency ? $currency : 'No record found';

    }

    /*
        Description: Get Currecny List
        Created By: Basit Ali
        Date: 12/1/2020
    */
    public function getCurrencyList(){
        $currency = Currency::get();
        return $currency ? $currency : 'No record found';
    }

    /*
        Description: Currency Exchange Rate
        Created By: Basit Ali
        Date: 12/1/2020
    */
    public function currencyExchangeRate(Request $request){
        $baseId = $request->id;

        $current_date_time = new DateTime("now");
        $user_current_date = $current_date_time->format("Y-m-d");
        $currency = Currency::where('date','=',$user_current_date)->get();
        return $currency ? $currency : 'No record found';
    }

}
