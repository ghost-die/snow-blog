<div class="card">
    <div class="card-body p-5">
        <div class="clearfix">
            <a href="{{ $item['web_site'] }}">
                <img style="width: 50px;" class="float-left" src="{{ $item['avatar'] }}">
            </a>
            <div class="ml-3 float-left">
                <h6>{{ $item['name'] }}</h6>
                <span class="font-weight-light">{{ $item['created_at'] }}</span>
            </div>

            <div class="ml-3 float-right">
                <button class="btn border-none Reply" data-id="{{ $item['id'] }}">回复</button>
            </div>
        </div>
        <div class="mt-3 font-weight-light">
            {{ $item['content']}}
        </div>
    </div>
</div>