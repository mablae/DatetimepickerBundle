#DatetimepickerBundle

This bundle implements the [Bootstrap DateTime Picker](http://eonasdan.github.io/bootstrap-datetimepicker/Installing/#bower-) in a Form Type for Symfony 2.*. The bundle structure is inspired by GenemuFormBundle.

Demo : http://www.malot.fr/bootstrap-datetimepicker/demo.php

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
        new Mablae\DatetimepickerBundle\SCDatetimepickerBundle(),
    );
}
```

``` yml
# app/config/config.yml
mablae_datetimepicker:
    picker: ~
```

### Step 3: Initialize assets

``` bash
$ php app/console assets:install web/
```

## Usages

``` php
<?php
// ...
public function buildForm(FormBuilder $builder, array $options)
{
    $builder
        // defaut options
        ->add('createdAt', 'collot_datetime') 
        
        // full options
        ->add('updatedAt', 'collot_datetime', array( 'pickerOptions' =>
            array('format' => 'mm/dd/yyyy',
                'weekStart' => 0,
                'startDate' => date('m/d/Y'), //example
                'endDate' => '01/01/3000', //example
                'daysOfWeekDisabled' => '0,6', //example
                'autoclose' => false,
                'startView' => 'month',
                'minView' => 'hour',
                'maxView' => 'decade',
                'todayBtn' => false,
                'todayHighlight' => false,
                'keyboardNavigation' => true,
                'language' => 'en',
                'forceParse' => true,
                'minuteStep' => 5,
                'pickerReferer ' => 'default', //deprecated
                'pickerPosition' => 'bottom-right',
                'viewSelect' => 'hour',
                'showMeridian' => false,
                'initialDate' => date('m/d/Y', 1577836800), //example
                ))) ; 

}
```
