<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidImage implements Rule
{
    protected $maxSize;

    public function __construct($maxSize = null)
    {
        $this->maxSize = $maxSize ?? setting('support_image_max');
    }

    public function passes($attribute, $value)
    {
        if (!$value) return true; 

        $allowed = explode(',', setting('support_image_type'));
        $extension = strtolower($value->getClientOriginalExtension());

        return in_array($extension, $allowed) && $value->getSize() <= ($this->maxSize * 1024);
    }

    public function message()
    {
        $allowed = implode(', ', explode(',', setting('support_image_type')));
        return "The :attribute must be a file of type: {$allowed} and max size: {$this->maxSize} KB.";
    }
}
