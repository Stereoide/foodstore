<?php

namespace App\Http\Controllers;

use App\Ingredient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Fetch ingredients */

        $ingredients = Ingredient::available()->orderByName()->get();

        /* Show view */

        return view('pages.ingredients.index')->with(compact('ingredients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ingredient = Ingredient::create($request->all());
        return $ingredient;
    }

    public function stockUp(Ingredient $ingredient)
    {
        $ingredient->amount++;
        $ingredient->save();

        return $ingredient;
    }

    public function consume(Ingredient $ingredient)
    {
        $ingredient->amount--;

        if ($ingredient->amount < 1) {
            $ingredient->amount = 0;
        }

        $ingredient->save();

        return $ingredient;
    }

    public function deplete(Ingredient $ingredient)
    {
        $ingredient->amount = 0;
        $ingredient->depleted_at = Carbon::now();
        $ingredient->save();

        return $ingredient;
    }
}
