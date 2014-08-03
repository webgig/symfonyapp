<?php
namespace Webgig\FridgeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Collection;

class Fridge extends AbstractType
{
       /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('fridge_csv','textarea', array('required' => true))
            ->add('recipe_json','textarea',array('required' => true));


        $builder->add('save', 'submit', array(
                    'attr' => array('class' => 'btn btn-lg btn-success'),
                ));


    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $collectionConstraint = new Collection(array(
            'fridge_csv' => array(
                new NotBlank(array('message' => 'Fridge Items should not be blank.'))
            ),
            'recipe_json' => array(
                new NotBlank(array('message' => 'Recipe should not be blank.'))
            )
        ));

        $resolver->setDefaults(array(
            'constraints' => $collectionConstraint
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