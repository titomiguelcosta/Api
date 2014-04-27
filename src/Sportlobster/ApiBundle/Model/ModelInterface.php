<?php

namespace Sportlobster\ApiBundle\Model;

interface ModelInterface
{

    const COMPLETE = 'COMPLETE';
    const MINIFIED = 'MINIFIED';

    public function toArray($type = self::COMPLETE);
}
