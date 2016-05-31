<?php

namespace MicroStore\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelleTel', 'text')
            ->add('idFabricantTel', 'number')
            ->add('OS','text')
            ->add('prixUnitaire','number')
            ->add('stock','number')
            ->add('imageTel','text');
    }

    public function getName()
    {
        return 'article';
    }
}