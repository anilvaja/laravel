<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Sidebar
        </div>

        <div class="card-body">
            <ul class="nav" role="tablist">
                <li role="presentation">
            @foreach ($menu_item as $item)
                    <a href="{{ url($item->url) }}">{{$item->title}} </a>
                <br/>
            @endforeach
                </li>
            </ul>
        </div>
    </div>
</div>
