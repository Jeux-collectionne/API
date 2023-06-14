<?php

namespace App\Helper;

use Symfony\Component\Validator\Validator\ValidatorInterface;

class CustomHelper
{
    public function __construct(private ValidatorInterface $validator)
    {}
    
    public function validate(mixed $object)
    {
        if (is_object($object)) {
            if (count($this->validator->validate($object)) > 0) {
                $error = $this->validator->validate($object)->get(0);
                $response = [
                    'code' => 500,
                    'message' => $error->getMessage() . ' => ' . $error->getPropertyPath() . ' : ' . $error->getInvalidValue()
                ];
                return $response;
            }
            return null;
        }
        return [
            'code' => 500,
            'message' => 'You must pass an array to validate'
        ];
    }
}