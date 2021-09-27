<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsUpdateRequest;
use App\Http\Requests\NewsCreateRequest;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;


class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.news.index', [
			'newsList' => News::with('category')
			->paginate(
				config('news.paginate')
			)
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.news.create', ['categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsCreateRequest $request)
    {
        $news = News::create(
			$request->validated()
		);

		if( $news ) {
			return redirect()
				->route('admin.news.index')
				->with('success', trans(key:'messages.admin.news.create.success'));
		}

		return back()
			->with('error', __(key:'messages.admin.news.create.fail'))
			->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', [
			'news' => $news,
			'categories' => Category::all()
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsUpdateRequest $request, News $news)
    {
        $news = $news->fill(
			$request->validated()
		)->save();

		if( $news ) {
			return redirect()
				->route('admin.news.index')
				->with('success', trans(key:'messages.admin.news.update.success'));
		}

		return back()
			->with('error', __(key:'messages.admin.news.update.fail'))
			->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        try {
            $news->delete();
        } catch (\Exception $e) {
            //\Log::error(message:"Error delete News". PHP_EOL, [$e]);
        }
    }
}
