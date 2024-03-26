<?php

function findElementByText($parent, $text){
    foreach($parent->find('*') as $element){
        if($element->plaintext == $text) return $element;
    }
}

function getElementText( $element ){
    $text = '';
    if( $element->hasChildNodes() ){
        foreach($element->children() as $child){
            $text .= getElementText($child) . "\\n";
        }
    }
    else $text = $element->plaintext;
    return rtrim($text, "\\n");
}



?>