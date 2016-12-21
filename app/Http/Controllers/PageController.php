<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $pages = Page::latest()->get();
        $pages = Page::all();

        return view('pages.index')->with([
            'pages' => $pages,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $page = new Page();
        $page->title = $request->title;

        return view('pages.form', [
            'page' => $page,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:pages,title',
            'body' => 'required',
        ]);

        $post = Page::create($request->all());

        return redirect($post->url);
    }

    /**
     * Display the specified resource.
     *
     * @param string $title
     * @return \Illuminate\Http\Response
     */
    public function show(string $title)
    {
        $page = Page::whereTitle($title)->first();

        if (!$page) {
            $page = new Page;
            $page->title = $title;
        }

        return view('pages.show')->with([
            'page' => $page,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Page $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('pages.form', [
            'page' => $page,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Page $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $this->validate($request, [
            'title' => 'required|unique:pages,title,'.$page->id,
            'body' => 'required',
        ]);

        $page->update($request->all());

        return redirect($page->url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Page $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }
}
