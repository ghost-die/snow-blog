<rss version="2.0"
     xmlns:atom="http://www.w3.org/2005/Atom"
     xmlns:content="http://purl.org/rss/1.0/modules/content/"
     xmlns:wfw="http://wellformedweb.org/CommentAPI/"
     xmlns:dc="http://purl.org/dc/elements/1.1/"
     xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
     xmlns:slash="http://purl.org/rss/1.0/modules/slash/"

>
    <channel>
        <title>{{ config('app.name', 'Laravel')  }}</title>
        <description>{{ $description ?? 'Description' }}</description>
        <link>{{ url('/') }}</link>

        <atom:link href="{{ route('feed') }}" rel="self" type="application/rss+xml"/>


        <lastBuildDate> {{ !empty($data) ? $data[0]->updated_at->toRfc2822String() : \Carbon\Carbon::now()->toRfc2822String() }} </lastBuildDate>

        <language>{{ str_replace('_', '-', app()->getLocale()) }}</language>

        <sy:updatePeriod>
            hourly	</sy:updatePeriod>
        <sy:updateFrequency>
            1	</sy:updateFrequency>

        <generator>{{config('app.name', 'Laravel')}}</generator>

        @foreach ($data as $article)
            <item>
                <title>{{ $article->title }}</title>
                <link>{{ route('article.index',['article'=>$article->id]) }}</link>
                <content>{{ $article->content }}</content>
                <pubDate>{{ \Illuminate\Support\Carbon::parse( $article->getRawOriginal('created_at'))->toRfc2822String() }}</pubDate>

                <author>{{ $article->user->email }} ({{$article->user->name}})</author>


                <guid>{{ route('article.index',['article'=>$article->id]) }}</guid>
                <category>{{ $article->category->name }}</category>
            </item>
        @endforeach
    </channel>
</rss>
