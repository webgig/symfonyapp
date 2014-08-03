<?php
namespace Webgig\FridgeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class Fridge extends AbstractType
{
       /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('fridge_csv','textarea')
            ->add('recipe_json','textarea');


        $builder->add('save', 'submit', array(
                    'attr' => array('class' => 'btn btn-lg btn-success'),
                ));


    }



    /**
     * @return string
     */
    public function getName()
    {
        return 'fridge_form';
    }

}