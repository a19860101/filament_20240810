<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
    <h1 class="text-4xl font-bold text-center mb-5">My Website</h1>
    <hr class="mb-5">
    <div class="w-2/3 mx-auto mb-24">
        <div>
            <h2 class="text-3xl font-bold mb-5">{{$post->title}}</h2>

            <div>
                <small>
                    文章建立時間：{{$post->created_at}}
                </small>
            </div>
            <div class="aspect-video w-full max-h-[400px] bg-zinc-200 mb-5">
                <img src="/images/{{$post->cover}}" alt="" class="w-full h-full object-cover">
            </div>
            <div>
                {!!$post->content!!}
            </div>
            <div class="my-3">
                <a href="{{route('post.index')}}" class="px-8 py-2 bg-amber-300 rounded">文章列表</a>

            </div>
        </div>
    </div>
</body>
</html>