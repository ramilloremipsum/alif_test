<?php


namespace App\Exceptions;


use App\Boxes;
use DomainException;
use Throwable;

class CellAlreadyExistsInBox extends DomainException
{
    public function __construct(Boxes $box, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->message = 'В шкафу "'.$box->title.'" уже есть ячейка с таким именем';
    }
}
