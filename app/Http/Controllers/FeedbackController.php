<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Vote;
use Illuminate\Validation\ValidationException;
class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $feedbacks
        // $feedbacks = Feedback::with('user', 'category', 'comments')->paginate(10);
        $feedbacks = Feedback::select('id', 'title', 'user_id', 'category_id','vote_count','comments_enabled') // Specify columns from the feedbacks table
            ->with([
                'user:id,name', // Specify columns from the users table (id and name)
                'category:id,name', // Specify columns from the categories table (id and name)
                'comments:feedback_id,content' // Specify columns from the comments table (feedback_id and comment_content)
            ])->paginate(10);
        return view('feedback.index', compact('feedbacks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('feedback.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'product_id' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);
        $existingFeedback = Feedback::where('user_id', auth()->user()->id)
        ->where('category_id', $request->input('category_id'))->first();

        // If a duplicate feedback entry exists, throw a validation exception
        if ($existingFeedback) {
            throw ValidationException::withMessages([
                'category_id' => ['You have already submitted feedback for this category.']
            ]);
        }

        $feedback = Feedback::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => auth()->user()->id, 
            'category_id' => $request->input('category_id'),
            'product_id' => $request->input('product_id'),
            'vote_count' => 0, // Default vote count
        ]); 
        // Redirect back with a success message
        return redirect()->route('products.index')->with('success', 'Feedback submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Feedback $feedback)
    {
        return view('feedback.show', compact('feedback'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feedback $feedback)
    {
        $categories = Category::all();
        return view('feedback.edit', compact('feedback','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $feedback = Feedback::find($id);
        // Check if the feedback record exists
        if (!$feedback) {
            return back()->with('error' , 'Feedback not found');
        }
        // Update the feedback record with the validated data
        $feedback->update($request->all());

        return redirect()->route('feedbacks.index')->with('success', 'Feedback updatted successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return back()->with('success', 'Feedback deleted successfully!');
    }

    public function vote(Request $request, $feedbackId)
    {
        $feedback = Feedback::findOrFail($feedbackId);

        // Check if the user has already voted for this feedback
        if ($feedback->votes()->where('user_id', auth()->user()->id)->exists()) {
            // Unvote if already voted
            $feedback->votes()->where('user_id', auth()->user()->id)->delete();
            $feedback->decrement('vote_count'); // Decrement the vote count
        } else {
            // Vote if not already voted
            Vote::create([
                'user_id' => auth()->user()->id,
                'feedback_id' => $feedback->id,
            ]);
            $feedback->increment('vote_count'); // Increment the vote count
        }
        return back()->with('success', 'Vote updated successfully');
    }
    public function toggleComments(Request $request, Feedback $feedback)
    {
        $feedback->update([
            'comments_enabled' => !$feedback->comments_enabled,
        ]);
        return redirect()->back()->with('success', 'Comments status updated successfully.');
    }
}
