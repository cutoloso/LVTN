<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use Auth, DB;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($pro_id)
    {
        $reviews = DB::table('reviews')
            ->select('reviews.*', 'users.name as usr_name')
            ->where('parent',0)
            ->where('reviews.active',1)
            ->where('pro_id', $pro_id)
            ->leftJoin('users','users.id','reviews.usr_id')
            ->orderBy('reviews.created_at','desc')
            ->get();
        foreach ($reviews as $item){
            $subReviews = DB::table('reviews')->where('parent',$item->id)->where('reviews.active',1)->get();
            if($subReviews){
                $arrSub = [];
                foreach ($subReviews as $sub){
                    $tempSub = DB::table('reviews')
                        ->select('reviews.*', 'users.name as usr_name')
                        ->where('reviews.id',$sub->id)
                        ->where('reviews.active',1)
                        ->leftJoin('users','users.id','reviews.usr_id')
                        ->orderBy('reviews.created_at','desc')
                        ->first();
                    array_push($arrSub,$tempSub);
                }
                $item->subReview = $arrSub;
            }
        }
        return response()->json(['reviews'=>$reviews]);
    }

    public function filter(Request $request)
        {
            if ($request->star == -1){
                $reviews = DB::table('reviews')
                    ->select('reviews.*', 'users.name as usr_name')
                    ->where('parent',0)
                    ->where('reviews.active',1)
                    ->where('reviews.active',1)
                    ->where('pro_id',$request->pro_id)
                    ->leftJoin('users','users.id','reviews.usr_id')
                    ->orderBy('reviews.created_at','desc')
                    ->get();
            }
            else{
                $reviews = DB::table('reviews')
                    ->select('reviews.*', 'users.name as usr_name')
                    ->where('parent',0)
                    ->where('reviews.active',1)
                    ->where('reviews.active',1)
                    ->where('pro_id',$request->pro_id)
                    ->where('star',$request->star)
                    ->leftJoin('users','users.id','reviews.usr_id')
                    ->orderBy('reviews.created_at','desc')
                    ->get();
            }
            foreach ($reviews as $item){
                $subReviews = DB::table('reviews')->where('parent',$item->id)->where('reviews.active',1)->get();
                if($subReviews){
                    $arrSub = [];
                    foreach ($subReviews as $sub){
                        $tempSub = DB::table('reviews')
                            ->select('reviews.*', 'users.name as usr_name')
                            ->where('reviews.id',$sub->id)
                            ->where('reviews.active',1)
                            ->leftJoin('users','users.id','reviews.usr_id')
                            ->orderBy('reviews.created_at','desc')
                            ->first();
                        array_push($arrSub,$tempSub);
                    }
                    $item->subReview = $arrSub;
                }
            }
            return response()->json(['reviews'=>$reviews]);
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reviews = new Review();
        $reviews->pro_id    = $request->pro_id;
        $reviews->usr_id    = Auth::user()->id;
        if ($request->parent){
            $reviews->parent    = $request->parent;
        }
        if ($request->star){
            $reviews->star    = $request->star;
        }
        if ($request->title){
            $reviews->title    = $request->title;
        }
        $reviews->content    = $request->detail;

        if ($request->sentiment > 0.5){
            $reviews->sentiment = 1;
        }
        else{
            $reviews->sentiment = 0;
        }
        $reviews->save();

        return $this->index($request->pro_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {

    }

    public function checkCountReview($pro_id){
        $usr_id = Auth::user()->id;
        $count = DB::table('reviews')
            ->where('pro_id',$pro_id)
            ->where('usr_id',$usr_id)
            ->count('id');
        return $count;
    }
}
