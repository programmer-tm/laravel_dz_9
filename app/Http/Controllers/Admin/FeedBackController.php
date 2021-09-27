<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeedBack;
use App\Http\Requests\FeedBackUpdateRequest;
use App\Http\Requests\FeedBackCreateRequest;
use App\Models\News;
use Illuminate\Http\Request;

class FeedBackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.feedback.index', [
			'FeedBackList' => FeedBack::with('news')
			->paginate(
				config('feedback.paginate')
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
        return view('admin.feedback.create', ['NewsList' => News::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeedBackCreateRequest $request)
    {
        $FeedBack = FeedBack::create(
			$request->validated()
		);

		if( $FeedBack ) {
			return redirect()
				->route('admin.feedback.index')
				->with('success', trans(key:'messages.admin.feedback.create.success'));
		}

		return back()
			->with('error', __(key:'messages.admin.feedback.create.fail'))
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
    public function edit(FeedBack $feedback)
    {
        return view('admin.feedback.edit', [
			'feedback' => $feedback,
			'NewsList' => News::all()
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FeedBackUpdateRequest $request, FeedBack $feedback)
    {
        $FeedBack = $feedback->fill(
			$request->validated()
		)->save();

		if( $FeedBack ) {
			return redirect()
				->route('admin.feedback.index')
				->with('success', trans(key:'messages.admin.feedback.update.success'));
		}

		return back()
			->with('error', __(key:'messages.admin.feedback.update.fail'))
			->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeedBack $feedback)
    {
        try {
            $feedback->delete();
        } catch (\Exception $e) {
            //\Log::error(message:"Error delete News". PHP_EOL, [$e]);
        }
    }
}
