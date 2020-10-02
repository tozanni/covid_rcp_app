<?php

namespace App\Application;

use InvalidArgumentException;

/**
 * @author Enrique García <enrique@inodata.mx>
 * Date: 01/07/20 Time: 0:19
 */
class ApiProblem
{
    private const TYPE_VALIDATION_ERROR = 'validation_error';

    private static $titles = [
        self::TYPE_VALIDATION_ERROR => 'Hubo un problema de validación',
    ];

    private $statusCode;
    private $type;
    private $title;
    private $extraData = [];

    public function __construct($statusCode, $type)
    {
        $this->statusCode = $statusCode;
        $this->type = $type;

        if(!isset(self::$titles[$type])){
            throw new InvalidArgumentException('No existe un título para este tipo de error: '.$type);
        }

        $this->title = self::$titles[$type];
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