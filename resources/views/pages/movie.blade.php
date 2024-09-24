@extends('layout')
@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb" class="breadcrumb-container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('trang-chu') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a>Phim</a></li>
            <li class="breadcrumb-item" aria-current="page"> {{ $movie_detail->title }}</li>
        </ol>
    </nav>
    <div class="row mt-4">
        <div class="col-lg-8 col-md-12 col-sm-12 col-12 mb-3">
            <div class="row">
                <div class="col-lg-4 col-md-5 col-sm-6 col-12 text-center mb-3">
                    <div class="img-container">
                        <img class="img-fluid" src="{{ asset('uploads/movies/' . $movie_detail->image) }}"
                            alt="{{ $movie_detail->title }}" title="{{ $movie_detail->title }}">
                        <a href="" class="view-movie"><i class="fa-solid fa-play"></i>&ensp;Xem phim</a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7 col-sm-6 col-12  mb-3">
                    <div class="detailMovie-container">
                        <h5 class="name">{{ $movie_detail->title }}</h5>
                        <span class="sub-name">{{ $movie_detail->sub_title }}</span>
                        <span class="new-episode">Tập 16</span>
                        <span class="movie-category">
                            @foreach ($movie_detail->categories as $category)
                                {{ $category->title }}{{ !$loop->last ? ', ' : ' ' }}
                            @endforeach
                        </span>
                        <span class="movie-country">
                            @foreach ($movie_detail->countries as $coun)
                                {{ $coun->title }}{{ !$loop->last ? ', ' : '' }}
                            @endforeach
                        </span>
                        <span class="movie-genre">
                            @foreach ($movie_detail->genres as $gen)
                                {{ $gen->title }}{{ !$loop->last ? ', ' : '' }}
                            @endforeach
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- <h5>Nội dung phim</h5>
                <div>{!! $movie_detail->description !!}</div> --}}
                <!-- tabs -->
                <div class="pcss3t pcss3t-effect-scale pcss3t-theme-1">
                    <input type="radio" name="pcss3t" checked id="tab1"class="tab-content-first">
                    <label for="tab1">Nội dung phim</label>

                    <input type="radio" name="pcss3t" id="tab2" class="tab-content-2">
                    <label for="tab2">Tập phim</label>

                    {{-- <input type="radio" name="pcss3t" id="tab3" class="tab-content-3">
                    <label for="tab3"><i class="icon-cogs"></i>Phần</label> --}}

                    <input type="radio" name="pcss3t" id="tab5" class="tab-content-last">
                    <label for="tab5">phần khác</label>

                    <ul>
                        <li class="tab-content tab-content-first typography">
                            {!! $movie_detail->description !!}
                        </li>

                        <li class="tab-content tab-content-2 typography">
                            <h1>Leonardo da Vinci</h1>
                            <p>Italian Renaissance polymath: painter, sculptor, architect, musician, mathematician,
                                engineer, inventor, anatomist, geologist, cartographer, botanist, and writer. His genius,
                                perhaps more than that of any other figure, epitomized the Renaissance humanist ideal.
                                Leonardo has often been described as the archetype of the Renaissance Man, a man of
                                "unquenchable curiosity" and "feverishly inventive imagination". He is widely considered to
                                be one of the greatest painters of all time and perhaps the most diversely talented person
                                ever to have lived. According to art historian Helen Gardner, the scope and depth of his
                                interests were without precedent and "his mind and personality seem to us superhuman, the
                                man himself mysterious and remote". Marco Rosci states that while there is much speculation
                                about Leonardo, his vision of the world is essentially logical rather than mysterious, and
                                that the empirical methods he employed were unusual for his time.</p>
                            <p class="text-right"><em>Find out more about Leonardo da Vinci from <a href=""
                                        target="_blank">Wikipedia</a>.</em></p>
                        </li>

                        <li class="tab-content tab-content-3 typography">
                            <h1>Albert Einstein</h1>
                            <p>German-born theoretical physicist who developed the general theory of relativity, one of the
                                two pillars of modern physics (alongside quantum mechanics). While best known for his
                                mass–energy equivalence formula E = mc2 (which has been dubbed "the world's most famous
                                equation"), he received the 1921 Nobel Prize in Physics "for his services to theoretical
                                physics, and especially for his discovery of the law of the photoelectric effect". The
                                latter was pivotal in establishing quantum theory.</p>
                            <p>Near the beginning of his career, Einstein thought that Newtonian mechanics was no longer
                                enough to reconcile the laws of classical mechanics with the laws of the electromagnetic
                                field. This led to the development of his special theory of relativity. He realized,
                                however, that the principle of relativity could also be extended to gravitational fields,
                                and with his subsequent theory of gravitation in 1916, he published a paper on the general
                                theory of relativity.</p>
                            <p class="text-right"><em>Find out more about Albert Einstein from <a href=""
                                        target="_blank">Wikipedia</a>.</em></p>
                        </li>

                        <li class="tab-content tab-content-last typography">
                            <div class="typography">
                                <h1>Isaac Newton</h1>
                                <p>English physicist and mathematician who is widely regarded as one of the most influential
                                    scientists of all time and as a key figure in the scientific revolution. His book
                                    Philosophiæ Naturalis Principia Mathematica ("Mathematical Principles of Natural
                                    Philosophy"), first published in 1687, laid the foundations for most of classical
                                    mechanics. Newton also made seminal contributions to optics and shares credit with
                                    Gottfried Leibniz for the invention of the infinitesimal calculus.</p>
                                <p>Newton's Principia formulated the laws of motion and universal gravitation that dominated
                                    scientists' view of the physical universe for the next three centuries. It also
                                    demonstrated that the motion of objects on the Earth and that of celestial bodies could
                                    be described by the same principles. By deriving Kepler's laws of planetary motion from
                                    his mathematical description of gravity, Newton removed the last doubts about the
                                    validity of the heliocentric model of the cosmos.</p>
                                <p class="text-right"><em>Find out more about Isaac Newton from <a href=""
                                            target="_blank">Wikipedia</a>.</em></p>
                            </div>
                        </li>
                    </ul>
                </div>
                <!--/ tabs -->
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 col-12 mb-3">
            <div class="title-section row">
                <div class="title-left col-lg-5 col-md-9 col-sm-4 col-5">
                    <span class="title-text">Top lượt xem</span>
                </div>
                <div class="title-right col-lg-7 col-md-3 col-sm-8 col-7">
                    <span class="view-all"></span>
                </div>
            </div>
            <div class="rank-container">
                @foreach ($view_movie as $view)
                    <div class="row rank-item">
                        <div class="col-3 col-lg-3 col-md-5">
                            <img class="img-fluid" src="{{ asset('uploads/movies/' . $view->image) }}"
                                alt="{{ $view->title }}" title="{{ $view->title }}">
                        </div>
                        <div class="col-9 col-lg-8 col-md-7">
                            <h5 class="title">{{ $view->title }}</h5>
                            <span class="sub-title">{{ $view->sub_title }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
