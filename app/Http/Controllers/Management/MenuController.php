<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Panggil model category karena untuk input menu ada select category
use App\Models\Category;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Declare category
        $menus = Menu::all();
        return view('management.menu')->with('menus', $menus);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('management.createMenu')->with('categories', $categories);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $price = str_replace('.', '', $request->price); // Menghapus titik sebagai pemisah ribuan
        // $price = str_replace(',', '.', $price); // Mengganti koma dengan titik sebagai tanda desimal
        // $request->merge(['price' => $price]); // Mengganti nilai 'price' dalam request
        $request->validate([
            'name' => 'required|unique:menus|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric'
        ]);
    
        // If a user doesn't upload an image, so it will use noimage.png for the menu.
        $imageName = "noimage.png";
        if ($request->image) {
            $request->validate([
                'image' => 'nullable|file|image|mimes:jpeg,png,jpg|max:5000'
            ]);
            $imageName = date('mdYHis').uniqid().'.'.$request->image->extension();
            $request->image->move(public_path('menu_images'), $imageName);
        }
    
        $menu = new Menu();
        $menu->name = $request->name;
        $menu->price = $request->price;
        $menu->image = $imageName;
        $menu->description = $request->description;
        $menu->category_id = $request->category_id;
        $menu->save();
    
        $request->session()->flash('status', $request->name . ' is saved successfully');
        return redirect('/management/menu');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $menu = Menu::find($id);
        $categories = Category::all();
        return view('management.editMenu')->with('menu',$menu)->with('categories',$categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // information of validation
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric'
        ]);
        $menu = Menu::find($id);

        //validate if a user upload image 
        if($request->image){
            $request->validate([
                'image'=>'nullable|file|image|mimes:jpeg,png,jpg|max:5000'
            ]);
            if($menu->image != "noimage.png"){
                $imageName = $menu->image;
                unlink(public_path('menu_images').'/'.$imageName);
            }
            $imageName = date('mdYHis').uniqid().'.'.$request->image->extension();
            $request->image->move(public_path('menu_images'),$imageName);
        }else{
            $imageName = $menu->image;
        }
        $menu->name = $request->name;
        $menu->price = $request->price;
        $menu->image = $imageName;
        $menu->description = $request->description;
        $menu->category_id = $request->category_id;
        $menu->save();
        $request->session()->flash('status', $request->name.' is updated succesfully');
        return redirect('/management/menu');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $menu = Menu::find($id);

        if (!$menu) {
            // Menu dengan ID yang diberikan tidak ditemukan
            return redirect('/management/menu')->with('status', 'Menu not found');
        }

        if ($menu->image != "noimage.png") {
            unlink(public_path('menu_images') . '/' . $menu->image);
        }

        $menuName = $menu->name;
        $menu->delete();

        Session()->flash('status', $menuName . ' is deleted Successfully');
        return redirect('/management/menu');
    }
}
