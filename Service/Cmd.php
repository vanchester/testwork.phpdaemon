<?php

namespace Service;

class Cmd
{
    private $count = 0;

    public function getCount()
    {
        return ++$this->count;
    }
}
