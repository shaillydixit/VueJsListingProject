<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Auth;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(Listing::class, 'listing');
    // }
    // public function __construct()
    // {
    //     Gate::authorize('listing', Listing::class);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo'
        ]);
        // $query = Listing::orderByDesc('created_at');

        // if ($filters['priceFrom'] ?? false) {
        //     $query->where('price', '>=', $filters['priceFrom']);
        // }

        // if ($filters['priceTo'] ?? false) {
        //     $query->where('price', '<=', $filters['priceTo']);
        // }

        // if ($filters['beds'] ?? false) {
        //     $query->where('beds', $filters['beds']);
        // }

        // if ($filters['baths'] ?? false) {
        //     $query->where('baths', $filters['baths']);
        // }

        // if ($filters['areaFrom'] ?? false) {
        //     $query->where('area', '>=', $filters['areaFrom']);
        // }

        // if ($filters['areaTo'] ?? false) {
        //     $query->where('area', '<=', $filters['areaTo']);
        // }

        return inertia('Listing/Index',[
            'filters' => $filters,
            'listings' => Listing::mostRecent()
            // ->when(
            //     $filters['priceFrom'] ?? false,
            //     fn ($query, $value) => $query->where('price', '>=', $value)
            // )->when(
            //     $filters['priceTo'] ?? false,
            //     fn ($query, $value) => $query->where('price', '<=', $value)
            // )->when(
            //     $filters['beds'] ?? false,
            //     fn ($query, $value) => $query->where('beds', (int)$value < 6 ? '=' : '>=', $value)
            // )->when(
            //     $filters['baths'] ?? false,
            //     fn ($query, $value) => $query->where('baths', (int)$value < 6 ? '=' : '>=', $value)
            // )->when(
            //     $filters['areaFrom'] ?? false,
            //     fn ($query, $value) => $query->where('area', '>=', $value)
            // )->when(
            //     $filters['areaTo'] ?? false,
            //     fn ($query, $value) => $query->where('area', '<=', $value)
            // )
            ->filter($filters)
            ->withoutSold()
            ->paginate(10)->withQueryString()
        ]);
    }
    public function show(Listing $listing)
    {
        // if (Auth::user()->cannot('view', $listing)) {
        //     abort(403);
        // }
        // $this->authorize('view', $listing);
        $listing->load(['images']);
        $offer = !Auth::user() ?
        null : $listing->offers()->byMe()->first();
        return inertia(
            'Listing/Show',
            [
                'listing' => $listing,
                'offerMade' => $offer            ]
        );
    }
    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return inertia('Listing/Create');
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'beds' => 'required|integer|min:0|max:20',
    //         'baths' => 'required|integer|min:0|max:20',
    //         'area' => 'required|integer|min:15|max:1500',
    //         'city' => 'required',
    //         'code' => 'required',
    //         'street' => 'required',
    //         'street_nr' => 'required|min:1|max:1000',
    //         'price' => 'required|integer|min:1|max:20000000',
    //     ]);
    //     Listing::create([
    //         "beds" => $request->beds,
    //         "baths" =>  $request->baths,
    //         "area" =>  $request->area,
    //         "city" =>  $request->city,
    //         "street" =>  $request->street,
    //         "code" =>  $request->code,
    //         "street_nr" =>  $request->street_nr,
    //         "price" => $request->price,
    //     ]);

    //     return redirect()->route('listing.index')->with('success', 'Listing was created');
    // }

    /**
     * Display the specified resource.
     */
    // public function show(Listing $listing)
    // {
    //     // if(Auth::user()->cannot('view', $listing)){
    //     //     abort(403);
    //     // }
    //     // $this->authorize('view', Listing::class);
        
    //     return inertia('Listing/Show',[
    //         'listing' => $listing
    //     ]);
    // }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Listing $listing)
    // {
    //     return inertia('Listing/Edit',[
    //         'listing' => $listing
    //     ]);
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Listing $listing)
    // {
    //     $listing->update(
    //         $request->validate([
    //             'beds' => 'required|integer|min:0|max:20',
    //             'baths' => 'required|integer|min:0|max:20',
    //             'area' => 'required|integer|min:15|max:1500',
    //             'city' => 'required',
    //             'code' => 'required',
    //             'street' => 'required',
    //             'street_nr' => 'required|min:1|max:1000',
    //             'price' => 'required|integer|min:1|max:20000000',
    //         ])
    //     );

    //     return redirect()->route('listing.index')->with('success', 'Listing Updated Successfully');
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Listing $listing)
    // {
    //     $listing->delete();
    //     return redirect()->back()->with('success', 'Listing Deleted Successfully');
    // }
}
