<h2 class="post-listings">我的文章</h2><hr>
<table>
    <thead>
    <tr>
        <th width="300"> 标题</th>
        <th width="120"> 编辑</th>
        <th width="120"> 删除</th>
        <th width="120"> 查看</th>
    </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
            <tr>
                <td>{{$post->title}}</td>
                <td>{{HTML::linkRoute('post.edit','EDIT',$post->id)}}</td>
                <td>{{HTML::linkRoute('post.delete','DEL',$post->id)}}</td>
                <td>{{HTML::linkRoute('post.show','VIEW',$post->id,['target'=>'_blank'])}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
{{$posts->links()}}
