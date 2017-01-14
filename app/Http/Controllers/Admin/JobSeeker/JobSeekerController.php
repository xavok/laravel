<?php

namespace App\Http\Controllers\Admin\JobSeeker;

use App\Models\Seeker\SeekerProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobSeekerController extends Controller
{
    public function index()
    {
        $users = SeekerProfile::all();
        return view('admin.seeker.list', [
            'list' => $users,
        ]);
    }
    public function create()
    {
        return view('admin.seeker.create');
    }

    public function store(Request $request)
    {
        $item = new Scrapbook();
        $item->fill($request->all());
        $item->save();
        $request->session()->flash('alert-success', 'Saved.');
        return redirect()->route('admin::scrapbooks::list');
    }

    public function edit(Request $request, $itemId)
    {
        $item = SeekerProfile::findOrFail($itemId);
        return view('admin.seeker.edit', [
            'item' => $item,
        ]);
    }

    public function update(Request $request, $itemId)
    {
        $item = SeekerProfile::findOrFail($itemId);
        $item->fill($request->all());
        $item->update();
        $request->session()->flash('alert-success', 'Updated.');
        return redirect()->route('admin::seeker::edit', $item->id);
    }

    public function delete(Request $request, $itemId)
    {
        $item = SeekerProfile::findOrFail($itemId);
        $item->delete();
        $request->session()->flash('alert-success', 'Deleted.');
        return redirect()->route('admin::seeker::list');
    }
}
