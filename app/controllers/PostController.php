<?php

class PostController extends BaseController
{

    /* get functions */
    public function listPost()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        $this->layout->title = '文章列表';
        $this->layout->main = View::make('dash')->nest('content', 'posts.list', compact('posts'));
    }

    public function showPost(Post $post)
    {
        $comments = $post->comments()->where('approved', '=', 1)->get();
        $this->layout->title = $post->title;
        $this->layout->main = View::make('home')->nest('content', 'posts.single', compact('post', 'comments'));

        View::composer('sidebar', function($view)
        {
            $view->recentPosts = Post::orderBy('id','desc')->take(5)->get();
        });
    }

    public function newPost()
    {
        $this->layout->title = '创建文章';
        $this->layout->main = View::make('dash')->nest('content', 'posts.new');
    }

    public function editPost(Post $post)
    {
        $this->layout->title = '编辑文章';
        $this->layout->main = View::make('dash')->nest('content', 'posts.edit', compact('post'));
    }

    public function deletePost(Post $post)
    {
        $post->delete();
        return Redirect::route('post.list')->with('success', '文章删除成功!');
    }

    /* post functions */
    public function savePost()
    {
        $post = [
            'title' => Input::get('title'),
            'content' => Input::get('content'),
        ];
        $rules = [
            'title' => 'required',
            'content' => 'required',
        ];
        $valid = Validator::make($post, $rules);
        if ($valid->passes()) {
            $post = new Post($post);
            $post->comment_count = 0;
            $post->read_more = (strlen($post->content) > 120) ? substr($post->content, 0, 120) : $post->content;
            $post->save();
            return Redirect::to('admin/dash-board')->with('success', '文章保存成功!');
        } else
            return Redirect::back()->withErrors($valid)->withInput();
    }

    public function updatePost(Post $post)
    {
        $data = [
            'title' => Input::get('title'),
            'content' => Input::get('content'),
        ];
        $rules = [
            'title' => 'required',
            'content' => 'required',
        ];
        $valid = Validator::make($data, $rules);
        if ($valid->passes()) {
            $post->title = $data['title'];
            $post->content = $data['content'];
            $post->read_more = (strlen($post->content) > 120) ? substr($post->content, 0, 120) : $post->content;
            if (count($post->getDirty()) > 0) /* avoiding resubmission of same content */ {
                $post->save();
                return Redirect::back()->with('success', '文章更新成功!');
            } else
                return Redirect::back()->with('success', '文章没有变动!');
        } else
            return Redirect::back()->withErrors($valid)->withInput();
    }

}
