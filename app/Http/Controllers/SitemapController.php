<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function index()
    {
        // Khởi tạo sitemap
        $sitemap = Sitemap::create();

        // Thêm các URL tĩnh
        $sitemap->add(Url::create(route('trang-chu'))->setPriority(1.0)->setChangeFrequency('daily'));

        // Lưu file sitemap
        $sitemap->writeToFile(public_path('sitemap.xml'));

        return response()->json('Sitemap created successfully!');
    }
}
