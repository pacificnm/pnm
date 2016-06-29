<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace AccountLedger\Service;

use AccountLedger\Entity\LedgerEntity;
use AccountLedger\Mapper\LedgerMapperInterface;

/**
 * 
 * @author jaimie
 *
 */
class LedgerService implements LedgerServiceInterface
{

    /**
     * 
     * @var LedgerMapperInterface
     */
    protected $mapper;

    
    /**
     * 
     * @param LedgerMapperInterface $mapper
     */
    public function __construct(LedgerMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \AccountLedger\Service\LedgerServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \AccountLedger\Service\LedgerServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \AccountLedger\Service\LedgerServiceInterface::save()
     */
    public function save(LedgerEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \AccountLedger\Service\LedgerServiceInterface::delete()
     */
    public function delete(LedgerEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
    
    
}