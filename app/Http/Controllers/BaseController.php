<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Helpers\ErrorCode;

class BaseController extends Controller
{
    public function success(array $data) {
        $response = ErrorCode::SUCCESS;
        return json_encode(['code' => $response[0], 'message' => $response[1], 'data' => $data]);
    }

    public function error(array $error = ErrorCode::ERROR) {
        return json_encode(['code' => $error[0], 'message' => $error[1]]);
    }
}
