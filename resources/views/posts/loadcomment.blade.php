<!-- LOADING OF COMMENTS -->
@forelse($usercomments as $comment)
    <hr class="bg-light">
        <label>{{$comment->username}} | {{$comment->created_at}}:</label>
        <p>{!! nl2br(e($comment->comment)) !!}</p>
    <hr class="bg-light"> 
@empty
    <p>NO COMMENTS! :(</p>    
@endforelse 