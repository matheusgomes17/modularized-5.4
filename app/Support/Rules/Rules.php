<?php

namespace App\Support\Rules;

use App\Support\Database\Eloquent\Contracts\ModelContract;
use App\Support\Rules\Contracts\Rules as RulesContract;

class Rules implements RulesContract
{
    protected $entity;

    public function __construct(ModelContract $entity = null)
    {
        $this->entity = $entity ?: (new $this->entity);
    }

    public function defaultRules()
    {
        return [];
    }

    protected function returnRules(array $rules = [], $callback = null)
    {
        $rules = array_merge($this->defaultRules(), $rules);
        if (is_callable($callback)) {
            return $callback($rules);
        }

        return $rules;
    }

    /**
     * @param string  $type
     * @param mixed $callback
     *
     * @return array
     */
    public function byRequestType($type, $callback = null)
    {
        $type = mb_strtolower($type);

        switch ($type) {
            case 'post':
                return method_exists($this, 'creating') ? $this->creating($callback) : [];
                break;
            case 'put':
                return method_exists($this, 'updating') ? $this->updating($callback) : [];
                break;
            default:
                return $this->defaultRules();
        }
    }
}
