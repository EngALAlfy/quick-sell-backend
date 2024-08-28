<?php

namespace App\Http\Controllers;

use App\Traits\JsonFuncsTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    use JsonFuncsTrait;

}
