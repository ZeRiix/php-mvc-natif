<?php

namespace App\Core;


class Template
{
    private String $folder;

    private String $content;

    private Array $data;


    public function __construct($templateFolder)
    {
        $this->folder = $templateFolder;
    }

    public function addTemplate($template)
    {
        $this->content = file_get_contents($this->folder . $template . '.star.php');  
    }

    public function show()
    {
        foreach ($this->data as $key => $value) {
            $this->content = str_replace('{{' . $key . '}}', $value, $this->content);
        }
        echo $this->content;
    }

    public function addData($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function addDataArray($key, $value)
    {
        $this->data[$key][] = $value;
    }

    /*
    Exemple:
    <div>
        <star:for repeat="3">
            <h1>Test</h1>
        </star:for>
    </div>

    resutl:
    <div>
        <h1>Test</h1>
        <h1>Test</h1>
        <h1>Test</h1>
    </div>
    */

    public function starFor()
    {
        $start = strpos($this->content, '<star:for');
        $end = strpos($this->content, '</star:for>') + 11;
        $repetition = substr($this->content, $start, $end - $start);
        $repeat = substr($repetition, strpos($repetition, 'repeat="') + 8);
        $repeat = intval(substr($repeat, 0, strpos($repeat, '"')));
        $endOpen = strpos($repetition, '>');
        $content = substr($repetition, $endOpen + 1, strlen($repetition) - $endOpen - 1);

        for ($i = 0; $i < $repeat; $i++) {
            $this->content = str_replace($repetition, $content, $this->content);
        }
    }

    public function starIf($key, $value, $template)
    {
        $start = strpos($this->content, '<star:if');
        $end = strpos($this->content, '</star:if>') + 10;
        $condition = substr($this->content, $start, $end - $start);
        $condition = substr($condition, strpos($condition, 'condition="') + 11);
        $condition = substr($condition, 0, strpos($condition, '"'));
        $content = substr($condition, strpos($condition, 'content="') + 9);
        $content = substr($content, 0, strpos($content, '"'));
        $this->content = str_replace('{{' . $template . '}}', $content, $this->content);
    }
/*
    public function starFor($repetition, $template)
    {
        $content = '';
        foreach ($repetition as $key => $value) {
            $content .= $this->starForEach($value, $template);
        }
        $this->content = str_replace('{{' . $template . '}}', $content, $this->content);
    }

    public function starForEach($repetition, $template)
    {
        $content = '';
        foreach ($repetition as $key => $value) {
            $content .= $this->starIf($key, $value, $template);
        }
        return $content;
    }

*/
}