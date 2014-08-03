<?php

namespace Webgig\FridgeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Webgig\FridgeBundle\Form\Fridge;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {


        $registration = new Fridge();

        $form = $this->createForm($registration);

        $form->handleRequest($request);


        if ($form->isValid()) {
            $fridge_csv   = $form->getData()['fridge_csv'];
            $recipe_json = $form->getData()['recipe_json'];


            $encoders = array(new JsonEncoder());
            $normalizers = array(new GetSetMethodNormalizer());

            $serializer = new Serializer($normalizers, $encoders);

            $csv_parse_helper = $this->get('csv_parser');
            $csv = $csv_parse_helper->parse($fridge_csv);


            $array_to_item = $this->get('array_to_item');

            $items   = $array_to_item->serialize($csv,'Webgig\FridgeBundle\Entity\Item',true);


            $recipe_json_array = json_decode($recipe_json);

            foreach ($recipe_json_array as $key => $value) {
                $recipe = $serializer->deserialize(json_encode($value),'Webgig\FridgeBundle\Entity\Recipe', 'json');
                $ingredients = null;
                foreach ($recipe->getIngredients() as $ing) {
                    $ingredients[] = $serializer->deserialize(json_encode($ing),'Webgig\FridgeBundle\Entity\Ingredient', 'json');
                }

                $recipe->setIngredients($ingredients);
                $recipes[] = $recipe;
            }

            // perform some action...
            $recom = $this->get('recommendations');
            $recommend_string = $recom->recommend($items,$recipes);

            echo $recommend_string;

            exit;
           // return $this->redirect($this->generateUrl('task_success'));
        }

        return $this->render(
            'WebgigFridgeBundle:Default:index.html.twig',
            array('form' => $form->createView(),'method'=>'POST','action'=>'','attr'=>'','multipart'=>'')
        );    }
}
