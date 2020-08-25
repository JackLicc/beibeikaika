<?php declare(strict_types=1);

namespace App\Helpers;

class ErrorCode {
    const SUCCESS = [0, 'ok'];
    const ERROR = [1, 'error'];
    const EMAIL_HAS_BEEN_TAKEN = [10000, 'email has been taken'];
    const INVALID_CREDENTIALS = [10001, 'invalid credentials'];
    const INVALID_VERIFICATION_CODE = [10002, 'invalid verification code'];
}
