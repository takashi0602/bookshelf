<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use Auth;

class PublicBooksController extends Controller
{
    public function index()
    {
        $books = Book::where('flag', 'public')->orderBy('created_at', 'desc')->paginate(21);
        return view('public_books', [
            'books' => $books
        ]);
    }

    public function detail(Book $books)
    {
        if ($books->published !== null) {
            $books->published = explode('-', $books->published);
            $books->published = implode('/', $books->published);
        }

        $userName = User::select('name')->where('users.id', $books->user_id)->first();

        return view('books_detail', [
            'book' => $books,
            'userName' => $userName->name
        ]);
    }
}