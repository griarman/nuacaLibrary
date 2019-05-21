<?php

trait GlobalTrait{
    protected function regexp($str, $type = 'name')
    {
        $regexp = [
            'name' => '/^[ա-ֆԱԲԳԴԵԶԷԸԹԺԻԼԽԾԿՀՁՂՃՄՅՆՇՈՉՊՋՌՍՎՏՐՑՈՒՓՔևՕՖ\s0-9]{4,150}$/i',
            'bookReg' => '/^[a-zա-ֆևԱԲԳԴԵԶԷԸԹԺԻԼԽԾԿՀՁՂՃՄՅՆՇՈՉՊՋՌՍՎՏՐՑՈՒՓՔևՕՖ\s0-9а-я\.\․\.,]{4,150}$/i',
            'search' => '/^[ա-ֆԱԲԳԴԵԶԷԸԹԺԻԼԽԾԿՀՁՂՃՄՅՆՇՈՉՊՋՌՍՎՏՐՑՈՒՓՔևՕՖ\s0-9]{0,150}$/i',
            'year' => '/^(1\d)|(20)\d{2}$/',
            'digits' => '/^\d{1,3}$/'
        ][$type];
//        echo preg_match($regexp, $str).' ';
        return preg_match($regexp, $str);
    }
}
