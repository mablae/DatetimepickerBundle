<?php

namespace Mablae\DatetimepickerBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Mablae\DatetimepickerBundle\DependencyInjection\Compiler\FormPass;

class MablaeDatetimepickerBundle extends Bundle
{
    
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new FormPass());
    }
}

