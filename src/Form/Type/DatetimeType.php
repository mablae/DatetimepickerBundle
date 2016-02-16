<?php

namespace Mablae\DatetimepickerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType as BaseDateType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * DatetimeType
 *
 */
class DatetimeType extends AbstractType
{
    /**
     *
     * @var array
     */
    private $options;

    /**
     *
     * @var array
     */
    private static $momentFormatter = array("YY", "YYYY", "MM", "D", "DD", 'MMMM' );

    /**
     *
     * @var array
     */
    private static $intlFormater    = array("yy", "yyyy",  "MM", "d", "dd", 'MMMM' );

    /**
     * Constructs
     *
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->options = $options;

    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $pickerOptions = array_merge($this->options, $options['pickerOptions']);

        //Set automatically the language
        if(!isset($pickerOptions['locale']))
            $pickerOptions['locale'] = \Locale::getDefault();
        if($pickerOptions['locale'] == 'en')
            unset($pickerOptions['language']);

        if(!isset($pickerOptions['format']))
            $pickerOptions['format'] = 'DD.MM.YYYY';

        $view->vars = array_replace($view->vars, array(
            'pickerOptions' => $pickerOptions,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $configs = $this->options;

        $resolver
            ->setDefaults(array(
                'widget' => 'single_text',
                'format' => function (Options $options, $value) use ($configs) {
                    $pickerOptions = array_merge($configs, $options['pickerOptions']);

                    if (isset($pickerOptions['format'])){
                        return DatetimeType::convertMalotToIntlFormater( $pickerOptions['format'] );
                    } else {
                        return DatetimeType::convertMalotToIntlFormater( 'DD.MM.YYYY' );
                    }

                },
                'pickerOptions' => array(),
            ));
    }

    /**
     * Convert the PHP date format to Bootstrap Datetimepicker date format
     */
    public static function convertIntlFormaterToMalot($formatter)
    {
        $intlToMalot = array_combine(self::$intlFormater, self::$momentFormatter);

        $patterns = preg_split('([\\\/.:_;,\s-\ ]{1})', $formatter);
        $exits = array();

        foreach ($patterns as $val) {
            if (isset($intlToMalot[$val])){
                $exits[$val] = $intlToMalot[$val];
            } else {
                // it can throw an Exception
                $exits[$val] = $val;
            }
        }

        return str_replace(array_keys($exits), array_values($exits), $formatter);
    }

    /**
     * Convert the Bootstrap Datetimepicker date format to PHP date format
     */
    public static function convertMalotToIntlFormater($formatter)
    {
        $malotToIntl = array_combine(self::$momentFormatter, self::$intlFormater);

        $patterns = preg_split('([\\\/.:_;,\s-\ ]{1})', $formatter);
        $exits = array();

        foreach ($patterns as $val) {
            if (isset($malotToIntl[$val])){
                $exits[$val] = $malotToIntl[$val];
            } else {
                // it can throw an Exception
                $exits[$val] = $val;
            }
        }

        return str_replace(array_keys($exits), array_values($exits), $formatter);
    }

    /**
     *
     * @see \Symfony\Component\Form\AbstractType::getParent()
     */
    public function getParent()
    {
        return 'datetime';
    }

    /**
     *
     * @see \Symfony\Component\Form\FormTypeInterface::getName()
     */
    public function getName()
    {
        return 'mablae_datetime';
    }
}
