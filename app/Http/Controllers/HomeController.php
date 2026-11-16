<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use App\Models\Coupon;
use App\Models\User;
use App\Models\language;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $lang = null)
    {
        $languageCode = $lang ?? 'en';
        app()->setLocale($languageCode);

        $language = language::where('code', $languageCode)->firstOr(function () {
            abort(404, 'Language not found');
        });

        // Existing
        $latestblogs = Blog::orderBy('created_at', 'desc')
            ->where('language_id', $language->id)->take(6)->get();

        $topblogs = Blog::where('top_blog', 1)
            ->where('language_id', $language->id)->take(5)->get();

        $fashionBlogs = Blog::whereHas('category', fn($q) => $q->where('slug', 'fashion'))
            ->where('language_id', $language->id)->latest()->take(6)->get();

        $GiftBlogs = Blog::whereHas('category', fn($q) => $q->where('slug', 'gifts and flowers'))
            ->where('language_id', $language->id)->latest()->take(6)->get();

        $TopStores = Store::where('top_store', 1)
            ->where('language_id', $language->id)->get();

        $sliders = Slider::with('store')
            ->where('language_id', $language->id)
            ->orderBy('sort_order', 'asc')
            ->get();

        // ─── NEW: real stats ────────────────────────────────
        $activeStoresCount    = Store::where('language_id', $language->id)->count();
        $verifiedCouponsCount = Coupon::where('language_id', $language->id)->where('status', 1)->count();
        $totalBlogsCount      = Blog::where('language_id', $language->id)->count();
        $totalUsersCount      = User::count();

        // ─── NEW: categories ────────────────────────────────
        $categories = Category::orderBy('name')->take(10)->get();

        // ─── NEW: real top coupons ──────────────────────────
        $topCoupons = Coupon::with('store')
            ->where('language_id', $language->id)
            ->wherenotNull('code')
            ->where('status', 1)
            ->orderByDesc('created_at')
            ->take(6)->get();   

        return view('welcome', compact(
            'latestblogs', 'topblogs', 'fashionBlogs', 'GiftBlogs',
            'TopStores', 'sliders',
            'activeStoresCount', 'verifiedCouponsCount', 'totalBlogsCount', 'totalUsersCount',
            'categories', 'topCoupons'
        ));
    }

    public function stores(Request $request , $lang = 'en')
    {
        app()->setLocale($lang);
        $language = language::where('code', $lang)->first();
        if (!$language) {
            abort(404, 'Language not found');
        }
        $letter = $request->get('letter', 'all');
        $query = Store::withCount('coupons')
                        ->where('language_id', $language->id)
                        ->orderBy('name');

        if ($letter && $letter !== 'all') {
            if ($letter === '#') {
                $query->whereRaw("LOWER(SUBSTRING(name, 1, 1)) NOT REGEXP '^[a-z]'");
            } else {
                $query->where('name', 'LIKE', $letter . '%');
            }
        }
        
        if ($letter === 'all') {
            $allStores = $query->get();
            
            $stores = $query->paginate(40);
            
            $storesByLetter = [];
            $totalStoresCount = $allStores->count();
            
            foreach ($allStores as $store) {
                $firstChar = strtoupper(substr($store->name, 0, 1));
                $letterKey = preg_match('/[A-Z]/', $firstChar) ? $firstChar : '#';
                
                if (!isset($storesByLetter[$letterKey])) {
                    $storesByLetter[$letterKey] = [];
                }
                
                $storesByLetter[$letterKey][] = $store;
            }
            ksort($storesByLetter);
            
            return view('front-end.stores', compact('stores', 'storesByLetter', 'letter', 'totalStoresCount'));
        }

        $stores = $query->paginate(40);
        $storesByLetter = null; 
        
        return view('front-end.stores', compact('stores', 'storesByLetter', 'letter'));
    }


    public function StoreDetails($lang = 'en', $slug, Request $request)
    {
        // Set the app locale to the provided language or default to 'en'
        app()->setLocale($lang);

        // Slug is already stored like "hello-world" — use it directly
        $store = Store::with('language')->where('slug', $slug)->first();

        if (!$store) {
            abort(404); // Store not found
        }

        // Check if the store has an associated language
        if (!$store->language) {
            return response()->json(['error' => 'No language select for this store.'], 404);
        }

        if ($lang !== $store->language->code) {
            return redirect()->route('store_details.withLang', [
                'lang' => $store->language->code,
                'slug' => $slug
            ]);
        }

        // Sorting and fetching coupons
        $sort = $request->query('sort', 'all');
        if ($sort === 'codes') {
            $coupons = Coupon::where('store_id', $store->id)
                            ->whereNotNull('code')
                            ->orderByRaw('CAST(`order` AS SIGNED) ASC')
                            ->where('language_id', $store->language_id)
                            ->get();
        } elseif ($sort === 'deals') {
            $coupons = Coupon::where('store_id', $store->id)
                            ->whereNull('code')
                            ->orderByRaw('CAST(`order` AS SIGNED) ASC')
                            ->where('language_id', $store->language_id)
                            ->get();
        } elseif ($sort === 'latest') {
            $coupons = Coupon::where('store_id', $store->id)
                            ->orderByDesc('created_at')
                            ->orderByRaw('CAST(`order` AS SIGNED) ASC')
                            ->where('language_id', $store->language_id)
                            ->get();
        } elseif ($sort === 'popular') {
            $coupons = Coupon::where('store_id', $store->id)
                            ->orderByRaw("CASE WHEN authentication = 'featured' THEN 1 ELSE 2 END")
                            ->orderByRaw('CAST(`order` AS SIGNED) ASC')
                            ->where('language_id', $store->language_id)
                            ->get();
        } elseif ($sort === 'expiring') {
            $coupons = Coupon::where('store_id', $store->id)
                            ->where('language_id', $store->language_id)
                            ->orderByRaw("CASE WHEN ending_date >= NOW() THEN 0 ELSE 1 END")
                            ->orderBy('ending_date', 'asc')
                            ->get();
        } else {
            $coupons = Coupon::where('store_id', $store->id)
                            ->orderByRaw('CAST(`order` AS SIGNED) ASC')
                            ->get();
        }

        // Count the number of codes and deals
        $codeCount = Coupon::where('store_id', $store->id)
                            ->whereNotNull('code')
                            ->where('language_id', $store->language_id)
                            ->count();
        $dealCount = Coupon::where('store_id', $store->id)
                            ->whereNull('code')
                            ->where('language_id', $store->language_id)
                            ->count();

        // Fetch related stores based on the same category
        $relatedStores = Store::where('category_id', $store->category_id)
                    ->where('id', '!=', $store->id)
                    ->where('language_id', $store->language_id)
                    ->orderBy('created_at', 'desc')
                    ->take(12)
                    ->get();

        // Fetch related blogs based on the same store
        $relatedblogs = Blog::where('store_id', $store->id)
            ->where('language_id', $store->language_id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('front-end.store_detail', compact('store', 'coupons', 'relatedStores', 'relatedblogs', 'codeCount', 'dealCount'));
    }
    public function category($lang = 'en')
    {
        app()->setLocale($lang);

        // Fetch the language, or default to English
        $language = language::where('code', $lang)->firstOr(function () {
            abort(404, 'Language not found');
        });

        // Filter categories by language_id
        $categories = Category::all();

        return view('front-end.category', compact('categories'));
    }


    public function category_detail($slug, Request $request)
    {
        // Slug is already stored like "hello-world" — use it directly
        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            abort(404, 'Category not found');
        }

        $relatedblogs = Blog::where('category_id', $category->id)
                 ->where('status', 1)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        $stores = Store::where('category_id', $category->id)
        ->get();

        return view('front-end.category_detail', compact('category', 'relatedblogs', 'stores'));
    }


    public function blog(Request $request, $lang = 'en')
    {
        app()->setLocale($lang);

        // Fetch the language
        $language = Language::where('code', $lang)->firstOr(function () {
            abort(404, 'Language not found');
        });

        // Base query
        $query = Blog::with(['language', 'category'])
            ->where('language_id', $language->id);

        // Handle Category Filter
        $activeCategory = $request->query('category', 'all');
        
        if ($activeCategory !== 'all') {
            $query->whereHas('category', function($q) use ($activeCategory) {
                $q->where('slug', $activeCategory);
            });
        }

        // Paginate results
        $blogs = $query->orderBy('created_at', 'desc')->paginate(12)->withQueryString();

        // ─── AJAX RESPONSE ─────────────────────────────────
        if ($request->ajax()) {
            return response()->json([
                'html' => view('front-end.partials.blogs_list', compact('blogs'))->render()
            ]);
        }
        // ───────────────────────────────────────────────────

        // Fetch all categories for the filter pills (with counts)
        $categories = Category::withCount(['blogs' => function($q) use ($language) {
            $q->where('language_id', $language->id);
        }])->get();

        // Get total blogs for the "All" pill
        $totalBlogs = Blog::where('language_id', $language->id)->count();

        // Get the top 5 trending blogs
        $trendingBlogs = Blog::with('category')
            ->where('language_id', $language->id)
            ->where('top_blog', 1)
            ->take(5)
            ->get();

        return view('front-end.blog', compact('blogs', 'categories', 'totalBlogs', 'activeCategory', 'trendingBlogs'));
    }


    public function blog_detail($lang = 'en', $slug, Request $request)
    {
        app()->setLocale($lang);
        $language = language::where('code', $lang)->firstOr(function () {
            abort(404, 'Language not found');
        });

        // Slug is already stored like "hello-world" — use it directly
        $blog = Blog::with('language')->where('slug', $slug)->first();

        if (!$blog) {
            abort(404, 'Blog not found');
        }

        if (!$blog->language) {
            return response()->json(['error' => 'No language select for this store.'], 404);
        }
        if ($lang !== $blog->language->code) {
            return redirect()->route('blog-details.withLang', [
                'lang' => $blog->language->code,
                'slug' => $slug
            ]);
        }
        $relatedBlogs = Blog::where('category_id', $blog->category_id)
                ->where('id', '!=', $blog->id)
                ->where('language_id', $language->id)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        $relatedstores = Store::where('id', $blog->store_id)
        ->where('language_id', $blog->language_id)->get();

        return view('front-end.blog_detail', compact('blog', 'relatedBlogs', 'relatedstores'));
    }

    public function coupons($lang = 'en')
    {
        app()->setLocale($lang);

        // Fetch the language, or default to English
        $language = language::where('code', $lang)->firstOr(function () {
            abort(404, 'Language not found');
        });

        // Filter blogs by language_id and status
            $coupons = Coupon::with(['language', 'stores'])
                ->where('language_id', $language->id)
                ->whereNotNull('code')
                ->where('status', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return view('front-end.coupon', compact('coupons'));
    }

    public function deal($lang = 'en')
    {
        app()->setLocale($lang);

        // Fetch the language, or default to English
        $language = language::where('code', $lang)->firstOr(function () {
            abort(404, 'Language not found');
        });

        // Filter blogs by language_id and status
        $coupons = Coupon::with('language')
            ->where('language_id', $language->id)
            ->orderBy('created_at', 'desc')
            ->whereNull('code')
            ->paginate(10);

            return view('front-end.deal', compact('coupons'));
    }

     public function coupon_detail($slug, $lang = 'en')
    {
        app()->setLocale($lang);

        // Fetch the language, or default to English
        $language = language::where('code', $lang)->firstOr(function () {
            abort(404, 'Language not found');
        });

        // Fetch the blog by slug and language_id
        $coupon = Coupon::with('language')
            ->where('slug', $slug)
            ->where('language_id', $language->id)
            ->firstOr(function () {
                abort(404, 'Blog not found');
            });
        $relatedcoupon = Blog::where('store_id', $coupon->store_id)
            ->where('id', '!=', $coupon->id)
            ->where('language_id', $language->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        return view('front-end.coupon_detail', compact('coupon', 'relatedcoupon'));
    }

}