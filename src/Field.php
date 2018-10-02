<?php
namespace SimplePhpFormBuilder;


class Field {

    protected $tag;

    protected $label;

    protected $attributes = [];

    protected $openningTag;

    protected $closingTag;


    public function build() {
        $this->addStringAttributesToOpenningTag();
        echo $this->label . $this->openningTag . $this->closingTag;
    }


    public function id( $id ) {
        $this->attributes['id'] = $id;
        return $this;
    }


    public function name( $name ) {
        $this->attributes['name'] = $this->_convertToSlug( $name, true );
        return $this;
    }


    public function value( $value ) {
        $this->attributes['value'] = $value;
        return $this;
    }


    public function placeholder( $placeholder ) {
        $this->attributes['placeholder'] = $placeholder;
        return $this;
    }


    public function class( $class ) {
        
        if ( empty( $this->attributes['class'] ) ) {
            $this->attributes['class'] = [];    
        } else {
            $this->attributes['class'];
        }

        if ( is_array( $class ) ) {
            foreach ( $class as $value ) {
                array_push( $this->attributes['class'] , $value);
            }
        } elseif ( is_string( $class ) ) {
            $classes = explode( ' ' ,  $class );
            foreach ( $classes as $class ) {
                array_push( $this->attributes['class'] , $class);
            }
        }
        return $this;
    }


    public function attr( $custom_attributes ) {

        if ( ! is_array( $custom_attributes ) ) {
            $this->attributes[$custom_attributes] = '';
        } else {
            foreach ($custom_attributes as $attr => $value) {
                    $this->attributes[ $attr ] = $value;
            }
        }
        return $this;
    }


    public function label( $label ) {
        $this->label = $label;
        return $this;
    }



    /*======================================
    =            Helper methods            =
    ======================================*/


    protected function addStringAttributesToOpenningTag() {
        $to_string_attr = $this->getStringAttributes( $this->attributes );
        $this->openningTag .= "{$to_string_attr}>";
    }


    protected function getStringAttributes( $array_of_attributes ) {
        $attributes = '';
        foreach ( $array_of_attributes as $attr => $value ) {
            if ( is_array( $array_of_attributes[ $attr ] ) ) {
                $attributes .= " {$attr}=' ";
                foreach ( $array_of_attributes[ $attr ] as $value ) {
                    $attributes .= "{$value} ";
                }
                $attributes .= "'";
            } else {
                $attributes .= " {$attr}='{$value}' ";    
            }
        }
        return $attributes;
    }


    protected function validateAttrTolabel( $attr ){
        if ( ! isset( $this->attributes[ $attr ] ) ) {
            $this->attributes[ $attr ] = $this->_convertToSlug( $this->label );
        }
    }


    protected function checkRequiredAttributes( $requiredAttr ) {
        foreach ( $requiredAttr as $attr ) {
            if ( ! isset( $this->attributes[ $attr ] ) ) {
                throw new \Exception( ucfirst( $attr ) . " is required for the field {$this->attributes['type']}", 1);
            }
        }
    }


    protected function checkRequirement( $required ) {
        foreach ( $required as $req ) {
            if ( ! isset( $this->{$req} ) ) {
                throw new \Exception( ucfirst( $req ) . " is required for the field {$this->attributes['type']}", 1);
            }
        }
    }


    protected function _convertToSlug( $string, $keepSquareBrackets = false ) {

        // $removeChar = "/[()\[\]]|.[']/i";
        
        if ( ! $keepSquareBrackets ) {
            $removeChar = "/[\[\]]/i";
            $string = preg_replace( $removeChar, '', $string );            
        }

        $removeChar = "/[()]|\s\S?[']|[']|,|\./i";
        $string = preg_replace( $removeChar, '', $string );

        $string = str_replace( '"', '', $string );

        $replaceSpace = "/\s+/i";
        $string = preg_replace( $replaceSpace, '_', $string );
        
        return $string;
    }

    /*=====  End of Helper methods  ======*/

}