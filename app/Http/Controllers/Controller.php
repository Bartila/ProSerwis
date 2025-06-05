<?php

namespace App\Http\Controllers;

/**
 * Bazowy kontroler, z którego dziedziczą wszystkie inne kontrolery aplikacji.
 *
 * Udostępnia funkcjonalności związane z:
 * - Autoryzacją 
 * - Kolejkowaniem zadań
 * - Walidacją danych
 */

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
