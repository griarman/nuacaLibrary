<?php

trait GlobalTrait{
    protected function regexp($str, $type = 'name')
    {
        $regexp = [
            'name' => '/^[ա-ֆ\s]{4,150}$/i'
        ][$type];
        return preg_match($regexp, $str);
    }
}