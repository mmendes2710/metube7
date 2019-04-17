<?php

include_once "function.php";
 
class WordCloud
{
    var $wordsArray = array();

    function __construct(){
        $query = "SELECT keyword from keywords";
        $result = mysql_query($query);
        if(!$result){
            die("Could not query db:".mysql_error());
        }
        while($result_row = mysql_fetch_row($result)){
            $this->addWord($result_row[0]);
        }
    }

    function addWord($word, $value = 1){
        if (array_key_exists($word, $this->wordsArray))
            $this->wordsArray[$word] += $value;
        else
            $this->wordsArray[$word] = $value;
    }
 
 
    function getFontSize($percentage){
        $size = "font-size: ";
 
        if ($percentage >= 99)
            $size .= "5em;";
        else if ($percentage >= 95)
            $size .= "4.8em;";
        else if ($percentage >= 80)
            $size .= "4.5em;";
        else if ($percentage >= 70)
            $size .= "4em;";
        else if ($percentage >= 60)
            $size .= "3.8em;";
        else if ($percentage >= 50)
            $size .= "3.5em;";
        else if ($percentage >= 40)
            $size .= "3.3em;";
        else if ($percentage >= 30)
            $size .= "3.1em;";
        else if ($percentage >= 25)
            $size .= "3em;";
        else if ($percentage >= 20)
            $size .= "2.8em;";
        else if ($percentage >= 15)
            $size .= "2.5em;";
        else if ($percentage >= 10)
            $size .= "2em;";
        else if ($percentage >= 5)
            $size .= "1.5em;";
        else
            $size .= "1em;";
 
        return $size;
    }
 
    function buildCloud(){
        $this->max = max($this->wordsArray);
        
        $string = "";

        foreach ($this->wordsArray as $word => $freq)
        {
            if(!empty($word))
            {
                $size = $this->getFontSize(($freq / $this->max) * 100);
                
                $string .= "<a href='cloudresults.php?keyword={$word}' style='font-family: Tahoma; padding: 4px 4px 4px 4px; letter-spacing: 3px; $size' >{$word} &nbsp</a>";
            }
        }
 
        return $string;
    }
 
}
?>