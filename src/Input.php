<?php
namespace SimplePhpFormBuilder;


class Input extends Field {

    protected $tag;

    protected $label;

    protected $attributes = [];

    protected $openningTag;

    protected $closingTag;


    public function __construct( $type ) {
        $this->tag                  = 'input';
        $this->openningTag          = "<{$this->tag} ";
        $this->attributes['type']   = $type;
        $this->closingTag           = "";
    }

    public function build() {
        $this->checkRequirement(['label']);
        $this->validateAttrTolabel('name');
        $this->addStringAttributesToOpenningTag();
        echo "<label>{$this->label}</label>" . $this->openningTag . $this->closingTag;
    }
}