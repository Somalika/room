<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mylib {

   public function prepare_term_paid ( $term_paid ){
      switch ($term_paid) {
         case 1:
            $arrTermPaid = array( 1 , "Yearly" , array( 0 ) );
            break;
         
         case 2:
            $arrTermPaid = array( 10 , "Monthly" , array( 1 , 1 , 1 , 0 , 0 , 0 , 0  , 0 , 0 , 0 ) );
            break;
         
         case 3:
            $arrTermPaid = array( 2 , "Semester" , array( 0 , 0 ) );
            break;
         
         case 4:
            $arrTermPaid = array( 4 , "Terms" , array( 1 , 0 , 0 , 0 ) );
            break;
      }
      return $arrTermPaid;
   }
   public function prepare_VAT ( $amount , $percent ){
      $vat = $amount * $percent / 100;
      return $vat;
   }
   public function prepare_discount ( $amount , $percent ){
      $discount = $amount * $percent / 100;
      return $discount;
   }
   public function prepare_cycle_name ( $number ){
      switch ($number) {
         case 1:
            return "year";
            break;
         case 2:
            return "semesters";
            break;
         case 4:
            return "terms";
            break;
         case 10:
            return "months";
            break;
         
         default:
            # code...
            break;
      }
   }
}

/* End of file Mylib.php */