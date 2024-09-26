<div class="row">
    <div class="title-section">
        <div class="title-left col-lg-5 col-md-9 col-sm-4 col-5">
            <span class="title-text">Bảng xếp hạng</span>
        </div>
        <div class="title-right col-lg-7 col-md-3 col-sm-8 col-7">
            <span class="content">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="day-tab" data-bs-toggle="pill" data-bs-target="#day"
                            type="button" role="tab" aria-controls="day" aria-selected="true">
                            <span class="button-text">Ngày</span></button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="week-tab" data-bs-toggle="pill" data-bs-target="#week"
                            type="button" role="tab" aria-controls="week" aria-selected="false"><span
                                class="button-text">Tuần</span></button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="month-tab" data-bs-toggle="pill" data-bs-target="#month"
                            type="button" role="tab" aria-controls="month" aria-selected="false"><span
                                class="button-text">Tháng</span></button>
                    </li>
                </ul>
            </span>
        </div>
    </div>
</div>
<div class="rank-container">
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="day" role="tabpanel" aria-labelledby="day-tab" tabindex="0">
            @foreach ($rankings_day as $rank_day)
                @if ($rank_day->total_views > 0)
                    <div class="row rank-item">
                        <div class="col-3 col-lg-3 col-md-5">
                            <img class="img-fluid" src="{{ asset('uploads/movies/' . $rank_day->image) }}"
                                alt="{{ $rank_day->title }}" title="{{ $rank_day->title }}">
                        </div>
                        <div class="col-9 col-lg-8 col-md-7">
                            <h5 class="title">{{ $rank_day->title }}</h5>
                            <span class="sub-title">{{ $rank_day->sub_title }}</span>
                            <span class="view">
                                <i class="fa-regular fa-eye"></i>
                                {{ number_format($rank_day->total_views) }} lượt xem
                            </span>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="tab-pane fade" id="week" role="tabpanel" aria-labelledby="week-tab" tabindex="0">
            @foreach ($rankings_week as $rank_week)
                @if ($rank_week->total_views > 0)
                    <div class="row rank-item">
                        <div class="col-3 col-lg-3 col-md-5">
                            <img class="img-fluid" src="{{ asset('uploads/movies/' . $rank_week->image) }}"
                                alt="{{ $rank_week->title }}" title="{{ $rank_week->title }}">
                        </div>
                        <div class="col-9 col-lg-8 col-md-7">
                            <h5 class="title">{{ $rank_week->title }}</h5>
                            <span class="sub-title">{{ $rank_week->sub_title }}</span>
                            <span class="view">
                                <i class="fa-regular fa-eye"></i>
                                {{ number_format($rank_week->total_views) }} lượt xem
                            </span>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="tab-pane fade" id="month" role="tabpanel" aria-labelledby="month-tab" tabindex="0">
            @foreach ($rankings_month as $rank_mont)
                @if ($rank_mont->total_views > 0)
                    <div class="row rank-item">
                        <div class="col-3 col-lg-3 col-md-5">
                            <img class="img-fluid" src="{{ asset('uploads/movies/' . $rank_mont->image) }}"
                                alt="{{ $rank_mont->title }}" title="{{ $rank_mont->title }}">
                        </div>
                        <div class="col-9 col-lg-8 col-md-7">
                            <h5 class="title">{{ $rank_mont->title }}</h5>
                            <span class="sub-title">{{ $rank_mont->sub_title }}</span>
                            <span class="view">
                                <i class="fa-regular fa-eye"></i>
                                {{ number_format($rank_mont->total_views) }} lượt xem
                            </span>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
