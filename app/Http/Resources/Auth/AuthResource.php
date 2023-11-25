<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    //define properti
    public $status;
    public $code;
    public $message;
    public $resource;
    
    /**
     * __construct
     *
     * @param  mixed $status
     * @param  mixed $code
     * @param  mixed $message
     * @param  mixed $resource
     * @return void
     */
    public function __construct($status, $code, $message, $resource)
    {
        parent::__construct($resource);
        $this->status  = $status;
        $this->code = $code;
        $this->message = $message;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) : array
    {
        return [
            'status'   => $this->status,
            // 'code'   => $this->code,
            'message'   => $this->message,
            'data'      => $this->resource
        ];
    }
    public function withResponse($request, $response)
    {
        $response->setStatusCode($this->code);
    }
}
