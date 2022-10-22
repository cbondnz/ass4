<?php

/**
 * Bird Class
 * This class holds all the information for a bird
 */
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
    private $alt;
    private $source;
    private $breeding;
    private $egg_laying;

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
        $alt, 
        $source,
        $breeding,
        $egg_laying
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
        $this->alt=$alt;
        $this->source=$source;
        $this->breeding=$breeding;
        $this->egg_laying=$egg_laying;
    }

    // Getters and setters
    function get_english_name(){
        return $this->english_name;
    }
    function get_maori_name(){
        return $this->maori_name;
    }
    function get_scientific_name(){
        return $this->scientific_name;
    }
    function get_src(){
        return $this->source;
    }
    function get_alt(){
        return $this->alt;
    }
    function get_bird_id(){
        return $this->bird_id;
    }
    function get_conservation_status(){
        return $this->conservation_status;
    }
    function get_information(){
        return $this->information;
    }
    function get_identification(){
        $array = "";
        foreach ($this->identification as $paragraph) {
            $array .= "<p>$paragraph</p>";
        }
        return $array;
    }
    function get_weight(){
        return $this->weight;
    }
    function get_length(){
        return $this->length;
    }
    function get_lower_length(){
        return $this->lower_length;
    }
    function get_lower_weight(){
        return $this->lower_weight;
    }  
    function get_classification(){
        return $this->classification;
    }
    function get_image(){
        return $this->image;
    }
    function get_maori_name_box(){
        return $this->maori_name !="" ? "<li><span>Māori Name: </span> $this->maori_name</li>" : "";
    }
    function get_scientific_name_box(){
        return "<li><span>Scientific Name: </span>$this->scientific_name</li>";
    }
    function get_weight_box(){
        return "<li><span>Weight: </span>$this->weight</li>";
    }
    function get_length_box(){
        return "<li><span>Length: </span>$this->length</li>";
    }
    function get_classification_box(){
        return "<li><span>Classification: </span>$this->classification</li>";
    }
    function get_other_names_box(){
        return "<li><span>Other Names: </span>$this->other_names</li>";
    }   
    
    function get_breeding(){
        return $this->parse_months($this->breeding);
    }
    function get_egg_laying(){
        return $this->parse_months($this->egg_laying);
    }

    /**
     * parse_months($string)
     * This method takes a string which consists of space seperated
     * 3 letter month values. It parses this string using a space as the delimeter
     * then checks for the existence of the month in the array and 
     * sets the class attribute to 'active' if the month is present or blank if it is not
     */
    function parse_months($string){
        $array = explode(" ",  $string);
        $row = "";
        in_array("Jan", $array) ? $row.="<td class='active'>Jan</td>" : $row.="<td>Jan</td>";
        in_array("Feb", $array) ? $row.="<td class='active'>Feb</td>" : $row.="<td>Feb</td>";
        in_array("Mar", $array) ? $row.="<td class='active'>Mar</td>" : $row.="<td>Mar</td>";
        in_array("Apr", $array) ? $row.="<td class='active'>Apr</td>" : $row.="<td>Apr</td>";
        in_array("May", $array) ? $row.="<td class='active'>May</td>" : $row.="<td>May</td>";
        in_array("Jun", $array) ? $row.="<td class='active'>Jun</td>" : $row.="<td>Jun</td>";
        in_array("Jul", $array) ? $row.="<td class='active'>Jul</td>" : $row.="<td>Jul</td>";
        in_array("Aug", $array) ? $row.="<td class='active'>Aug</td>" : $row.="<td>Aug</td>";
        in_array("Sep", $array) ? $row.="<td class='active'>Sep</td>" : $row.="<td>Sep</td>";
        in_array("Oct", $array) ? $row.="<td class='active'>Oct</td>" : $row.="<td>Oct</td>";
        in_array("Nov", $array) ? $row.="<td class='active'>Nov</td>" : $row.="<td>Nov</td>";
        in_array("Dec", $array) ? $row.="<td class='active'>Dec</td>" : $row.="<td>Dec</td>";
        return $row;
    }

    /**
     * get_icon_box()
     * This method gets the classification of the bird (Seabird, Land, Flightless, Wetland)
     * and creates an HTML component with the relevant icon
     */
    function get_icon_box(){
        $classificaton_icon = "";
        if($this->classification == 'Seabird'){
            $classificaton_icon = "../assets/images/icons/seabird.svg";
        }else if($this->classification == 'Land'){
            $classificaton_icon = "../assets/images/icons/land.svg";
        }else if($this->classification == 'Flightless'){
            $classificaton_icon = "../assets/images/icons/flightless.svg";
        }else if($this->classification == 'Wetland'){
            $classificaton_icon = "../assets/images/icons/wetland.svg";
        }

        return "<div class='icon-layout'>
                    <div class='icon-box'>
                        <img src='../assets/images/icons/weight.svg' class='icon'/> 
                        <span>$this->weight</span> 
                    </div>
                    <div class='icon-box'>
                        <img src='../assets/images/icons/length.svg' class='icon'/> 
                        <span>$this->length</span> 
                    </div>
                    <div class='icon-box'>
                        <img src='$classificaton_icon' class='icon'/>
                        <span>$this->classification</span>
                    </div>
                </div>";
    }

    /**
     * get_conservation_status_box()
     * This method takes the conservation status for the bird and determines which of
     * 3 categories it fits in (green, orange, or red) and tags the class attribute
     * accordingly, returning an HTML component
     */
    function get_conservation_status_box(){
        $result = $this->conservation_status;
        if (
            $this->conservation_status == "Coloniser" | 
            $this->conservation_status == "Vagrant" |
            $this->conservation_status == "Migrant" |
            $this->conservation_status == "Introduced and Naturalised"){
            $result = "<li><span>Conservation Status: </span><span class='consv-green'>$this->conservation_status</span></li>";
        }

        else if (
            $this->conservation_status == "Not Threatend" | 
            $this->conservation_status == "Declining" |
            $this->conservation_status == "Recovering" |
            $this->conservation_status == "Relict" |
            $this->conservation_status == "Naturally Uncommon" ){
            $result = "<li><span>Conservation Status: </span><span class='consv-orange'>$this->conservation_status</span></li>";
        }

        else if (
            $this->conservation_status == "Nationally Critical" | 
            $this->conservation_status == "Nationally Endangered" |
            $this->conservation_status == "Nationally Vulnerable"){
           $result = "<li><span>Conservation Status: </span><span class='consv-red'>$this->conservation_status</span></li>";
        }

        return $result;
    }
}
?>