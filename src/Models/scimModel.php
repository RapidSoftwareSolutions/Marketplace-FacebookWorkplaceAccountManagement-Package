<?php
namespace Models;

class ScimModel{
    public $schemas = ["urn:scim:schemas:core:1.0"];
    public $username;
    public $name;
    public $active;
    public $email;
    public $title;
    public $nickName;


    function __construct($username, $name, $active=true, $email=false, $title=false, $nickName=false)
    {
        $this->username=$username;
        $this->name=$name;
        $this->active=$active;
        $this->email=$email;
        $this->title=$title;
        $this->nickName=$nickName;
    }

    public function genSchema()
    {
        $schemaArr = [
            "schemas" => $this->schemas,
            "userName" => $this->username,
            "name" => array("formatted"=>$this->name),
            "active" => $this->active
        ];

        if($this->email)
        {
            $schemaArr['emails'] = [array("primary"=>true, "type"=>"work", "value"=>$this->email)];
        }

        if($this->title)
        {
            $schemaArr['title'] = $this->title;
        }

        if($this->nickName)
        {
            $schemaArr['nickName'] = $this->nickName;
        }

        return $schemaArr;
    }

}