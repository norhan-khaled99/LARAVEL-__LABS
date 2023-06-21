{{--@extends('layouts.app')--}}

{{--@section('title')--}}
{{--@endsection--}}

{{--@section('content')--}}

{{--    <form id="search-form">--}}
{{--        <input type="text" id="search-input" placeholder="Search by title">--}}
{{--        <button type="submit">Search</button>--}}
{{--    </form>--}}
{{--    <div id="search-results"></div>--}}

{{--@foreach ($posts as $post)--}}
{{--    <h2>{{ $post->title }}</h2>--}}
{{--    <p>{{ $post->content }}</p>--}}
{{--@endforeach--}}


{{--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}

{{--<script>--}}

{{--    $(document).ready(function() {--}}
{{--        $('#search-form').submit(function(event) {--}}
{{--            event.preventDefault(); // Prevent the default form submission--}}

{{--            var searchQuery = $('#search-input').val(); // Get the search query from the input field--}}

{{--            // Make an AJAX request--}}
{{--            $.ajax({--}}
{{--                url: '/search', // The URL to the search route--}}
{{--                method: 'GET',--}}
{{--                data: { search: searchQuery }, // Pass the search query as a parameter--}}
{{--                success: function(response) {--}}
{{--                    var matchedPosts = response.filter(function(post) {--}}
{{--                        return post.title.toLowerCase().includes(searchQuery.toLowerCase());--}}
{{--                    });--}}

{{--                    if (matchedPosts.length > 0) {--}}
{{--                        var html = '';--}}
{{--                        matchedPosts.forEach(function(post) {--}}
{{--                            html += '<h2>' + post.title + '</h2>';--}}
{{--                        });--}}

{{--                        $('#search-results').html(html);--}}
{{--                    } else {--}}
{{--                        $('#search-results').html('<p>No matching posts found.</p>');--}}
{{--                    }--}}
{{--                },--}}
{{--                error: function(xhr) {--}}
{{--                    // Handle any errors--}}
{{--                    console.log(xhr.responseText);--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    });--}}

{{--</script>--}}



{{--@extends('layouts.app')--}}
{{--<form id="search-form">--}}
{{--    <input type="text" id="search-input" placeholder="Search by title">--}}
{{--    <button type="submit">Search</button>--}}
{{--</form>--}}

{{--<div id="search-results"></div>--}}

{{--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}

{{--<script>--}}
{{--    $(document).ready(function() {--}}
{{--        $('#search-form').submit(function(event) {--}}
{{--            event.preventDefault(); // Prevent the default form submission--}}

{{--            var searchQuery = $('#search-input').val();--}}

{{--            $.ajax({--}}
{{--                url: '/search',--}}
{{--                method: 'GET',--}}
{{--                data: { search: searchQuery },--}}
{{--                success: function(response) {--}}
{{--                    var html = '';--}}

{{--                    if (Array.isArray(response) && response.length > 0) {--}}
{{--                        response.forEach(function(post) {--}}
{{--                            html += '<h2>' + post.title + '</h2>';--}}
{{--                        });--}}
{{--                    } else {--}}
{{--                        html = '<p>No matching posts found.</p>';--}}
{{--                    }--}}

{{--                    $('#search-results').html(html);--}}
{{--                },--}}
{{--                error: function(xhr) {--}}
{{--                    console.log(xhr.responseText);--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}

<form id="searchForm">
    <input type="text" id="searchInput" name="search" placeholder="Search...">
    <button type="submit">Search</button>
</form>

<div id="searchResults">
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#searchForm').submit(function(event) {
            event.preventDefault();

            var searchQuery = $('#searchInput').val();

            $.ajax({
                url: '{{ route('post.search') }}',
                type: 'GET',
                data: {
                    search: searchQuery
                },
                success: function(response) {
                    var results = '';

                    if (response.length > 0) {
                        response.forEach(function(post) {
                            results += '<h3>' + post.title + '</h3>';
                            results += '<p>' + post.body + '</p>';
                        });
                    } else {
                        results = '<p>No results found.</p>';
                    }

                    $('#searchResults').html(results);
                }
            });
        });
    });
</script>


