<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\UserType;
use Illuminate\Http\Request;

class UserTypesController extends Controller
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
            $usertypes = UserType::where('user_type', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $usertypes = UserType::latest()->paginate($perPage);
        }

        return view('admin.user-types.index', compact('usertypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.user-types.create');
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
			'user_type' => 'required|max:50'
		]);
        $requestData = $request->all();
        
        UserType::create($requestData);

        return redirect('admin/user-types')->with('flash_message', 'UserType added!');
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
        $usertype = UserType::findOrFail($id);

        return view('admin.user-types.show', compact('usertype'));
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
        $usertype = UserType::findOrFail($id);

        return view('admin.user-types.edit', compact('usertype'));
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
			'user_type' => 'required|max:50'
		]);
        $requestData = $request->all();
        
        $usertype = UserType::findOrFail($id);
        $usertype->update($requestData);

        return redirect('admin/user-types')->with('flash_message', 'UserType updated!');
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
        UserType::destroy($id);

        return redirect('admin/user-types')->with('flash_message', 'UserType deleted!');
    }
}
