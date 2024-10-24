<?php

namespace App\Concern;

trait WorkingWithTBModels
{
    public function getModelId()
    {
        return $this->{$this->getKeyName()};
    }

    public function getModelName()
    {
        return $this->getTable();
    }
}
