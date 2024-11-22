<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::get();

        return view('admin.books', ['books' => $books]);
    }

    /**
     * Display a listing of the resource for user.
     */
    public function userIndex()
    {
        Book::get();
        return view("");
    }

    /**
     * Display a listing of the books belongs to a category
     *
     * @param string $category The category of the books
     */
    public function getOfCategory(string $category) //category_id passe for condition
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors    = Author::get();
        $categories = Category::select([ 'id', 'name' ])->get();

        return view('admin.forms.book.create', [
            'authors' => $authors,
            'categories' => $categories
         ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $categories = $request->categories; // Categories IDs

        $pic = time() . '-' . $request->title . '.' . $request->cover->extension();
        $request->cover->move('storage/images/book_images',$pic);

        $book = Book::create([
            'title'       => $request->title,
            'describtion' => $request->describtion,
            'author_id' => $request->author_id,
            'cover' => $pic,
        ]);

        $book->categories()->attach($categories);

        return redirect(route('books.index'))->with('message', 'Book Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $authors        = Author::get();
        $categories     = Category::select([ 'id', 'name' ])->get();
        $book           = Book::where('id', $id)->first();
        $bookCategories = $book->categories()->get();

        return view('admin.forms.book.update', $book, compact('authors', 'categories', 'bookCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBookRequest $request, string $id)
    {
        $categories = $request->categories; // Categories IDs

        $book = Book::find($id);

        $pic = time() . '-' . $request->title . '.' . $request->cover->extension();
        $request->cover->move('storage/images/book_images',$pic);

        $book->update([
            'title'       => $request->title,
            'describtion' => $request->describtion,
            'author_id'   => $request->author_id,
            'cover'       => $pic,
        ]);

        $book->categories()->sync($categories);

        return redirect(route('books.index'))->with('message','Book Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Book::where('id', $id)->delete();
        return redirect("")->with('message',"Book Deleted");
    }
}
