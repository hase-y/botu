<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Profile;
use App\Phistory;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function add()
    {
        return view('create');
    }

    public function create(Request $request)
    {
     //以下を追記
     //varidationを行う
        $this->validate($request, Profile::$rules);
        
        $profile = new Profile;
        $form = $request->all();
        
        // フォームから画像が送信されてきたら、保存して、$profile->image_path に画像のパスを保存する
        //if (isset($form['image'])) {
            //$path = $request->file('image')->store('public/image');
            //$profile->image_path = basename($path);
        //} else {
            //$profile->image_path = null;
        //}
        
        //フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        //フォームから送信されてきたimageを削除する
        unset($form['image']);
        
        //データベースに保存する
        $profile->fill($form);
        $profile->save();
        
        return redirect('admin/profile/create');
    }
    
     public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          $posts = Profile::where('title', $cond_title)->get();
      } else {
          $posts = Profile::all();
      }
      return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }
    
    
     public function edit(Request $request)
  {
      // Profel Modelからデータを取得する
      $profile = Profile::find($request->id);

      return view('admin.profile.edit', ['profile_form' => $profile]);
  }
    
    public function update(Request $request)
    {
        $this->validate($request, Profile::$rules);
        $profile = Profile::find($request->id);
        $profile_form = $request->all();
        //if ($request->remove == 'true') {
            //$news_form['image_path'] = null;
        //} elseif ($request->file('image')) {
            //$path = $request->file('image')->store('public/image');
           // $news_form['image_path'] = basename($path);
        //} else {
            //$news_form['image_path'] = $news->image_path;
        //}

        unset($profile_form['_token']);
        unset($profile_form['image']);
        unset($profile_form['remove']);
        $profile->fill($profile_form)->save();
        
        $phistory = new Phistory();
        $phistory->profile_id = $profile->id;
        $phistory->edited_at = Carbon::now();
        $phistory->save();
        
        return redirect('admin/profile/');
    }
    public function delete(Request $request)
  {
      // 該当するProfile Modelを取得
      $profile = Profile::find($request->id);
      // 削除する
      $profile->delete();
      return redirect('admin/profile/');
  }  
}
