<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{

    private $user_id = null;

    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function getUserId()
    {
        if ($this->user_id == null) {
            $this->user_id = auth()->guest() ? null : auth()->user()->id;
        }
        return $this->user_id;
    }
}
