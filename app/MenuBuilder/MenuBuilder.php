<?php
/*
*   07.11.2019
*   MenuBuilder
*/

namespace App\MenuBuilder;

class MenuBuilder{

    private $menu;
    private $dropdown;
    private $dropdownDeep;

    public function __construct(){
       $this->menu = array();
       $this->dropdown = false;
       $this->dropdownDeep = 0;
    }

    private function innerAddElementToMenuLastPosition(&$menu, $element, $offset){
        $z = 1;
        $result = false;
        $menu = &$menu[count($menu)-1];
        while(is_array($menu)){
            if($z == $this->dropdownDeep - $offset){
                array_push($menu['elements'], $element);
                $result = true;
                break;
            }
            $menu = &$menu['elements'][count($menu['elements'])-1];
            $z++;
        }
        return $result;
    }

    private function addElementToMenuLastPosition($element, $offset = 0){
        return $this->innerAddElementToMenuLastPosition($this->menu, $element, $offset);
    }

    private function addRegularLink($id, $name, $href, $icon, $iconType, $sequence = 0,$function_href = null){
        $hasIcon = ( $icon === false || strlen($icon) === 0 ) ? false : true;
        if($hasIcon){
            array_push($this->menu, array(
                'id' => $id,
                'slug' => 'link',
                'name' => $name,
                'href' => $href,
                'hasIcon' => $hasIcon,
                'icon' => $icon,
                'iconType' => $iconType,
                'sequence' => $sequence,
                'function_href' => $function_href
            ));
        }else{
            array_push($this->menu, array(
                'id' => $id,
                'slug' => 'link',
                'name' => $name,
                'href' => $href,
                'hasIcon' => $hasIcon,
                'sequence' => $sequence,
                'function_href' => $function_href
            ));
        }
    }

    private function addDropdownLink($id, $name, $href, $icon, $iconType, $sequence = 0,$function_href = null){
        $num = count($this->menu);
        $hasIcon = ( $icon === false || strlen($icon) === 0 ) ? false : true;
        if($hasIcon){
            $this->addElementToMenuLastPosition(array(
                'id' => $id,
                'slug' => 'link',
                'name' => $name,
                'href' => $href,
                'hasIcon' => $hasIcon,
                'icon' => $icon,
                'iconType' => $iconType,
                'sequence' => $sequence,
                'function_href' => $function_href,
            ));
         }else{
            $this->addElementToMenuLastPosition(array(
                'id' => $id,
                'slug' => 'link',
                'name' => $name,
                'href' => $href,
                'hasIcon' => $hasIcon,
                'sequence' => $sequence,
                'function_href' => $function_href,
            ));
        }
    }

    public function addLink($id, $name, $href, $icon = false, $iconType = 'coreui', $sequence = 0,$function_href = null){
        if($this->dropdown === true){
            $this->addDropdownLink($id, $name, $href, $icon, $iconType, $sequence,$function_href);
        }else{
            $this->addRegularLink($id, $name, $href, $icon, $iconType, $sequence,$function_href);
        }
    }

    public function addTitle($id, $name, $icon = false, $iconType = 'coreui', $sequence = 0){
        $hasIcon = ( $icon === false || strlen($icon) === 0 ) ? false : true;
        if($hasIcon){
            array_push($this->menu, array(
                'id' => $id,
                'slug' => 'title',
                'name' => $name,
                'hasIcon' => $hasIcon,
                'icon' => $icon,
                'iconType' => $iconType,
                'sequence' => $sequence,
            ));
        }else{
            array_push($this->menu, array(
                'id' => $id,
                'slug' => 'title',
                'name' => $name,
                'hasIcon' => $hasIcon,
                'sequence' => $sequence,
            ));
        }
    }

    public function beginDropdown($id, $name, $icon = false, $iconType = 'coreui', $sequence = 0, $function_href = null){
        $this->dropdown = true;
        $this->dropdownDeep++;
        $hasIcon = ( $icon === false || strlen($icon) === 0 ) ? false : true;
        if($this->dropdownDeep === 1){
            if($hasIcon){
                array_push($this->menu, array(
                    'id' => $id,
                    'slug' => 'dropdown',
                    'name' => $name,
                    'hasIcon' => $hasIcon,
                    'icon' => $icon,
                    'iconType' => $iconType,
                    'elements' => array(),
                    'sequence' => $sequence,
                    'function_href' => $function_href
                ));
            }else{
                array_push($this->menu, array(
                    'id' => $id,
                    'slug' => 'dropdown',
                    'name' => $name,
                    'hasIcon' => $hasIcon,
                    'elements' => array(),
                    'sequence' => $sequence,
                    'function_href' => $function_href
                ));
            }
        }else{
            if($hasIcon){
                $this->addElementToMenuLastPosition(array(
                    'id' => $id,
                    'slug' => 'dropdown',
                    'name' => $name,
                    'hasIcon' => $hasIcon,
                    'icon' => $icon,
                    'iconType' => $iconType,
                    'elements' => array(),
                    'sequence' => $sequence,
                    'function_href' => $function_href
                ), 1);
            }else{
                $this->addElementToMenuLastPosition(array(
                    'id' => $id,
                    'slug' => 'dropdown',
                    'name' => $name,
                    'hasIcon' => $hasIcon,
                    'elements' => array(),
                    'sequence' => $sequence,
                    'function_href' => $function_href
                ), 1);
            }
        }

    }

    public function endDropdown(){
        $this->dropdownDeep--;
        if($this->dropdownDeep < 0){
            $this->dropdownDeep = 0;
        }
        if($this->dropdownDeep <= 0){
            $this->dropdown = false;
        }
    }

    public function getResult(){
        return $this->menu;
    }




}
