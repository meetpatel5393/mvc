<?php
namespace Controller\Core;
class Pager
{
    protected $totalRecord;
    protected $recordPerPage = 2;
    protected $noOfPage;
    protected $start = 1;
    protected $end;
    protected $previous;
    protected $next;
    protected $currentPage;

    public function setTotalRecord($totalRecord)
    {
        $this->totalRecord = (int) $totalRecord;
        return $this;
    }
    
    public function getTotalRecord()
    {
        return $this->totalRecord;
    }
    
    public function setRecordPerPage($recordPerPage)
    {
        $this->recordPerPage = (int) $recordPerPage;
        return $this;
    }
    
    public function getRecordPerPage()
    {
        return $this->recordPerPage;
    }

    public function setNoOfPage($noOfPage){
        $this->noOfPage = (int)$noOfPage;
        return $this;
    }

    public function getNoOfPage(){
        return $this->noOfPage;
    }
    
    public function setStart($start)
    {
        $this->start = (int) $start;
        return $this;
    }
    
    public function getStart()
    {
        return $this->start;
    }
    
    public function setEnd($end)
    {
        $this->end = (int) $end;
        return $this;
    }
    
    public function getEnd()
    {
        return $this->end;
    }
    
    public function setPrevious($previous)
    {
        $this->previous = (int) $previous;
        return $this;
    }
    
    public function getPrevious()
    {
        return $this->previous;
    }
    
    public function setNext($next)
    {
        $this->next = (int) $next;
        return $this;
    }
    
    public function getNext()
    {
        return $this->next;
    }
    
    public function setCurrentPage($currentPage)
    {
        $this->currentPage = (int) $currentPage;
        return $this;
    }
    
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function calculate()
    {
        if($this->getTotalRecord() >= $this->getRecordPerPage()) {
            $pages = $this->getTotalRecord()/$this->getRecordPerPage();
            $this->setNoOfPage($pages);
            $this->setEnd($pages);
        }

        if($this->getCurrentPage() <= $this->getStart()) {
            $this->setCurrentPage($this->getStart());
            $this->setPrevious(null);
            $this->setNext($this->getCurrentPage() + 1);
            return true;
        }

        if($this->getCurrentPage() >= $this->getEnd()) {
            $this->setCurrentPage($this->getEnd());
            $this->setNext(null);
            $this->setPrevious($this->getCurrentPage() - 1);
            return true;
        }

        if($this->getCurrentPage() > $this->getStart() && $this->getCurrentPage() < $this->getEnd()) {
            $this->setNext($this->getCurrentPage() + 1);
            $this->setPrevious($this->getCurrentPage() - 1);
        }
    }
}