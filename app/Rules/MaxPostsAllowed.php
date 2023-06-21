<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use App\Models\Post;

class MaxPostsAllowed implements Rule
{
    public function passes($attribute, $value)
    {
        $userId = auth()->user()->id;
        $maxPostsAllowed = 3;

        $postCount = Post::where('user_id', $userId)->count();

        return $postCount < $maxPostsAllowed;
    }

    public function message()
    {
        return 'You have exceeded the maximum number of allowed posts.';
    }
}
