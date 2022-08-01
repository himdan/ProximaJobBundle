<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 23/07/22
 * Time: 06:54 م
 */

namespace Proxima\JobBundle\IO;


use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class SubjectResolver
 * @package Proxima\JobBundle\IO
 */
class SubjectResolver implements LoggerAwareInterface
{

    /**
     * @var SerializerInterface $serializer
     */
    private $serializer;
    /**
     * @var LoggerInterface $logger
     */
    private $logger;

    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }


    /**
     * SubjectResolver constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }


    public function resolveArgAs(
        string $type,
        $var,
        $value)
    {
        $data = is_array($value) ? \json_encode($value) : $value;
        $data = false === $data ? $value : $data;
        try {
            if (!is_string($data)) {
                return false;
            }
            return $this->serializer->deserialize($data, $type, 'json');
        } catch (\Exception $exception) {
            $this->logger->info(sprintf('Unable to deserialize %s for data %s', $var, $data));
            return false;
        }
    }


    public function makeArg($data)
    {
        $cases = [
            true => function ($data) {
                return $this->serializer->serialize($data, 'json');
            },
            false => function ($data) {
                return \json_encode($data);
            }
        ];
        return call_user_func($cases[is_object($data)], $data);
    }


}