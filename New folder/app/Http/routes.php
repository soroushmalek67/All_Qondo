<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
// "'middleware' => 'apiKey',";
//"?email=test@123.com&password=demo123&api_key=RK8dYHtHqWlWVDdmIrerIIsflODENJ";
Route::group(array('namespace' => 'Api', 'middleware' => 'apiKey', 'prefix' => 'api'), function() {
    Route::post('/login', 'Api@postLogin');
//    Route::post('/login/{*}', 'Api@postLogin');
    Route::post('/register/', 'Api@RegisterUser');
    Route::get('/categories', 'Api@GetCategories');
    Route::get('/categories/{slug}', 'Api@GetSubCategories');
    Route::get('/supplierlist', 'Api@supplierlist');
    Route::post('/supplierlist', 'Api@supplierlist');
    Route::post('/get-active-suppliers', 'Api@GetactiveSuppliers');
    Route::post('/request-service', 'Api@RequestService');
    Route::post('/uploadimage', 'Api@uploadimage');
    Route::get('/reset-password-request', 'Api@ResetPasswordRequest');
    Route::get('/get', 'Api@getRegisterUser');
    Route::get('/get-buildings-list', 'Api@GetBuildings');
    Route::get('/view-profile', 'Api@ViewProfile');
    Route::post('/update-profile', 'Api@UpdateProfile');
    Route::get('/get-cat-services', 'Api@GetCatServices');
    Route::get('/get-services', 'Api@GetServices');
    Route::get('/get-request-list/{id}', 'Api@getRequestList');
    //Muaawiya's
    Route::get('/get-request-list/{id}', 'Api@getRequestList');
    Route::get('/get-images/', 'Api@getImagesHowItWorks');
	Route::get('/get-states/', 'Api@getStates');
	Route::get('/get-cities/{state_id}', 'Api@getCities');
    //End Muaawiya's
});
//Route::group(array('middleware' => ['secure', 'users.track']), function() {
Route::group(array('middleware' => ['users.track']), function() {


    Route::post('sociallogin', 'SocialController@sociallogin');



    // Adming Routes
    Route::group(array('namespace' => 'Admin', 'middleware' => 'adminAuth', 'prefix' => 'admin-panel'), function() {
        Route::get('/', 'AdminController@Index');

        Route::get('users', 'Users@Index');
        Route::get('users/buyers', 'Users@Buyers');
        Route::get('users/suppliers', 'Users@Suppliers');
        Route::get('users/add', 'Users@Add');
        Route::get('users/edit/{id}', 'Users@Add');
        Route::post('users/save', 'Users@Save');
        Route::get('refund', 'Users@refunds');
        Route::post('refund', 'notificationController@index');
        Route::get('refund/edit/{id}', 'Users@Refundedit')->where('id', '[0-9]+');
        Route::post('refundaprove/{id}', 'Users@Refundaprover')->where('id', '[0-9]+');


        Route::get('notificationContent', 'notificationController@index');
        Route::post('updateNotifications', 'notificationController@update');
//        Route::post('users/save', 'Users@Save');

        Route::get('supplier-buyer-list', 'Users@cvsimport');
        Route::post('supplier-buyer-list', 'Users@cvsSave');


        Route::delete('users', 'Users@Delete');


        Route::get('awards', 'CertificatesAwards@index');
        Route::get('awards/add', 'CertificatesAwards@formaward');
        Route::get('awards/save', 'CertificatesAwards@save');
        Route::post('awards/save', 'CertificatesAwards@save');
        Route::get('award/edit/{id}', 'CertificatesAwards@edit');
        Route::get('award/delete/{id}', 'CertificatesAwards@delete');

        Route::get('comments', 'reviews@Index');
        Route::get('comment/edit/{id}', 'reviews@edit');
        Route::get('comment/delete/{id}', 'reviews@delete');
        Route::get('comment/aprove/{id}', 'reviews@aprove');

        Route::get('users/activity', 'UserActivities@Index');
        Route::get('users/visits', 'UserActivities@Visits');

        Route::get('categories', 'Categories@index');
        Route::get('categories/add', 'Categories@Add');

        Route::get('categories/edit/{id}', 'Categories@Edit')->where('id', '[0-9]+');

        Route::post('categories/save', 'Categories@Save');
        Route::delete('categories/delete/{id}', 'Categories@Delete');

        Route::get('requested-services', 'RequestedServices@Index');
        Route::post('requested-services', 'RequestedServices@UpdateStatus');
        Route::get('requested-services/{id}', 'RequestedServices@Details')->where('id', '[0-9]+');
        Route::post('requested-services/{id}', 'RequestedServices@updateRequest')->where('id', '[0-9]+');

        Route::get('cities', 'Cities@index');
        Route::get('cities/add', 'Cities@Add');
        Route::get('cities/{id}', 'Cities@Edit')->where('id', '[0-9]+');
        Route::post('cities', 'Cities@Save');
        Route::delete('cities', 'Cities@Delete');

        Route::get('states', 'States@index');
        Route::get('states/add', 'States@Add');
        Route::get('states/{id}', 'States@Add')->where('id', '[0-9]+');
        Route::post('states', 'States@Save');
        Route::delete('states', 'States@Delete');

        Route::get('seo/metas', 'SEOController@Metas');
        Route::get('seo/metas/add', 'SEOController@MetaAdd');
        Route::get('seo/metas/{id}', 'SEOController@MetaEdit');
        Route::post('seo/metas', 'SEOController@MetaSave');
        Route::delete('seo/metas', 'SEOController@MetaDelete');

        Route::get('newsletter-subscribers', 'AdminController@NewsLetterEmails');

        Route::get('settings/general', 'Settings@Index');
        Route::post('settings/general', 'Settings@Save');
        Route::get('settings/memberships', 'Settings@Memberships');
        Route::post('settings/memberships', 'Settings@SaveMemberships');
        
        //admin building module
        Route::get('buildings', 'Buildings@index');
        Route::get('buildings/unapproved', 'Buildings@UnApproveList');
        Route::get('buildings/add', 'Buildings@Edit');
        Route::get('buildings/{id}', 'Buildings@Edit')->where('id', '[0-9]+');
        Route::post('buildings', 'Buildings@Save');
        Route::delete('buildings', 'Buildings@Delete');
		Route::post('buildings/approve-selected', 'Buildings@ApproveSelectedBuildings');

        Route::controllers([
            'auth' => 'Auth\AuthController'
        ]);

        Route::get('404', function() {
            $data['metas'] = get_page_meta_array('Not Found');
            return view('admin.errors.404', $data);
        });
    });

    Route::get('contact', 'PagesController@contact');
    Route::get('about', 'PagesController@about');
    Route::get('faq', 'PagesController@faq');
    Route::get('home', 'WelcomeController@index');
    Route::get('how-it-works', 'PagesController@howItWorks');


    // Front end Routes
    Route::get('/', 'HomeController@index');
//     Route::get('/show-latest-request', 'HomeController@latest');


    Route::get('categories', 'Categories@index');
    Route::get('categories/{slug}', 'Categories@subCategories');

    // Route::get('request-service', 'RequestService@index');
    Route::get('request-service', 'RequestService@index');
    Route::get('request-service/save', 'RequestService@SaveFromSession');
    Route::post('request-service', 'RequestService@Save');
    Route::get('request-service/{flage}', 'RequestService@indexOpen');

    Route::get('request-service/{slug?}/{id?}', 'RequestService@indexSupplier');

    Route::get('city/{slug}', 'Cities@index');
    Route::get('supplier-profile/{slug}/{id}', 'ViewSupplier@Index');
    Route::post('suppliers-review', 'ViewSupplier@reviewsave');
//    Route::post('suppliers-review', function (){
//        return('hi');
//    });

    Route::get('request-business', 'RequestBusiness@index');
    Route::get('suppliers', 'ViewSupplier@Suppliers');

    // Pages
    Route::get('contact-us', 'PagesController@ContactUs');
    Route::post('contact-us', 'PagesController@ContactUsPost');
    Route::get('privacy-policy', 'PagesController@PrivacyPolicy');
    Route::get('terms', 'PagesController@Terms');

    // Ajax Routes
    Route::post('ajax/get-cities', 'AjaxRequests@GetCities');
    Route::post('ajax/autocomplete', 'AjaxRequests@HomePageAutoCom');
    Route::post('ajax/homepageautocom', 'AjaxRequests@HomePageAutoCom');
    Route::post('ajax/contractors-search', 'AjaxRequests@AutoComplete');
    Route::post('ajax/get-buildings', 'AjaxRequests@GetBuildings');
    Route::post('ajax/get-sub-categories', 'AjaxRequests@GetSubCategories');
    Route::post('ajax/newsletter', 'AjaxRequests@NewsLetter');
    Route::post('ajax/claim-profile', 'AjaxRequests@ClaimProfile');
    Route::post('ajax/get-suppliers', 'AjaxRequests@GetSuppliers');
    Route::post('ajax/get-asuppliers', 'AjaxRequests@GetactiveSuppliers');
    Route::post('ajax/get-selsuppliers', 'AjaxRequests@GetselectedSuppliers');
    Route::post('ajax/get-company', 'AjaxRequests@getCompany');
    Route::post('ajax/get-mobile-app', 'AjaxRequests@RequestApp');
    Route::post('ajax/get-services', 'AjaxRequests@GetServices');
    // Search From Route
    Route::post('search-form-submission', 'Process@SearchFormSubmision');

    // Paypal Routes
    Route::post('paypal', 'Paypal@PayAmount');
    Route::get('payment/status', 'Paypal@PaymentResponse');

    // Errors
    Route::get('outdated_browser', 'PagesController@OutdatedBrowser');


    // Front end Users Routes
    Route::group(array('middleware' => 'auth'), function() {
        Route::get('dashboard', 'Dashboard@index');
        Route::get('requestSupplier/{id}', 'Dashboard@viewRequestSuppliers')->where('id', '[0-9]+');
        Route::get('accept-quote/{id}', 'Dashboard@AcceptQuote');
        Route::get('membership', 'Dashboard@Membership');
        Route::get('purchase-credits', 'Dashboard@purchaseCredits');
        Route::get('project-details/{id}', 'Dashboard@projectDetails')->where('id', '[0-9]+');
        Route::get('homepage-project-details/{id}', 'Dashboard@homeprojectDetails')->where('id', '[0-9]+');
        Route::get('Respond_to_request/{id}', 'Dashboard@Respond_to_this_requestForm')->where('id', '[0-9]+');
        Route::post('Respond_to_request/{id}', 'Dashboard@Respond_to_this_request')->where('id', '[0-9]+');
        //Route::get('homepage-project-details/{id}', 'Dashboard@homeprojectDetails')->where('id', '[0-9]+');
        Route::get('view-suppliers', 'Dashboard@viewSuppliers');
        
        Route::group(array('namespace' => 'Users'), function() {
            Route::get('suppliers-list', 'Supplier@AllSuppliers');
            Route::get('profile', 'Profile@index');
            Route::post('profile', 'Profile@save');
            Route::get('no-dedicated', 'Dedicated@dedicated_url_not_found');
            Route::get('dedicated/{url}', 'Dedicated@dedicated_url');
            Route::get('products', 'Profile@service_product');
            Route::get('service-product', 'Profile@service_product_form');
            Route::get('product-edit{id}', 'Profile@service_product_edit');
            Route::get('product-delete{id}', 'Profile@service_product_delete');
            Route::post('service-product', 'Profile@service_product_save');
            Route::get('coupons', 'Profile@coupon');
            Route::get('promotion-coupon', 'Profile@coupon_form');
            Route::get('coupon-edit{id}', 'Profile@coupon_edit');
            Route::get('coupon-delete{id}', 'Profile@coupon_delete');
            Route::post('promotion-coupon', 'Profile@coupon_save');
            Route::get('send-quote/{id}', 'Quote@index');
            Route::get('reject-quote/{id}', 'Quote@RejectQuoteInvitaion');
            Route::get('accept-quote/{id}', 'Quote@AcceptQuote');
            Route::post('send-quote', 'Quote@Save');
            Route::get('invoices/add', 'Invoices@Add');
            Route::get('invoices', 'Invoices@index');
            Route::post('send-invoice', 'Invoices@Send');
            Route::get('messages', 'Messages@index');
            Route::post('message-create', 'Messages@MessageCreate');
            Route::get('message-details/{id}', 'Messages@MessagesDetail');
            Route::get('publicMessage/{id}', 'Messages@publicMessagesDetail');
            //csv
            Route::get('supplier-buyer-list', 'MySuppliers@supplierlist');
            Route::post('supplier-buyer-list', 'MySuppliers@supplierlist');
            Route::get('importSupplier', 'MySuppliers@index');
            Route::post('csv{id}', 'MySuppliers@save_cvs');
            Route::get('mysupplier-add', 'MySuppliers@add_supplierForm');
            Route::post('save-Supplier{id}', 'MySuppliers@saveSupplier');
            Route::get('allsupplier', 'MySuppliers@allSupplier');
            Route::post('allsupplierListAdd{id}', 'MySuppliers@save_listexit');
            Route::get('supplier-delete{id}', 'MySuppliers@delete');
            Route::get('activation/{slug}/{id}', 'MySuppliers@activation');

            //Unsubscripbe
            Route::get('unsubscribe', 'Unsubscribe@Index');
            Route::post('unsubscribe', 'Unsubscribe@Save');

            Route::get('complete-profile', 'Profile@CompleteProfile');


            // Ajax Routes
            Route::get('ajax/get-suppliers', 'Supplier@SelectSuppliersQuery');
        });
        Route::get('transactions', 'Dashboard@Transactions');
        Route::get('refund', 'Dashboard@Refundfrom');
        Route::post('refund', 'Dashboard@Refund');

        Route::get('dedicated-membership-request', 'Dashboard@DedicatedMembershipRequest');
    });

    //Route::resource('categories', 'Categories');
    Route::controllers([
        'auth' => 'Auth\AuthController',
        'password' => 'Auth\PasswordController',
    ]);



    Route::get('sitemap.xml', function() {
        // create new sitemap object
        $sitemap = App::make("sitemap");

        // set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
        // by default cache is disabled
        // 	$sitemap->setCache('laravel.sitemap', 60);
        // 	// check if there is cached sitemap and build new only if is not
        // 	if (!$sitemap->isCached())
        // 	{

        $defaultDate = '2015-11-18T18:15:21+00:00';
        // get changes dates
        $categoryLatestUpdatedDate = DB::table('category')->select('date_modified')->orderBy('date_modified', 'desc')->first()->date_modified;
        $citiesLatestUpdatedDate = DB::table('cities')->select('updated_at')->orderBy('updated_at', 'desc')->first()->updated_at;
        $suppliersLatestUpdatedDate = DB::table('users')->select('updated_at')->whereIn('user_type', [2, 3])->orderBy('updated_at', 'desc')->first()
                ->updated_at;

        $staticURLs = [[url(), $categoryLatestUpdatedDate, '1.0', 'daily'], [url('suppliers'), $suppliersLatestUpdatedDate, '1.0', 'daily'],
                [url('categories'), $categoryLatestUpdatedDate, '1.0', 'daily'], [url('request-service'), $defaultDate, '0.6', 'monthly'],
                [url('auth/login'), $defaultDate, '0.6', 'monthly'], [url('auth/register'), $defaultDate, '0.6', 'monthly'],
                [url('suppliers-list'), $suppliersLatestUpdatedDate, '1.0', 'daily'], [url('contact-us'), $defaultDate, '0.6', 'monthly'],
                [url('terms'), $defaultDate, '0.5', 'monthly'], [url('privacy-policy'), $defaultDate, '0.5', 'monthly']];

        // add item to the sitemap (url, date, priority, freq)
        // add item with translations (url, date, priority, freq, images, title, translations)
        foreach ($staticURLs as $staticURL) {
            $sitemap->add($staticURL[0], $staticURL[1], $staticURL[2], $staticURL[3]);
        }

        // get Main Categories from db
        $categories = DB::table('category')->select('slug', 'date_modified')->where('parent_id', 0)->orderBy('date_modified', 'desc')->get();
        // add Main Categories to the sitemap
        foreach ($categories as $category) {
            $sitemap->add(url("categories/$category->slug"), $category->date_modified, '1', 'daily');
        }

        // get all cities from db
        $cities = DB::table('cities')->select('slug', 'updated_at')->orderBy('updated_at', 'desc')->get();
        // add all cities to the sitemap
        foreach ($cities as $city) {
            $sitemap->add(url("city/$city->slug"), $city->updated_at, '1', 'daily');
        }

        // get all suppliers from db
        $suppliers = DB::table('users')->select('id', 'company_slug', 'updated_at')->whereIn('user_type', [2, 3])->orderBy('updated_at', 'desc')->get();
        // add all suppliers to the sitemap
//                    foreach ($suppliers as $supplier) {
//                            $sitemap->add(url("supplier-profile/$supplier->company_slug/$supplier->id"), $supplier->updated_at, '1', 'daily');
//                    }
        // 	}
        // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
        return $sitemap->render('xml');
    });

    Route::get('view-suppliers', 'ViewSupplier@viewSuppliers');

    Route::get('404', function() {
        $data['metas'] = get_page_meta_array('Not Found');
        return view('errors.404', $data);
    });
});
