<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/***** ADMIN ****/


Route::group(['prefix' => 'hhadmin', 'namespace' => 'Admin', 'as' => 'admin::' ], function() {

    Route::get('/', [
        'as' => 'dashboard',
        'uses' => 'DashboardController@index',
    ]);
    Route::get('/removeCache', [
        'as' => 'removeCache',
        'uses' => 'DashboardController@removeCache',
    ]);

    /* Image Gallery Manager */

    Route::group([ 'prefix' => 'images', 'as' => 'images::', 'namespace' => 'Images', ], function() {

        Route::get('/', [

            'as' => 'list',
            'uses' => 'ImagesController@index',

        ]);

        Route::get('/create', [

            'as' => 'create',
            'uses' => 'ImagesController@create',

        ]);

        Route::get('/edit/{imageId}', [

            'as' => 'edit',
            'uses' => 'ImagesController@edit',

        ]);

        Route::post('/create', [

            'as' => 'store',
            'uses' => 'ImagesController@store',

        ]);

        Route::post('/update/{imageId}', [

            'as' => 'update',
            'uses' => 'ImagesController@update',

        ]);

        Route::get('/delete/{imageId}', [

            'as' => 'delete',
            'uses' => 'ImagesController@delete',

        ]);

    });

    /* Call Out Manager */

    Route::group([ 'prefix' => 'callouts', 'as' => 'callouts::', 'namespace' => 'Callouts', ], function() {

        Route::get('/', [

            'as' => 'list',
            'uses' => 'CalloutsController@index',

        ]);

        Route::get('/create', [

            'as' => 'create',
            'uses' => 'CalloutsController@create',

        ]);

        Route::get('/edit/{calloutId}', [

            'as' => 'edit',
            'uses' => 'CalloutsController@edit',

        ]);

        Route::post('/create', [

            'as' => 'store',
            'uses' => 'CalloutsController@store',

        ]);

        Route::post('/update/{calloutId}', [

            'as' => 'update',
            'uses' => 'CalloutsController@update',

        ]);

        Route::get('/delete/{calloutId}', [

            'as' => 'delete',
            'uses' => 'CalloutsController@delete',

        ]);

    });

    /* Blog Manager */

    Route::group([ 'prefix' => 'blog', 'as' => 'blog::', 'namespace' => 'Blog', ], function() {


        Route::group([ 'prefix' => 'posts', 'as' => 'posts::',  ], function() {

            Route::get('/', [

                'as' => 'list',
                'uses' => 'BlogPostController@index',

            ]);

            Route::get('/create', [

                'as' => 'create',
                'uses' => 'BlogPostController@create',

            ]);

            Route::get('/edit/{blogPostId}', [

                'as' => 'edit',
                'uses' => 'BlogPostController@edit',

            ]);

            Route::post('/create', [

                'as' => 'store',
                'uses' => 'BlogPostController@store',

            ]);

            Route::post('/update/{blogPostId}', [

                'as' => 'update',
                'uses' => 'BlogPostController@update',

            ]);

            Route::get('/delete/{blogPostId}', [

                'as' => 'delete',
                'uses' => 'BlogPostController@delete',

            ]);

        });

        Route::group([ 'prefix' => 'tags', 'as' => 'tags::',  ], function() {

            Route::get('/', [

                'as' => 'list',
                'uses' => 'BlogTopicController@index',

            ]);

            Route::get('/create', [

                'as' => 'create',
                'uses' => 'BlogTopicController@create',

            ]);

            Route::get('/edit/{blogTopicId}', [

                'as' => 'edit',
                'uses' => 'BlogTopicController@edit',

            ]);

            Route::post('/create', [

                'as' => 'store',
                'uses' => 'BlogTopicController@store',

            ]);

            Route::post('/update/{blogTopicId}', [

                'as' => 'update',
                'uses' => 'BlogTopicController@update',

            ]);

            Route::get('/delete/{blogTopicId}', [

                'as' => 'delete',
                'uses' => 'BlogTopicController@delete',

            ]);

        });

        Route::group(['prefix' => 'comments', 'as' => 'comments::',], function () {

            Route::get('/', [

                'as' => 'pending',
                'uses' => 'BlogCommentsController@pending',

            ]);

            Route::get('/edit/{commentId}', [
                'as' => 'edit',
                'uses' => 'BlogCommentsController@edit',
            ]);

            Route::post('/edit/{commentId}', [
                'as' => 'update',
                'uses' => 'BlogCommentsController@update',
            ]);

            Route::get('/approved', [
                'as' => 'approved',
                'uses' => 'BlogCommentsController@approved',
            ]);

            Route::get('/rejected', [
                'as' => 'rejected',
                'uses' => 'BlogCommentsController@rejected',
            ]);

            Route::get('/approve/{commentId}', [

                'as' => 'approve',
                'uses' => 'BlogCommentsController@approve',

            ]);

            Route::get('/reject/{commentId}', [

                'as' => 'reject',
                'uses' => 'BlogCommentsController@reject',

            ]);

            Route::get('/delete/{commentId}', [
                'as' => 'delete',
                'uses' => 'BlogCommentsController@delete',
            ]);

        });

    });

    /* Resources Manager */

    Route::group([ 'prefix' => 'resources', 'as' => 'resources::', 'namespace' => 'Resources', ], function() {

        Route::get('/', [

            'as' => 'list',
            'uses' => 'ResourcesController@index',

        ]);

        Route::get('/create', [

            'as' => 'create',
            'uses' => 'ResourcesController@create',

        ]);

        Route::get('/edit/{resourceId}', [

            'as' => 'edit',
            'uses' => 'ResourcesController@edit',

        ]);

        Route::post('/store', [

            'as' => 'store',
            'uses' => 'ResourcesController@store',

        ]);

        Route::post('/update/{resourceId}', [

            'as' => 'update',
            'uses' => 'ResourcesController@update',

        ]);

        Route::get('/delete/{resourceId}', [
            'as' => 'delete',
            'uses' => 'ResourcesController@delete',
        ]);


        Route::get('/ajaxSearch', [
            'as' => 'ajaxSearch',
            'uses' => 'ResourcesController@ajaxSearch',
        ]);

        Route::group([ 'prefix' => 'content', 'as' => 'content::', ], function() {



            Route::get('/{resourceId}', [

                'as' => 'list',
                'uses' => 'ContentSectionController@index',

            ]);

            Route::get('/create/{resourceId}', [

                'as' => 'create',
                'uses' => 'ContentSectionController@create',

            ]);

            Route::get('/edit/{contentSectionId}', [

                'as' => 'edit',
                'uses' => 'ContentSectionController@edit',

            ]);

            Route::post('/store/{resourceId}', [

                'as' => 'store',
                'uses' => 'ContentSectionController@store',

            ]);

            Route::post('/update/{contentSectionId}', [

                'as' => 'update',
                'uses' => 'ContentSectionController@update',

            ]);

            Route::get('/delete/{contentSectionId}', [
                'as' => 'delete',
                'uses' => 'ContentSectionController@delete',
            ]);

        });

    });

    /* Quotes Manager */

    Route::group([ 'prefix' => 'quotes', 'as' => 'quotes::', 'namespace' => 'Quotes', ], function() {

        Route::get('/', [

            'as' => 'list',
            'uses' => 'QuotesController@index',

        ]);

        Route::get('/create', [

            'as' => 'create',
            'uses' => 'QuotesController@create',

        ]);

        Route::get('/edit/{quoteId}', [

            'as' => 'edit',
            'uses' => 'QuotesController@edit',

        ]);

        Route::post('/create', [

            'as' => 'store',
            'uses' => 'QuotesController@store',

        ]);

        Route::post('/update/{quoteId}', [

            'as' => 'update',
            'uses' => 'QuotesController@update',

        ]);

        Route::get('/delete/{quoteId}', [
            'as' => 'delete',
            'uses' => 'QuotesController@delete',
        ]);

        Route::group([ 'prefix' => 'schedule', 'as' => 'schedule::', ], function() {

            Route::get('/', [
                'as' => 'list',
                'uses' => 'ScheduleController@schedule',
            ]);

            Route::get('/create', [
                'as' => 'create',
                'uses' => 'ScheduleController@create',
            ]);

            Route::post('/create', [
                'as' => 'store',
                'uses' => 'ScheduleController@store',
            ]);

            Route::get('/edit/{id}', [
                'as' => 'edit',
                'uses' => 'ScheduleController@edit',
            ]);

            Route::post('/update/{id}', [
                'as' => 'update',
                'uses' => 'ScheduleController@update',
            ]);

            Route::get('/delete/{id}', [
                'as' => 'delete',
                'uses' => 'ScheduleController@delete',
            ]);

        });

    });

    /* Scrapbook Manager */

    Route::group([ 'prefix' => 'scrapbook', 'as' => 'scrapbooks::', 'namespace' => 'Scrapbook', ], function() {

        Route::get('/', [

            'as' => 'list',
            'uses' => 'ScrapbookController@index',

        ]);

        Route::get('/create', [

            'as' => 'create',
            'uses' => 'ScrapbookController@create',

        ]);

        Route::get('/edit/{scrapbookId}', [

            'as' => 'edit',
            'uses' => 'ScrapbookController@edit',

        ]);

        Route::post('/create', [

            'as' => 'store',
            'uses' => 'ScrapbookController@store',

        ]);

        Route::post('/update/{scrapbookId}', [

            'as' => 'update',
            'uses' => 'ScrapbookController@update',

        ]);

        Route::get('/delete/{scrapbookId}', [
            'as' => 'delete',
            'uses' => 'ScrapbookController@delete',
        ]);

        Route::group([ 'prefix' => 'sections', 'as' => 'sections::', ], function() {

            Route::get('/{scrapbookId}', [

                'as' => 'list',
                'uses' => 'ScrapbookSectionsController@index',

            ]);

            Route::get('/create/{scrapbookId}', [

                'as' => 'create',
                'uses' => 'ScrapbookSectionsController@create',

            ]);

            Route::get('/edit/{imageId}', [

                'as' => 'edit',
                'uses' => 'ScrapbookSectionsController@edit',

            ]);

            Route::post('/create/{scrapbookId}', [

                'as' => 'store',
                'uses' => 'ScrapbookSectionsController@store',

            ]);

            Route::post('/update/{imageId}', [

                'as' => 'update',
                'uses' => 'ScrapbookSectionsController@update',

            ]);

            Route::get('/delete/{imageId}', [
                'as' => 'delete',
                'uses' => 'ScrapbookSectionsController@delete',
            ]);

            Route::group([ 'prefix' => 'gallery', 'as' => 'gallery::', ], function() {

                Route::get('/{scrapbookId}', [

                    'as' => 'list',
                    'uses' => 'ScrapbookSectionsGalleryController@index',

                ]);

                Route::get('/create/{scrapbookId}', [

                    'as' => 'create',
                    'uses' => 'ScrapbookSectionsGalleryController@create',

                ]);

                Route::get('/edit/{imageId}', [

                    'as' => 'edit',
                    'uses' => 'ScrapbookSectionsGalleryController@edit',

                ]);

                Route::post('/create/{scrapbookId}', [

                    'as' => 'store',
                    'uses' => 'ScrapbookSectionsGalleryController@store',

                ]);

                Route::post('/update/{imageId}', [

                    'as' => 'update',
                    'uses' => 'ScrapbookSectionsGalleryController@update',

                ]);

                Route::get('/delete/{imageId}', [
                    'as' => 'delete',
                    'uses' => 'ScrapbookSectionsGalleryController@delete',
                ]);

            });

        });


    });

    /* Videos Manager */

    Route::group([ 'prefix' => 'videos', 'as' => 'videos::', 'namespace' => 'Videos', ], function() {

        Route::get('/', [

            'as' => 'list',
            'uses' => 'VideosController@index',

        ]);

        Route::get('/create', [

            'as' => 'create',
            'uses' => 'VideosController@create',

        ]);

        Route::get('/edit/{videoId}', [

            'as' => 'edit',
            'uses' => 'VideosController@edit',

        ]);

        Route::post('/store', [

            'as' => 'store',
            'uses' => 'VideosController@store',

        ]);

        Route::post('/update/{videoId}', [

            'as' => 'update',
            'uses' => 'VideosController@update',

        ]);

        Route::get('/delete/{videoId}', [

            'as' => 'delete',
            'uses' => 'VideosController@delete',

        ]);

    });

    /* Products Manager */

    Route::group([ 'prefix' => 'products', 'as' => 'products::', 'namespace' => 'Products', ], function() {

        Route::get('/', [

            'as' => 'list',
            'uses' => 'ProductsController@index',

        ]);

        Route::get('/create', [

            'as' => 'create',
            'uses' => 'ProductsController@create',

        ]);

        Route::post('/create', [

            'as' => 'store',
            'uses' => 'ProductsController@store',

        ]);

        Route::get('/edit/{productId}', [

            'as' => 'edit',
            'uses' => 'ProductsController@edit',

        ]);

        Route::post('/update/{productId}', [
            'as' => 'update',
            'uses' => 'ProductsController@update',
        ]);

        Route::get('/delete/{productId}', [
            'as' => 'delete',
            'uses' => 'ProductsController@delete',
        ]);

        Route::group([ 'prefix' => 'content', 'as' => 'content::', ], function() {

            Route::get('/{productId}', [

                'as' => 'list',
                'uses' => 'ContentSectionController@index',

            ]);

            Route::get('/create/{productId}', [

                'as' => 'create',
                'uses' => 'ContentSectionController@create',

            ]);

            Route::get('/edit/{contentSectionId}', [

                'as' => 'edit',
                'uses' => 'ContentSectionController@edit',

            ]);

            Route::post('/store/{productId}', [

                'as' => 'store',
                'uses' => 'ContentSectionController@store',

            ]);

            Route::post('/update/{contentSectionId}', [

                'as' => 'update',
                'uses' => 'ContentSectionController@update',

            ]);

        });

        Route::group([ 'prefix' => 'categories', 'as' => 'categories::', ], function() {

            Route::get('/', [

                'as' => 'list',
                'uses' => 'CategoriesController@index',

            ]);

            Route::get('/create', [

                'as' => 'create',
                'uses' => 'CategoriesController@create',

            ]);

            Route::get('/edit/{categoryId}', [

                'as' => 'edit',
                'uses' => 'CategoriesController@edit',

            ]);

            Route::post('/create', [

                'as' => 'store',
                'uses' => 'CategoriesController@store',

            ]);

            Route::post('/edit/{categoryId}', [

                'as' => 'update',
                'uses' => 'CategoriesController@update',

            ]);

            Route::get('/delete/{categoryId}', [
                'as' => 'delete',
                'uses' => 'CategoriesController@delete',
            ]);

        });

    });

    /* Page Manager */

    Route::group([ 'prefix' => 'pages', 'as' => 'pages::', 'namespace' => 'Pages', ], function() {

        Route::get('/', [
            'as' => 'list',
            'uses' => 'PagesController@index',
        ]);

        Route::get('/create', [
            'as' => 'create',
            'uses' => 'PagesController@create',
        ]);

        Route::post('/create', [
            'as' => 'store',
            'uses' => 'PagesController@store',
        ]);

        Route::get('/edit/{pageId}', [
            'as' => 'edit',
            'uses' => 'PagesController@edit',
        ]);

        Route::post('/update/{pageId}', [
            'as' => 'update',
            'uses' => 'PagesController@update',
        ]);

        Route::get('/delete/{pageId}', [
            'as' => 'delete',
            'uses' => 'PagesController@delete',
        ]);

    });

    /* Carousel Manager */

    Route::group([ 'prefix' => 'carousels', 'as' => 'carousels::', 'namespace' => 'Carousels', ], function() {

        Route::get('/', [
            'as' => 'list',
            'uses' => 'CarouselsController@index',
        ]);

        Route::get('/create', [
            'as' => 'create',
            'uses' => 'CarouselsController@create',
        ]);

        Route::post('/create', [
            'as' => 'store',
            'uses' => 'CarouselsController@store',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'edit',
            'uses' => 'CarouselsController@edit',
        ]);

        Route::post('/update/{id}', [
            'as' => 'update',
            'uses' => 'CarouselsController@update',
        ]);

        Route::get('/delete/{id}', [
            'as' => 'delete',
            'uses' => 'CarouselsController@delete',
        ]);

        Route::group([ 'prefix' => 'slides', 'as' => 'slides::', ], function() {

            Route::get('/', [
                'as' => 'list',
                'uses' => 'CarouselSlidesController@index',
            ]);

            Route::get('/create', [
                'as' => 'create',
                'uses' => 'CarouselSlidesController@create',
            ]);

            Route::post('/create', [
                'as' => 'store',
                'uses' => 'CarouselSlidesController@store',
            ]);

            Route::get('/edit/{id}', [
                'as' => 'edit',
                'uses' => 'CarouselSlidesController@edit',
            ]);

            Route::post('/update/{id}', [
                'as' => 'update',
                'uses' => 'CarouselSlidesController@update',
            ]);

            Route::get('/delete/{id}', [
                'as' => 'delete',
                'uses' => 'CarouselSlidesController@delete',
            ]);

        });

    });


});

/***** PUBLIC ****/

Route::group([ 'namespace' => 'Guest', 'as' => 'guest::', ], function() {

    Route::get('/', [
        'as' => 'welcome',
        'uses' => 'HomepageController@index'
    ]);

    Route::get('/login', [
        'as' => 'login',
        'uses' => 'HomepageController@login',
    ]);

    Route::get('/terms', [
        'as' => 'terms',
        'uses' => 'HomepageController@terms',
    ]);
    Route::get('/sitemap', [
        'as' => 'sitemap',
        'uses' => 'HomepageController@sitemap',
    ]);

    Route::group([ 'prefix' => 'subscribe', 'as' => 'subscribe::', ], function() {

        Route::post('/videoSeries', [
            'as' => 'list',
            'uses' => 'AjaxSubscribeController@videoSeriesSubscribe',
        ]);
    });

    Route::group([ 'prefix' => 'quote', 'as' => 'quotes::', ], function() {

        Route::get('/', [
            'as' => 'list',
            'uses' => 'QuoteController@index',
        ]);

        Route::get('/{date}', [
            'as' => 'date',
            'uses' => 'QuoteController@quoteDay',
        ]);

    });

    Route::group([ 'prefix' => 'resources', 'as' => 'resources::', ], function() {

        Route::get('/', [
            'as' => 'list',
            'uses' => 'ResourceController@index',
        ]);

        Route::get('/search', [
            'as' => 'search',
            'uses' => 'ResourceController@search',
        ]);

        Route::get('/{slug}', [
            'as' => 'details',
            'uses' => 'ResourceController@details',
        ]);

    });

    Route::group([ 'prefix' => 'products', 'as' => 'products::', ], function() {

        Route::get('/', [
            'as' => 'list',
            'uses' => 'ProductsController@index',
        ]);

        Route::get('/{slug}', [
            'as' => 'details',
            'uses' => 'ProductsController@details',
        ]);

    });

    Route::group([ 'prefix' => 'blog', 'as' => 'blog::', ], function() {

        Route::get('/', [
            'as' => 'list',
            'uses' => 'BlogController@index',
        ]);

        Route::get('/{slug}', [
            'as' => 'details',
            'uses' => 'BlogController@details',
        ]);

        Route::post('/{slug}', [
            'as' => 'details',
            'uses' => 'BlogController@postComment',
        ]);

        Route::get('/tag/{tag}', [
            'as' => 'tag',
            'uses' => 'BlogController@tagPosts',
        ]);

    });

    Route::group([ 'prefix' => 'scrapbook', 'as' => 'scrapbook::', ], function() {

        Route::get('/', [
            'as' => 'index',
            'uses' => 'ScrapbookController@index',
        ]);
        Route::get('/{scrapbook}/{section}', [
            'as' => 'details',
            'uses' => 'ScrapbookController@details',
        ]);
    });

    Route::group([ 'prefix' => 'contact-us', 'as' => 'contact::', ], function() {

        Route::get('/', [
            'as' => 'index',
            'uses' => 'ContactController@index',
        ]);
    });

    Route::group([ 'prefix' => 'users'], function () {
        Route::get('register', 'LoginController@register');
        Route::get('forgot-password', 'LoginController@forgotPassword');
        Route::get('login', 'LoginController@login');
        Route::get('activation', 'AccountController@activation');
        Route::get('dashboard', 'AccountController@dashboard');

    });

    Route::get('{slug?}/{slug2?}', [
        'middleware' => [],
        'as' => 'cms_page',
        'uses' => 'PageController@view'
    ])->where('page', '[A-Za-z0-9_/-]+');

});