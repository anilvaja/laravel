<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\ImpLink;
use Illuminate\Http\Request;

class ImpLinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $implinks = ImpLink::where('title', 'LIKE', "%$keyword%")
                ->orWhere('link', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $implinks = ImpLink::latest()->paginate($perPage);
        }

        return view('admin.imp-links.index', compact('implinks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.imp-links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'title' => 'required|max:50',
			'link' => 'required|max:1000'
		]);
        $requestData = $request->all();
        
        ImpLink::create($requestData);

        return redirect('admin/imp-links')->with('flash_message', 'ImpLink added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $implink = ImpLink::findOrFail($id);

        return view('admin.imp-links.show', compact('implink'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $implink = ImpLink::findOrFail($id);

        return view('admin.imp-links.edit', compact('implink'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'title' => 'required|max:50',
			'link' => 'required|max:1000'
		]);
        $requestData = $request->all();
        
        $implink = ImpLink::findOrFail($id);
        $implink->update($requestData);

        return redirect('admin/imp-links')->with('flash_message', 'ImpLink updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        ImpLink::destroy($id);

        return redirect('admin/imp-links')->with('flash_message', 'ImpLink deleted!');
    }
}
