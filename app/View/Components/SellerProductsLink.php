<?php

namespace App\View\Components;

use App\Models\Seller;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Ramsey\Uuid\Type\Integer;

class SellerProductsLink extends Component
{
    /**
     * Create a new component instance.
     */
    public readonly Seller $seller;

    public function __construct()
    {

        $this->seller = new Seller();
       
    }

    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.seller-products-link');
    }
}
