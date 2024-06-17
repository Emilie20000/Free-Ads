<?php

namespace App\Http\Controllers;
use App\Models\Ad;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $search = $request->input('search');
        $sortByPrice = $request->input('price');
        $sortByDate = $request->input('date');
    
        $query = Ad::query()->with('user');
        
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }
    
        if ($sortByPrice === 'asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sortByPrice === 'desc') {
            $query->orderBy('price', 'desc');
        }
    
        if ($sortByDate === 'asc') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sortByDate === 'desc') {
            $query->orderBy('created_at', 'desc');
        }
        
        $ads = $query->paginate(12);

        if (!$search && !$sortByPrice && !$sortByDate) {
            $ads = Ad::orderBy('created_at', 'desc')->paginate(12);
        }


        return view('ads.index', ['ads' => $ads, 'user' => Auth::user()]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'price' => 'required|numeric|min:0',
            'pictures.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        

        $ad = Ad::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
            'user_id' => Auth::id(),
            'pictures' => json_encode([]),
        ]);
 

        if ($request->hasFile('pictures')) {
            $pictures = [];
            foreach ($request->file('pictures') as $picture) {
                $filename = $picture->store('public/images');
                $pictures[] = str_replace('public/', '', $filename);
            }

            $ad->pictures = json_encode($pictures);
            $ad->save();
        }

        $ad->save();
        return redirect()->route('ads.index', ['user' => Auth::user()]);

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
        $ad = Ad::find($id);

        return view('ads.edit', ['ad' => $ad]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ad = Ad::find($id);


    $data = $request->validate([
        'title' => 'nullable|string|max:255',
        'description' => 'nullable|string|max:5000',
        'price' => 'nullable|numeric|min:0',
        'pictures.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

 
    if (!empty($data['title'])) {
        $ad->title = $data['title'];
    }

    if (!empty($data['description'])) {
        $ad->description = $data['description'];
    }
    if (!empty($data['price'])) {
        $ad->price = $data['price'];
    }

    if ($request->hasFile('pictures')) {
        $pictures = [];
        foreach ($request->file('pictures') as $picture) {
            $filename = $picture->store('public/images');
            $pictures[] = str_replace('public/', '', $filename);
        }
       
        $ad->pictures = json_encode($pictures);
        $ad->save();
    }

    $ad->save();

        return redirect()->route('ads.index', ['user' => Auth::user()]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ad = Ad::find($id);

        $ad->delete();
        
        return redirect()->route('users.show', ['user' => Auth::id()]);
    }
}
