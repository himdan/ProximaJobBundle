<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 21/07/22
 * Time: 11:23 م
 */

namespace Proxima\JobBundle\Entity;


class State
{
    const QUEUED = 1;
    const RUNNING = 2;
    const STALED = 3;
    const FAILED = -1;
    const SUCCESS = 1;
}