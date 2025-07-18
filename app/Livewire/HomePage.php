<?php

namespace App\Livewire;

use App\Models\Brand;
use Livewire\Component;
use Livewire\Attributes\Title;


    #[Title('Home Page - Platinum Computer')]
    class HomePage extends Component {
    public function render(){
        $brand = Brand::where('is_active',1)->get();
        $categories = \App\Models\Category::where('is_active',1)->get();
        return view('livewire.home-page', [
            'brands' => $brand,
            'categories' => $categories,
        ]);
    }
}

