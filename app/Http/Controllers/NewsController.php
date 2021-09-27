<?php

namespace App\Http\Controllers;
use App\Models\News;
use App\Models\FeedBack;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(int $idCategory)
	{
		$model = new News();
		return view('news.index', [
			'idCategory' => $idCategory,
			'newsList' => $model->getNewsByCategoryId($idCategory)
		]);
	}

	public function show(int $idCategory, int $id, Request $request)
	{
		if ($request->get('name')){
		$request->validate([
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'email'],
            'feedback' => ['required', 'string', 'min:3', 'max: 1000']
		]);
        	$FeedBack = FeedBack::create(['news_id' => $id]+$request->only([$id, 'name', 'email', 'feedback'])
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
		
		$model = new News();
		$news = $model->getNewsById($id, $idCategory);
		$feedback = new Feedback();
		$feedbacks = $feedback->getFeedBack($id);
		return view('news.show', [
			'id' => $id,
			'idCategory' => $idCategory,
			'newsList' => $news,
			'feedbackList' => $feedbacks
		]);
	}
	
	public function store(Request $request)
    {
		$request->validate([
			'title' => ['required', 'string', 'min:3']
		]);
		
		return redirect()->route('news.show');
    }
}
