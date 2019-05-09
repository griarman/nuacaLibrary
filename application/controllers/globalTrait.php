<?php

trait GlobalTrait{
    protected function regexp($str, $type = 'name')
    {
        $regexp = [
            'name' => '/^[ա-ֆԱԲԳԴԵԶԷԸԹԺԻԼԽԾԿՀՁՂՃՄՅՆՇՈՉՊՋՌՍՎՏՐՑՈՒՓՔևՕՖ\s0-9]{4,150}$/i',
            'search' => '/^[ա-ֆԱԲԳԴԵԶԷԸԹԺԻԼԽԾԿՀՁՂՃՄՅՆՇՈՉՊՋՌՍՎՏՐՑՈՒՓՔևՕՖ\s0-9]{0,150}$/i'
        ][$type];
        return preg_match($regexp, $str);
    }
}
