<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AllowedEmailDomains implements Rule
{
    protected $allowedDomains;

    public function __construct($allowedDomains)
    {
        $this->allowedDomains = $allowedDomains;
    }

    public function passes($attribute, $value)
    {
        $emailDomain = explode('@', $value)[1] ?? null;

        return in_array($emailDomain, $this->allowedDomains);
    }

    public function message()
    {
        return 'The :attribute must be a valid email address from ' . implode(', ', $this->allowedDomains) . ' domains.';
    }
}
