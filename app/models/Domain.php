<?php
class Domain extends Entity
{
    protected $domainID;
    protected $name;
    
    // sanitize and validate name (optional) 
    public function setName($value)
    {
        $value = htmlspecialchars(trim($value), ENT_QUOTES);
        if (empty($value) || strlen($value) < 3) {
            throw new ValidationException('Invalid name');
        }
        $this->name = $value;
    }
    

}
