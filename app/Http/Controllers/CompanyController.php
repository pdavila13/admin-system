<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $data = Company::orderBy('id', 'DESC')->get();
        view()->share('data', $data);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.companies.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'collection' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'image' => 'required',
        ]);

        $baseSlug = Str::slug($request->name);
        $uniqueSlug = $baseSlug;
        $counter = 1;
        while (Product::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $group_vpn = new Product();
        $group_vpn->name = $request->name;
        $group_vpn->collection_id = $request->collection;
        $group_vpn->category_id = $request->category;
        $group_vpn->sub_category_id = $request->subcategory;
        $group_vpn->slug = $uniqueSlug;

        // Primary group_vpn image store
        if ($primaryImage = $request->file('image')) {
            $destinationPath = 'group_vpn-image/';
            $profileImage = $uniqueSlug . '.' . $primaryImage->getClientOriginalExtension();
            $primaryImage->move($destinationPath, $profileImage);
            $group_vpn->image = $profileImage;
        }

        $group_vpn->save();

        // Product slider image or external css
        $productId = $group_vpn->id;
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $image) {
                $realImage = $uniqueSlug . "-" . rand(1, 9999) . "-" . date('d-m-Y-h-s') . "." . $image->getClientOriginalExtension();
                $path = $image->move('group_vpn-slider-images', $realImage);
                ProductImage::create([
                    'product_id' => $productId,
                    'image' => $realImage,
                ]);
            }
        }


        return redirect()->route('admin.group_vpn.index')->with('success', 'Product created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Product::where('id', decrypt($id))->first();
        $productImages = ProductImage::where('product_id', $data->id)->get();
        $subcategory = SubCateory::where('category_id', $data->category_id)->get();
        return view('admin.groups_vpn.edit', compact('productImages', 'data', 'subcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function getsubcategory(Request $request)
    {
        $subcategory = SubCateory::where('category_id', $request->category)->get();
        return view('admin.groups_vpn.subcategory', compact('subcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'collection' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
        ]);
        $baseSlug = Str::slug($request->name);
        $uniqueSlug = $baseSlug;
        $counter = 1;
        while (Product::where('slug', $uniqueSlug)->where('id', '!=', $request->id)->exists()) {
            $uniqueSlug = $baseSlug . '-' . $counter;
            $counter++;
        }
        $group_vpn = Product::find($request->id);
        $group_vpn->name = $request->name;
        $group_vpn->collection_id = $request->collection;
        $group_vpn->category_id = $request->category;
        $group_vpn->sub_category_id = $request->subcategory;
        $group_vpn->slug = $uniqueSlug;
        if ($real_image = $request->file('image')) {
            // Old Image remove
            $group_vpn = Product::where('id', $request->id)->first();
            $image_path = public_path('group_vpn-image/' . $group_vpn->image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            // Added new image
            $productRealImage = 'group_vpn-image/';
            $realImage = $request->slug . "." . $real_image->getClientOriginalExtension();
            $real_image->move($productRealImage, $realImage);
            $group_vpn->image = $realImage;
        }
        $group_vpn->save();
        $productId = $group_vpn->id;
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $realImage = $request->slug . "-" . rand(1, 9999) . "-" . date('d-m-Y-h-s') . "." . $image->getClientOriginalExtension();
                $path = $image->move('group_vpn-slider-images', $realImage);
                ProductImage::create([
                    'product_id' => $productId,
                    'image' => $realImage,
                ]);
            }
        }

        return redirect()->route('admin.group_vpn.index')->with('success', 'Product created successfully');
    }

    /**
     * Remove the external image.
     */
    public function removeImage($id)
    {
        $group_vpn = ProductImage::where('id', $id)->first();
        $image_path = public_path('group_vpn-slider-images/' . $group_vpn->image);
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $group_vpn->delete();
        return redirect()->back()->with('warning', 'Product image removed successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $group_vpn = Product::where('id', decrypt($id))->first();
        if ($group_vpn) {
            $image_path = public_path('group_vpn-image/' . $group_vpn->image);
            if (file_exists($image_path)) {
                unlink($image_path);
                $group_vpn->delete();
            }
        }
        $productCollectionId = decrypt($id);
        $imagesToDelete = ProductImage::where('product_id', $productCollectionId)->get();
        foreach ($imagesToDelete as $image) {
            $imagePath = public_path('group_vpn-slider-images/' . $image->image);
            // Delete the record from the database
            $image->delete();
            // Unlink (delete) the image from storage
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        return redirect()->route('admin.group_vpn.index')->with('error', 'Product deleted successfully.');
    }
}