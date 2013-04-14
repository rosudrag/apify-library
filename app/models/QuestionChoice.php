<?php
class QuestionChoice extends Entity
{
    protected $ChoiceID;
    protected $QuestionID;
    protected $IsRightChoice;
    protected $Choice;
    protected $Answer;

 
    public function setChoiceID($value)
    {
	$this->ChoiceID = $value;
    }
    
}
