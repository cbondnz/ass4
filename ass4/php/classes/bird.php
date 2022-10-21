<?php
class Bird {
    // Properties
    private $english_name;
    private $maori_name;
    private $scientific_name;
    private $conservation_status;
    private $classification;
    private $other_names;
    private $length;
    private $weight;
    private $lower_length;
    private $length_unit;
    private $lower_weight;
    private $weight_unit;
    private $upper_length;
    private $upper_weight;
    private $bird_id;
    private $information;
    private $identification;
    private $image;
    private $image_220;
    private $alt;
    private $source;

    // Constructor
    function __construct(
        $english_name, 
        $maori_name, 
        $scientific_name, 
        $conservation_status, 
        $classification, 
        $other_names, 
        $length, 
        $weight, 
        $lower_length,
        $length_unit,
        $lower_weight,
        $weight_unit,
        $upper_length,
        $upper_weight,        
        $bird_id, 
        $information, 
        $identification,
        $image,
        $image_220, 
        $alt, 
        $source
        ){
        $this->english_name=$english_name;
        $this->maori_name=$maori_name;
        $this->scientific_name=$scientific_name;
        $this->conservation_status=$conservation_status;
        $this->classification=$classification;
        $this->other_names=$other_names;
        $this->length=$length;
        $this->weight=$weight;
        $this->lower_length=$lower_length;
        $this->length_unit=$length_unit;
        $this->lower_weight=$lower_weight;
        $this->weight_unit=$weight_unit;
        $this->upper_length=$upper_length;
        $this->upper_weight=$upper_weight; 
        $this->bird_id=$bird_id;
        $this->information=$information;
        $this->identification=$identification;
        $this->image=$image;
        $this->image_220=$image_220;
        $this->alt=$alt;
        $this->source=$source;
    }

    // Getters and setters
    function get_english_name(){
        $result = $this->english_name;
        return $result;
    }
    function get_maori_name(){
        $result = $this->maori_name;
        return $result;
    }
    function get_scientific_name(){
        $result = $this->scientific_name;
        return $result;
    }
    function get_src(){
        $result = $this->source;
        return $result;
    }
    function get_alt(){
        $result = $this->alt;
        return $result;
    }
    function get_bird_id(){
        $result = $this->bird_id;
        return $result;
    }
    function get_conservation_status(){
        $result = $this->conservation_status;
        return $result;
    }
    function get_information(){
        $result = $this->information;
        return $result;
    }
    function get_weight(){
        $result = $this->weight;
        return $result;
    }
    function get_length(){
        $result = $this->length;
        return $result;
    }
    function get_lower_length(){
        $result = $this->lower_length;
        return $result;
    }
    function get_lower_weight(){
        $result = $this->lower_weight;
        return $result;
    }  
    function get_classification(){
        $result = $this->classification;
        return $result;
    }
    function get_image_220(){
        $result = $this->image_220;
        return $result;
    }

}


?>