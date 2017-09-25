<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ProblemCategory;

class SettingsController extends Controller
{
    public function showSettingsPage(){
      $categories = ProblemCategory::all();
      $deleteCategories = ProblemCategory::onlyTrashed()->get();
      return view('settings')->with('categories', $categories)->with('deleteCategories', $deleteCategories);
    }
    public function addNewCategory(Request $request){
      $category = ProblemCategory::create([
          'name' => $request->name,
        ]);
      return back();
    }

    public function deleteCategory(Request $request){
      $category = ProblemCategory::findorFail($request->categoryId);

      $category->delete();
      return back();
    }

    public function activateCategory(Request $request){
      $category = ProblemCategory::onlyTrashed()->findorFail($request->categoryId);

      $category->restore();
      return back();
    }

    public function getAllCategories(){
      $categories = ProblemCategory::all();
      return $categories->toArray();
    }
}
