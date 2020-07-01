<?php

namespace App\Application;

/**
 * @author Enrique García <enrique@inodata.mx>
 * Date: 01/07/20 Time: 0:19
 */
class ApiProblem
{
    private $statusCode;
    private $type;
    private $title;
    private $extraData = [];

    public function __construct($statusCode, $type, $title)
    {
        $this->statusCode = $statusCode;
        $this->type = $type;
        $this->title = $title;
    }

    public function set($name, $value)
    {
        $this->extraData[$name] = $value;
    }

    public function toArray()
    {
        return array_merge(
            [
                'status' => $this->statusCode,
                'type'   => $this->type,
                'title'  => $this->title,
            ],
            $this->extraData
        );
    }
}