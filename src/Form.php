<?php
namespace SimplePhpFormBuilder;
use SimplePhpFormBuilder\Field;
use SimplePhpFormBuilder\Checkbox;
use SimplePhpFormBuilder\Radio;
use SimplePhpFormBuilder\ExceptionField;
use SimplePhpFormBuilder\Input;
use SimplePhpFormBuilder\Select;


class Form extends Field {

    protected $tag;

    protected $attributes;

    protected $openningTag;

    protected $closingTag;
    

    public function __construct() {

        $this->tag = 'form';
        $this->attributes['method'] = 'POST';
        $this->attributes['enctype'] = 'multipart/form-data';

        $this->openningTag = "<{$this->tag} ";
        $this->closingTag = "</{$this->tag}>";
        return $this;
    }


    public function open() {
        $to_string_attr = $this->getStringAttributes( $this->attributes );
        $this->openningTag .= "{$to_string_attr}>";
        echo $this->openningTag;
    }


    public function close() {
        echo  $this->closingTag;
    }


    public function action( $action ) {
        $this->attributes['action'] = $action;
        return $this;
    }


    public function method( $method ) {

        switch ( $method ) {
            case 'GET':
            case 'get':
            case 'POST':
            case 'post':
                $this->attributes['method'] = $method;
                break;
            default:
                throw new \Exception("Attribute `method` of the form only accepts `GET` or `POST`", 1);
                break;
        }

        return $this;
    }


    public function enctype( $enctype ) {

        switch ( $enctype ) {
            case 'multipart/form-data':
            case 'application/x-www-form-urlencoded':
                $this->attributes['enctype'] = $enctype;
                break;
            default:
                throw new \Exception("Attribute `enctype` of the form only accepts `application/x-www-form-urlencoded` or `multipart/form-data`", 1);
                break;
        }
        return $this;
    }



    public function field( $field_type ) {
        switch ( $field_type ) {
            case 'checkbox':
                $field = new Checkbox( $field_type );
                break;

            case 'radio':
                $field = new Radio( $field_type );
                break;

            case 'select':
                $field = new Select( $field_type );
                break;

            case 'hidden':
            case 'submit':
                $field = new ExceptionField( $field_type );
                break;
            
            default:
                $field = new Input( $field_type );
                break;
        }

        return $field;
    }
}








