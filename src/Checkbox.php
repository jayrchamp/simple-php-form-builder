<?php
namespace SimplePhpFormBuilder;


class Checkbox extends Field {

    protected $tag;

    protected $attributes;

    protected $openningTag;

    protected $closingTag;


    public function __construct( $type ) {
        $this->tag                  = 'input';
        $this->openningTag          = "<{$this->tag} ";
        $this->attributes['type']   = $type;
        $this->closingTag           = "";
    }

    public function addChoice() {

    }

    public function build() {
        $this->validateAttrTolabel('id');
        $this->validateAttrTolabel('name');
        $this->validateAttrTolabel('value');

        $this->addStringAttributesToOpenningTag();
        // return $this;
        echo $this->openningTag . $this->closingTag . "<label for='{$this->attributes['id']}'>" . $this->label . "</label>";
    }



    

}



















