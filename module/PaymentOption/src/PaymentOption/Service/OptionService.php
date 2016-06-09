<?php
namespace PaymentOption\Service;

use PaymentOption\Entity\OptionEntity;
use PaymentOption\Mapper\OptionMapperInterface;
use Zend\Cache\Storage\Adapter\Memcached;

class OptionService implements OptionServiceInterface
{

    /**
     *
     * @var OptionMapperInterface
     */
    protected $mapper;

    /**
     *
     * @var Memcached
     */
    protected $memcached;

    /**
     *
     * @param OptionMapperInterface $mapper            
     * @param Memcached $memcached            
     */
    public function __construct(OptionMapperInterface $mapper, Memcached $memcached)
    {
        $this->mapper = $mapper;
        
        $this->memcached = $memcached;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PaymentOption\Service\OptionServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PaymentOption\Service\OptionServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \PaymentOption\Service\OptionServiceInterface::getActive()
     */
    public function getActive()
    {
        $key = 'payment-options-active';
        
        $optionEntitys = $this->memcached->getItem($key);
        
        if (! $optionEntitys) {
            $optionEntitys = $this->getAll(array(
                'paymentOptionEnabled' => 1
            ));
            
            $this->memcached->setItem($key, $optionEntitys);
        }
        
        return $optionEntitys;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PaymentOption\Service\OptionServiceInterface::save()
     */
    public function save(OptionEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PaymentOption\Service\OptionServiceInterface::delete()
     */
    public function delete(OptionEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}