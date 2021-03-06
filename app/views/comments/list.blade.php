<h2 class="comment-listings">回复列表</h2><hr>
<table>
    <thead>
    <tr>
        <th>评论者</th>
        <th>邮箱</th>
        <th>主题</th>
        <th>通过</th>
        <th>删除</th>
        <th>查看</th>
    </tr>
    </thead>
    <tbody>
    @foreach($comments as $comment)
    <tr>
        <td>{{{$comment->commenter}}}</td>
        <td>{{{$comment->email}}}</td>
        <td>{{$comment->post->title}}</td>
        <td>
            {{Form::open(['route'=>['comment.update',$comment->id]])}}
            {{Form::select('status',['yes'=>'是','no'=>'否'],$comment->approved,['style'=>'margin-bottom:0','onchange'=>'submit()'])}}
            {{Form::close()}}
        </td>
        <td>{{HTML::linkRoute('comment.delete','DEL',$comment->id)}}</td>
        <td>{{HTML::linkRoute('comment.show','VIEW',$comment->id,['data-reveal-id'=>'comment-show','data-reveal-ajax'=>'true'])}}</td>
    </tr>
    @endforeach
    </tbody>
</table>
{{$comments->links()}}
