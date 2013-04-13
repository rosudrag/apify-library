<?php
class Domain extends Entity
{
    protected $QuestionID;
    protected $UserID;
    protected $Question = '';
    protected $Difficulty;
    protected $Rank;
    protected $created;

 
    public function setQuestionID($value)
    {
	$this->QuestionID = $value;
    }
    

    public function setQuestion($value)
    {
        $this->Question = $value;
    }
    

    
}
