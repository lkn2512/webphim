<div class="row">
    <div class="title-section">
        <div class="title-left col-lg-5 col-md-9 col-sm-4 col-5">
            <span class="title-text">Top lượt xem</span>
        </div>
        <div class="title-right col-lg-7 col-md-3 col-sm-8 col-7">
            <span class="content">

            </span>
        </div>
    </div>
</div>
<div class="rank-container">
    @foreach ($top_view as $value)
        @if ($value->views_sum_view_count > 0)
            <div class="row rank-item">
                <div class="col-3 col-lg-3 col-md-5">
                    <img class="img-fluid" src="{{ asset('uploads/movies/' . $value->image) }}" alt="{{ $value->title }}"
                        title="{{ $value->title }}">
                </div>
                <div class="col-9 col-lg-8 col-md-7">
                    <h5 class="title">{{ $value->title }}</h5>
                    <span class="sub-title">{{ $value->sub_title }}</span>
                    <span class="view">
                        <i class="fa-regular fa-eye"></i>
                        {{ number_format($value->views_sum_view_count) }} lượt xem <!-- Sửa đổi để sử dụng biến đúng -->
                    </span>
                </div>
            </div>
        @endif
    @endforeach

</div>
