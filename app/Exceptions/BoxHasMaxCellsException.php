<?php


namespace App\Exceptions;


use DomainException;
use Throwable;

class BoxHasMaxCellsException extends DomainException
{
    public function __construct($maxCount, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->message = 'В шкафу уже итак находится максимальное кол-во ячеек: ' . $maxCount;
    }
}
