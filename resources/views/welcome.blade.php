@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="post" action="http://up.qiniu.com" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input name="token" type="hidden" value="mijF4b4RyNFmYOzlKMdeyhgfUMAVcs00jLbmDGec:ZDPBBA8A5b9o-X8V99P94-SvewM=:eyJzY29wZSI6ImludGVsbGlnZW50LXZpZGVvLXJldHJpZXZhbC1zeXN0ZW0iLCJkZWFkbGluZSI6MTQ5MzEzNzY0MSwidXBIb3N0cyI6WyJodHRwOlwvXC91cC5xaW5pdS5jb20iLCJodHRwOlwvXC91cGxvYWQucWluaXUuY29tIiwiLUggdXAucWluaXUuY29tIGh0dHA6XC9cLzE4My4xMzYuMTM5LjE2Il19">
            <input name="file" type="file" />
            <input type="submit" value="上传"/>
        </form>
    </div>
@endsection
