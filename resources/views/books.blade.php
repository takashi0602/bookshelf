@extends('layouts.app')

@include('layouts.header')
@include('layouts.footer')

@section('content')
    <div class="p-create">
        <div class="c-container">
            <div class="c-contents u-contents_private">
                <h1 class="c-title">じぶんの本棚</h1>
                <a href="{{ url('/private/books/add') }}" class="c-link u-link">本を追加する</a>
                @if (count($books) > 0)
                    @foreach ($books as $book)
                        <ul class="c-lists">
                            <li class="c-list">
                                <div class="c-list_bookImgWrapper">
                                    @if(preg_match("/^.\/img\/default_books\/book_/", $book->book_img))
                                        <img src="{{ substr($book->book_img, 1) }}" alt="" class="c-list_bookImg">
                                    @elseif(preg_match("/^http:\/\//", $book->book_img))
                                        <img src="{{ $book->book_img }}" alt="" class="c-list_bookImg">
                                    @else
                                        <img src="data:image/png;base64,{{ $book->book_img }}" alt="" class="c-list_bookImg">
                                    @endif
                                </div>
                            </li>
                            <li class="c-list c-list_bookName u-list_bookName">{{ $book->book_name }}</li>
                            <li class="c-list">
                                <form action="{{ url('private/detail/' . $book->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <button type="submit" class="c-btn_small u-btn_small">
                                        <i class="fa fa-search" aria-hidden="true"></i> 本の詳細
                                    </button>
                                </form>
                            </li>
                            <li class="c-list">
                                <form action="{{ url('private/books/edit/' . $book->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <button type="submit" class="c-btn_small">
                                        <i class="fa fa-pencil" aria-hidden="true"></i> 本の編集
                                    </button>
                                </form>
                            </li>
                        </ul>
                    @endforeach
                @else
                    <div class="c-center">書籍はまだ登録されていません。</div>
                @endif
            </div>
            <div class="c-paginate u-paginate">
                {{ $books->links()}}
            </div>
        </div>
    </div>
@endsection