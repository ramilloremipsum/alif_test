<?php


namespace App\Exceptions;


use App\Boxes;
use App\Workplaces;
use DomainException;
use Throwable;

class BoxAlreadyExistsInWorkplace extends DomainException
{
    public function __construct(Workplaces $workplace, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->message = 'На рабочем месте "'.$workplace->title.'" уже есть шкаф с таким именем';
    }
}
