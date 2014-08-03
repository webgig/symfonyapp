<?php

namespace Webgig\Bundle\FridgeBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Webgig\FridgeBundle\Form\Fridge;
use Symfony\Component\Form\Test\TypeTestCase;

class DefaultControllerTest extends TypeTestCase
{
    public function testIndex()
    {

        $formData = array(
            'fridge_csv' => 'bread,10,slices,25/12/2014
            cheese,10,slices,25/12/2014
            butter,250,grams,25/12/2014
            peanut butter,250,grams,2/12/2014
            mixed salad,150,grams,26/12/2013',
                        'recipe_json' => '
            [
                {
                    "name": "grilled cheese on toast",
                    "ingredients": [
                        { "item":"bread", "amount":"2", "unit":"slices"},
                        { "item":"cheese", "amount":"2", "unit":"slices"}
                    ]
                }
                ,
                {
                    "name": "salad sandwich",
                    "ingredients": [
                        { "item":"bread", "amount":"2", "unit":"slices"},
                        { "item":"mixed salad", "amount":"100", "unit":"grams"}
                    ]
                }
            ]',
        );

        $fridge = new Fridge();
        $form = $this->factory->create($fridge);

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isValid());
    }

    public function testValidDataSubmission()
    {
           $formData = array(
            'fridge_csv' => 'bread,10,slices,25/12/2014
            cheese,10,slices,25/12/2014
            butter,250,grams,25/12/2014
            peanut butter,250,grams,2/12/2014
            mixed salad,150,grams,26/12/2013',
                        'recipe_json' => '
            [
                {
                    "name": "grilled cheese on toast",
                    "ingredients": [
                        { "item":"bread", "amount":"2", "unit":"slices"},
                        { "item":"cheese", "amount":"2", "unit":"slices"}
                    ]
                }
                ,
                {
                    "name": "salad sandwich",
                    "ingredients": [
                        { "item":"bread", "amount":"2", "unit":"slices"},
                        { "item":"mixed salad", "amount":"100", "unit":"grams"}
                    ]
                }
            ]',
        );


        $type = new Fridge();
        $form = $this->factory->create($type);


        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
