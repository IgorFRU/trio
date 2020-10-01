<?php

namespace App\Http\Controllers;

use App\BlackIp;
use App\Http\Middleware\BlockIp;
use Illuminate\Http\Request;

class BlackIpController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array (
            'ips' => BlackIp::orderBy('id', 'DESC')->get()
        );

        return view('admin.block_ip.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array (
            'ip' => [],
        );
        
        return view('admin.block_ip.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $ip = BlackIp::create($request->all());        
        
        return redirect()->route('admin.blockip.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BblackIp  $bblackIp
     * @return \Illuminate\Http\Response
     */
    public function show(BlackIp $blackIp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BblackIp  $bblackIp
     * @return \Illuminate\Http\Response
     */
    public function edit($blackIp)
    {
        $ip = BlackIp::where('id', $blackIp)->firstOrFail();
        
        $data = array (
            'ip' => $ip,
        );
        
        return view('admin.block_ip.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BblackIp  $bblackIp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlackIp $blackIp)
    {
        $blackIp->update($request->all());

        return redirect()->route('admin.blockip.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BblackIp  $bblackIp
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ip = BlackIp::where('id', $id)->firstOrFail();
        $ip->delete();

        return redirect()->route('admin.blockip.index');
    }
}
