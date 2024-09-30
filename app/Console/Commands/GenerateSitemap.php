<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Khởi tạo sitemap
        $sitemap = Sitemap::create();

        // Thêm URL tĩnh cho trang chủ
        $sitemap->add(Url::create(route('trang-chu'))->setPriority(1.0)->setChangeFrequency('daily'));

        // Thêm các category - danh mục vào sitemap
        $category = Category::whereHas('movies', function ($query) {
            $query->where('status', 1);
        })->orderBy('title')->get();
        foreach ($category as $cate) {
            $url = url('danh-muc/' . $cate->slug);
            $sitemap->add(
                Url::create($url)
                    ->setLastModificationDate(now())
                    ->setChangeFrequency('daily')
                    ->setPriority(0.7)
            );
        }
        // Thêm các genre - thể loại vào sitemap
        $genre = Genre::whereHas('movies', function ($query) {
            $query->where('status', 1);
        })->orderBy('title')->get();
        foreach ($genre as $gen) {
            $url = url('the-loai/' . $gen->slug);
            $sitemap->add(
                Url::create($url)
                    ->setLastModificationDate(now())
                    ->setChangeFrequency('daily')
                    ->setPriority(0.7)
            );
        }
        // Thêm các country - quốc gia vào sitemap
        $country = Country::whereHas('movies', function ($query) {
            $query->where('status', 1);
        })->orderBy('title')->get();
        foreach ($country as $con) {
            $url = url('quoc-gia/' . $con->slug);
            $sitemap->add(
                Url::create($url)
                    ->setLastModificationDate(now())
                    ->setChangeFrequency('daily')
                    ->setPriority(0.7)
            );
        }
        // Thêm các movie_detail - chi tiết phim vào sitemap
        $movie_detail = Movie::with(['categories', 'genres', 'countries', 'episodes'])->where('status', 1)->get();
        foreach ($movie_detail as $movie) {
            $url = url('phim/' . $movie->slug);
            $sitemap->add(
                Url::create($url)
                    ->setLastModificationDate(now())
                    ->setChangeFrequency('daily')
                    ->setPriority(0.7)
            );
        }
        // Thêm các episode_movie - tập phim vào sitemap
        $episode_movie = Movie::with(['categories', 'genres', 'countries', 'episodes'])->where('status', 1)->get();
        foreach ($episode_movie as $movie) {
            $movieSlug = $movie->slug;
            // Lặp qua các tập phim của từng bộ phim
            foreach ($movie->episodes as $episode) {
                $url = route('xem-phim', ['slug' => $movieSlug, 'tap' => $episode->episode_number]);
                $sitemap->add(
                    Url::create($url)
                        ->setLastModificationDate(now())
                        ->setChangeFrequency('daily')
                        ->setPriority(0.7)
                );
            }
        }

        // Thêm URL tĩnh lọc phim vào sitemap
        $sitemap->add(Url::create('loc-phim')->setPriority(1.0)->setChangeFrequency('daily'));

        // Lưu sitemap
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully!');
    }
}
