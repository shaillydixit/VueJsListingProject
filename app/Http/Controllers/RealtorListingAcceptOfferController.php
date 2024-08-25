<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class RealtorListingAcceptOfferController extends Controller
{
    // public function __invoke(Offer $offer)
    // {
    //     $listing = $offer->listing;
    //     // $this->authorize('update', $listing);

    //     // Accept selected offer
    //     $offer->update(['accepted_at' => now()]);
    //     $listing->sold_at = now();
    //     $listing->save();
    //     // Reject all other offers
    //     $listing->offers()->except($offer)
    //         ->update(['rejected_at' => now()]);

    //     return redirect()->back()
    //         ->with(
    //             'success',
    //             "Offer #{$offer->id} accepted, other offers rejected"
    //         );
    // }
    public function __invoke(Offer $offer)
    {
 
        //Accept selected offer
        $offer->update(['accepted_at' => now()]);
        
        // Reject all other offers
        $offer->listing->offers()->except($offer)
            ->update(['rejected_at' => now()]);
 
        return redirect()->back()
        ->with(
            'Message',
            "Offer #{$offer->id} Accepted"
    );
    }

}
