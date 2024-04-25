<?php

namespace App\Presenters;
use Carbon\Carbon;

trait UserPresenter
{
   public function getClinicaListAttribute()
   {
      $clinicaList = [];

       foreach($this->clinicas as $clinica)
       {
          $clinicaList[] = $clinica->id;
       }

       return $clinicaList;
   }
}