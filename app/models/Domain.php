<?php
class Domain extends Entity
{
    protected $DomainID;
    protected $DomainName;

 
    public function setDomainID($value)
    {
	$this->DomainID = $value;
    }
    

    public function setDomainName($value)
    {
        $this->DomainName = $value;
    }
    

    
}
