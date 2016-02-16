#DatetimepickerBundle

This bundle implements the [Bootstrap DateTime Picker v4](http://eonasdan.github.io/bootstrap-datetimepicker/Installing/#bower-) in a Form Type for Symfony 2.*. The bundle structure is inspired by GenemuFormBundle.

Please feel free to contribute, to fork, to send merge request and to create ticket.

##Installation

### Step 1: Install DatetimepickerBundle

```bash
php composer.phar require mablae/datetimepicker-bundle
```

### Step 2: Enable the bundle

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Mablae\DatetimepickerBundle\MablaeDatetimepickerBundle(),
    );
}
```

``` yml
# app/config/config.yml
mablae_datetimepicker:
    picker: ~
```

### Step 3: Install moment.js and Bootstrap3 Datepicker

This bundle does not handle an asset minification or loading. Just use gulp or webpack. 

```
http://eonasdan.github.io/bootstrap-datetimepicker/Installing/
```

## Usages

``` php
<?php
// ...
public function buildForm(FormBuilder $builder, array $options)
{
    $builder
        // defaut options
        ->add('createdAt', 'mablae_datetime') 
        
        // full options
        ->add('updatedAt', 'mablae_datetime', array( 'pickerOptions' =>
            array('format' => 'mm/dd/yyyy',
                'viewMode' => 'days', // days, month, years, decades
                                     
                ))); 
                
}
```


Include the javascript needed to initialize the widget: 

``` jinja2

...
{{ form_javascript(your.form.field) }}
...

```
