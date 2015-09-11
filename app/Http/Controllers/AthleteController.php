<?php

namespace RYP\Http\Controllers;

use Illuminate\Http\Request;

use RYP\Http\Requests;
use RYP\Http\Controllers\Controller;
use RYP\Athlete;

class athletecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(){
        $athlete = Athlete::find(37);
        $ath = '';
//		foreach($athletes as $athlete){
			$ath .= $athlete->name . '<br>';
			$ath .= $athlete->nickname . '<br>';
			$ath .= $athlete->height . '<br>';
			$ath .= $athlete->weight . '<br>';
//		}
		return $ath;
        //        return View::make('athletes.index',compact('athletes'));
    }

    public function arse(){
    	$name = 'Dave';
    	$people = array(
    		'Fred','Joe','Malcolm'
    	);
    	return view('arse',compact('name','people'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
