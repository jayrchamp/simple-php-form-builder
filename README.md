## Installation

```bash
composer require jayrchamp/simple-php-form-builder
```

## Basic Usage

* [Getting Started](#getting-started)
    * [#1 Instantiate the class](#instantiate-the-class)
    * [#2 Add the required methods to the form object](#pass-the-required-attributes-to-the-form-object)
    * [#3 Add form fields](#add-form-fields)
    * [#4 Add a submit field](#add-a-submit-field)
    * [#5 Close the form](#close-the-form)
* [More examples](#more-examples)


## Getting Started

### 1) Instantiate the class 


```php
$form = new SimplePhpFormBuilder\Form();
```


### 2) Add the required methods (attribute) to the form object and open the form for fields

```php
$form->action('/page/submit.php')->open();
```

#### Methods ( attributes )

* `action`
    * The action to be performed when the form is submitted.
    *  _(string) (Required)_ 

* `method`
    * Accepts `GET`, `POST`.
    *  _(string) (Optional) (Default `POST`)_ 

* `enctype`
    * Accepts `multipart/form-data`, `application/x-www-form-urlencoded`.
    *  _(string) (Optional) (Default `multipart/form-data`)_ 

* `id` 
    * Form's id attribute.
    * _(string) (Optional)_ 

* `class` 
    * Form's classes as an array or string.
    * _(array | string ) (Optional)_

* `attr` 
    * A key-value pair array of custom attributes with their associated value.
    * Or a string of a single attribute
    * _(array | string) (Optional) (Default `[]`)_

#### Action methods

* `open` 
    * Creates the form and gets it ready to receive field inputs.
    * Needs to be the last method added on the form object.
    * _(void) (Required)_

#### Complete example ( form's instantiation  )

```php
$form->id('form_id')
     ->action('/page/submit.php')
     ->method('POST')
     ->class('form_class1')->class(['form_class2', 'form_class3'])
     ->attr(['data-form' => 'form-data'])
     ->enctype('multipart/form-data')
     ->open();

```


### 3) Add form fields

```php
$form->field( string $type )->label( string $label )->build();
```


#### Methods ( attributes )

* `field` 
    * Field's type.
    * _(string) (Required)_

* `label` 
    * Field's label 
    * _(string) (Required)_

* `name`  
    * Field's name attribute. 
    * If not set, label will be slugified and added as field name attribute.
    * If you set it, it will automatically be slugified for you. Not need to add underscore, etc.
    * It will keep the square brackets, if you need an array.
    * _(string) (Optional) (Default `Slugified label`)_

* `value`
    * Field's value attribute
    *  _(string) (Optional) (Default `''`)_

* `id` 
    * Form's id attribute.
    * _(string) (Optional)_ 

* `class` 
    * Form's classes as an array or string.
    * _(array | string ) (Optional)_

* `placeholder` 
    * Field's placeholder
    * _(string) (Optional) (Default `''`)_

* `attr` 
    * A key-value pair array of custom attributes with their associated value.
    * Or a string of a single attribute
    * _(array) (Optional) (Default `[]`)_


#### Action methods

* `build` 
    * Creates the field.
    * Needs to be the last method added on the field object.
    * _(void) (Required)_



#### Complete example ( Creation of a form field )

```php
$form->field( 'text' )
     ->label('What is your name?')
     ->name('name')
     ->placeholder('ie.: John Doe')
     ->id('text_id')
     ->class('text_class1')->class(['text_class2', 'text_class3'])
     ->attr(['data-text' => 'text-data'])
     ->attr('required')
     ->build();
```




### 4) Add a submit field

```php
$form->field('submit')->value('Send')->build();
```

#### Methods ( attributes )

* `field` 
    * Field's type.
    * _(string) (Required)_

* `label` 
    * Field's label 
    * _(string) (Optional) (work but useless)_

* `value`
    * Field's value attribute
    *  _(string) (Optional) (Default `''`)_

* `id` 
    * Form's id attribute.
    * _(string) (Optional)_ 

* `class` 
    * Form's classes as an array or string.
    * _(array | string ) (Optional)_

* `attr` 
    * Either a key-value pair array of custom attributes with their associated value.
    * or a string for a single attribute without value
    * _(array) (Optional) (Default `[]`)_


#### Action methods

* `build` 
    * Creates the field.
    * Needs to be the last method added on the field object.
    * _(void) (Required)_




### 5) Close the form

```php
$form->close();
```


---


## More examples


### `select` form field

```php
$form->field('select')
     ->label('Where do you want to go?')
     ->placeholder('Select')
     ->addOption('To the beach')
     ->addOption('Las vegas')
     ->addOption('Planet Mars')
     ->build();
```


### `checkbox` form field

```php
$form->field('checkbox')->label('Banana')->name('Favorite Fruits[]')->build();
$form->field('checkbox')->label('Apple')->name('Favorite Fruits[]')->build();
$form->field('checkbox')->label('Kiwi')->name('Favorite Fruits[]')->build();
```


### `radio` form field

```php
$form->field('radio')->label('Canada')->name('Favorite_country')->build();
$form->field('radio')->label('USA')->name('Favorite_country')->build();
$form->field('radio')->label('China')->name('Favorite_country')->build();
```


### `hidden` form field

```php
$form->field('hidden')->name('my hidden field')->value('done')->build();
```

#### Methods ( attributes )

* `field` 
    * Field's type.
    * _(string) (Required)_

* `name` 
    * Field's name. **Is Required since no label will be slugified**.
    * _(string) (Optional)_

* `value`
    * Field's value. **Not required but would be brian to add it**.
    *  _(string) (Optional) (Default `''`)_

* `id` 
    * Form's id attribute.
    * _(string) (Optional)_ 

* `class` 
    * Form's classes as an array or string.
    * _(array | string ) (Optional)_

* `attr` 
    * Either a key-value pair array of custom attributes with their associated value.
    * or a string for a single attribute without value
    * _(array) (Optional) (Default `[]`)_

* `label` 
    * Field's label. **Work but useless**.
    * _(string) (Optional)_


#### Action methods

* `build` 
    * Creates the field.
    * Needs to be the last method added on the field object.
    * _(void) (Required)_





