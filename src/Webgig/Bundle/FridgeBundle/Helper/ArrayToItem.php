<?php

namespace Webgig\FridgeBundle\Helper;



class ArrayToItem
{
    public function serialize($data,$entity,$discard_id=false)
    {
        // Exit early if no data is passed
        if(!$data) return false;


        if(is_array($data)){
        //    $entityCollection[] = array();


            // Using Reflection
            $object     = new \ReflectionObject(new $entity);
            // get the properties of the entity class
            $properties = $object->getProperties();


            // create a list of setters
            foreach ($properties as $key => $value) {

                if (strpos($value->name,'_') !== false) {
                   $m =  $this->to_camel_case($value->name,true);
                } else {
                   $m =  ucfirst($value->name);
                }

                $method[]= 'set'.$m;
            }


            if($discard_id)
                array_shift($method);


            foreach ($data as  $key => $value ){
                $entity = new $entity;
                foreach ($method as  $k => $prop) {
                    call_user_method($prop,$entity,$value[$k]);
                }
                $entityCollection[] = $entity;
            }

            return $entityCollection;
        }
    }

    function to_camel_case($str, $capitalise_first_char = false) {

      if($capitalise_first_char) {
        $str[0] = strtoupper($str[0]);
      }

      $func = create_function('$c', 'return strtoupper($c[1]);');
      return preg_replace_callback('/_([a-z])/', $func, $str);
    }
}
