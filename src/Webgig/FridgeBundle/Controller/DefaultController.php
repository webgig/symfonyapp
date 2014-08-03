<?php

namespace Webgig\FridgeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Webgig\FridgeBundle\Form\Fridge;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {


        $registration = new Fridge();

        $form = $this->createForm($registration,array(
            'action' => '',
        ));

        $form->handleRequest($request);

        $recommend_string = '';
        $error =    '';


        if ($form->isValid()) {
            // Store the input
            $fridge_csv   = $form->getData()['fridge_csv'];
            $recipe_json  = $form->getData()['recipe_json'];


            // Get the csv parse and parse the input to array
            $csv_parse_helper = $this->get('csv_parser');
            $csv = $csv_parse_helper->parse($fridge_csv);

            // Serialize the array to entity
            $array_to_item = $this->get('array_to_item');
            $items   = $array_to_item->serialize($csv,'Webgig\FridgeBundle\Entity\Item',true);


            // Serialize the array to entity
            $json_to_recipe = $this->get('json_to_recipe');
            $recipes   = $json_to_recipe->serialize($recipe_json);


            if($recipes && $items){
                // Get the recommendation service and perfrom recommendation
                $recom = $this->get('recommendations');
                $recommend_string = $recom->recommend($items,$recipes);
            } else {
                $error = "Sorry! An error occurred.";
            }


        }

        return $this->render(
            'WebgigFridgeBundle:Default:index.html.twig',
            array('form' => $form->createView(),'method'=>'POST','action'=>'','attr'=>'','multipart'=>'','recommendation'=>$recommend_string,'error'=>$error)
        );
    }
}
