<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProblemSolvingController extends Controller
{
    use ApiTrait;

    /*
    |--------------------------------------------------------------------------
    | Question Number 1
    |--------------------------------------------------------------------------
    */
    public function count_numbers($start,$end){

        if($start < $end){
            return $this->ApiResponse('null',400,'Start Number Must be Greater Than End Number');
        }

        $numbers = range($start,$end);
        $array_length = count($numbers);
        for($i=0;$i<$array_length;$i++){
            if(preg_match('/[5]+/', $numbers[$i])){
                unset($numbers[$i]);
            }
        }

        $final_array_length = count($numbers);
        return $this->ApiResponse($final_array_length,200,'Final Count Result');
    }

    /*
    |--------------------------------------------------------------------------
    | Question Number 2
    |--------------------------------------------------------------------------
    */
    public function alphabet_index($input_string){
        $alphabets = range('A', 'Z');
        if(preg_match('/[0-9]+/', $input_string)){
            return $this->ApiResponse('null',400,'Please Enter Sting Alphabets only');
        }
        $number_of_characters = str_split(strtoupper($input_string),  1);
        $array_length = count($number_of_characters);

            $index_of_alphabet = array_search($number_of_characters[0],$alphabets);
            $alphabet_index = $index_of_alphabet+1;
            if($array_length>1) {
                $alpha_result = $alphabet_index;
                for($j=0;$j<$array_length-1;$j++){
                    $index_of_next_alphabet = array_search($number_of_characters[$j+1],$alphabets);
                    $alpha_result = ($alpha_result*26)+$index_of_next_alphabet+1;
                }
                $final_result = $alpha_result;
            }else{
                 $final_result = $alphabet_index;
            }

        return $this->ApiResponse($final_result,200,'Final Index of the String');
    }

    /*
    |--------------------------------------------------------------------------
    | Question Number 3
    |--------------------------------------------------------------------------
    */
    public function minimize($n,$q=[]){
        $array_of_numbers = explode(',',$q) ;

        $final_answer=array();
        for($i=0;$i<count($array_of_numbers);$i++){
            $answer=0;
            $number=$array_of_numbers[$i];
            while ($number>0){
                if($number%2){
                    --$number;
                }else{
                    $number/=2;
                }
                ++$answer;
            }
            array_push($final_answer,$answer);
        }
        return $final_answer;
    }

}
