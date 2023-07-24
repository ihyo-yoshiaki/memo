<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theme;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
   public function select(Theme $theme)
   {
	   $user_id = Auth::user()->id;
	   $themes = $theme->where('user_id', $user_id);
	   return view('themes.select')->with(['themes' => $themes->get()]);
   }

   public function index(Theme $theme)
   {
	   $user = $theme->user_id;
	   $other_themes = Theme::where('id', '<>', $theme->id)->where('user_id', $user);
	   return view('themes.index')->with(['memos'=> $theme->memos()->get(), 'main_theme' => $theme, 'other_themes' => $other_themes->get()]);
   }

   public function access(Request $request, Theme $theme)
   {
	   $theme_id = $request['theme'];
	   return redirect()->route('theme.index', ['theme' => $theme_id]);
   }
   
}
