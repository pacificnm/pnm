<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View;

class Paginator extends AbstractHelper 
{
    protected $pageRange;
    protected $previous;
    protected $next;
    protected $itemCountPerPage;
    protected $currentPageNumber;
    protected $pageCount;
    
    /**
     * View instance used for self rendering
     *
     * @var \Zend\View\Renderer\RendererInterface
     */
    protected $view = null;

    /**
     * 
     * @param number $itemCountPerPage
     * @param number $itemCount
     * @param number $pageCount
     * @param number $page
     * @param unknown $routeParams
     * @param unknown $queryParams
     */
    public function __invoke($itemCountPerPage = 10, $itemCount = 0, $pageCount = 0, $page = 1, $routeParams, $queryParams)
    {
        $this->setItemCountPerPage($itemCountPerPage);
        $this->setCurrentPageNumber($page);
        $this->setPageCount($pageCount);
        
        $pages = new \stdClass();
        $pages->pageCount        = $this->getPageCount();
        $pages->itemCountPerPage = $this-> getItemCountPerPage();
        $pages->first            = 1;
        $pages->current          = $page;
        $pages->last             = $this->getPageCount();
        
        
       
       
        // Previous and next
        if ($page - 1 > 0) {
            $pages->previous = $page - 1;
        }

        if ($page + 1 <= $pageCount) {
            $pages->next = $page + 1;
        }
        
        // Pages in range
        
        $pages->pagesInRange     = $this->getPages(10);
        $pages->firstPageInRange = min($pages->pagesInRange);
        $pages->lastPageInRange  = max($pages->pagesInRange);
        
        $view = $this->getView();
       
        $partialHelper = $view->plugin('partial');
        $pages->routeParams = $routeParams;
        $pages->queryParams = $queryParams;
        return $partialHelper('partials/paginator.phtml', $pages);
    }


    /**
     * 
     * @param unknown $pageRange
     * @return number[]|unknown[]
     */
    public function getPages( $pageRange = null)
    {
        if ($pageRange === null) {
            $pageRange = $this->getPageRange();
        }

        $pageNumber = $this->getCurrentPageNumber();
        $pageCount  = $this->getPageCount();

        if ($pageRange > $pageCount) {
            $pageRange = $pageCount;
        }

        $delta = ceil($pageRange / 2);

        if ($pageNumber - $delta > $pageCount - $pageRange) {
            $lowerBound = $pageCount - $pageRange + 1;
            $upperBound = $pageCount;
        } else {
            if ($pageNumber - $delta < 0) {
                $delta = $pageNumber;
            }

            $offset     = $pageNumber - $delta;
            $lowerBound = $offset + 1;
            $upperBound = $offset + $pageRange;
        }

        return $this->getPagesInRange($lowerBound, $upperBound);
    }

    /**
     * 
     */
    public function getPageCount()
    {
        return $this->pageCount;
    }
    
    public function setPageCount($pageCount)
    {
        if (empty($this->pageCount)) {
            $this->pageCount = $pageCount;
        }
        return $this->pageCount;
    }
    
    public function getCurrentPageNumber()
    {
        return $this->currentPageNumber;
    }
    
    
    public function setCurrentPageNumber($pageNumber)
    {
        if (empty($this->currentPageNumber)) {
            $this->currentPageNumber = (int) $pageNumber;
        }
        
        return $this->currentPageNumber;
    }


    public function setItemCountPerPage($itemCountPerPage)
    {
       if (empty($this->itemCountPerPage)) {
            $this->itemCountPerPage = $itemCountPerPage;
        }
        return $this->itemCountPerPage;
    }

    public function getItemCountPerPage()
    {
        return $this->itemCountPerPage;
    }

    public function getPageRange()
    {
        return $this->pageRange;
    }
    
    public function setPageRange($pageRange)
    {
        $this->pageRange = (int) $pageRange;

        return $this;
    }
    
    public function getPagesInRange($lowerBound, $upperBound)
    {
        $lowerBound = $this->normalizePageNumber($lowerBound);
        $upperBound = $this->normalizePageNumber($upperBound);

        $pages = array();

        for ($pageNumber = $lowerBound; $pageNumber <= $upperBound; $pageNumber++) {
            $pages[$pageNumber] = $pageNumber;
        }

        return $pages;
    }
    
    
    
    public function normalizePageNumber($pageNumber)
    {
        $pageNumber = (int) $pageNumber;

        if ($pageNumber < 1) {
            $pageNumber = 1;
        }

        $pageCount = $this->getPageCount();

        if ($pageCount > 0 && $pageNumber > $pageCount) {
            $pageNumber = $pageCount;
        }

        return $pageNumber;
    }
    
    
    public function getView()
    {
        if ($this->view === null) {
            $this->setView(new View\Renderer\PhpRenderer());
        }

        return $this->view;
    }
    
     /**
     * Sets the view object.
     *
     * @param  \Zend\View\Renderer\RendererInterface $view
     * @return Paginator
     */
    public function setView(View\Renderer\RendererInterface $view = null)
    {
        $this->view = $view;

        return $this;
    }
    
    
}