<?php
namespace SimplePhpFormBuilder;


class Select extends Field {

    protected $tag;

    protected $attributes;

    protected $openningTag;

    protected $closingTag;

    protected $options;


    public function __construct( $type ) {
        $this->tag                  = $type;
        $this->openningTag          = "<{$this->tag} ";
        $this->closingTag           = "</{$this->tag}>";
    }


    public function addOption( $option ) {
        $this->options[] = "<option value='{$option}'>$option</option>";
        return $this;
    }


    public function build() {
        $this->validateAttrTolabel('id');
        $this->validateAttrTolabel('name');

        unset( $this->attributes['type'] );

        $this->addStringAttributesToOpenningTag();

        $label = $this->label ? "<label>{$this->label}</label>" : '';

        $before_option =  $label . $this->openningTag;

        $inside = '';
        
        if ( $this->attributes['placeholder'] ) {
            $default_option      = $this->placeholderToDefaultOption();
            $default_option_slug = $this->_convertToSlug( $default_option  );
        
            $inside = "<option value='{$default_option_slug}'>{$default_option}</option>";
        }

        if ( ! empty( $this->options ) ) {
            foreach ( $this->options as $option ) {
                $inside .= $option;
            }
        }

        $after_option = $this->closingTag;

        echo $before_option . $inside . $after_option;
    }


    public function placeholderToDefaultOption() {
        if ( isset( $this->attributes['placeholder'] ) ) {
            $default_option = $this->attributes['placeholder'];
            unset( $this->attributes['placeholder'] );
            return $default_option;            
        } else {
            return false;
        }

    }

    

}



















