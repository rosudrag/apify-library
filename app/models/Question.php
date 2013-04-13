<?php
class Domain extends Entity
{
    protected $QuestionID;
    protected $UserID;
    protected $Question = '';
    protected $Difficulty;
    protected $Rank;
    protected $created;

 
    public function setDomainID($value)
    {
	$this->DomainID = $value;
    }
    

    public function setDomainName($value)
    {
        $this->DomainName = $value;
    }
    

    
}
