<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = "home";
$route['admin'] = 'admin/dashboard';
$route['client'] = 'client/dashboard';
$route['404_override'] = 'my404';
$route['translate_uri_dashes'] = FALSE;
$route['admin/vendor/global-profile-list'] = 'admin/vendor/partnerList';

// Careers page custom routes
$route['careers/senior-it-recruiter'] = 'careers/senior_it_recruiter';
$route['careers/key-accounts-manager'] = 'careers/key_accounts_manager';
$route['careers/front-end-developer'] = 'careers/front_end_developer';
$route['careers/hr-associate'] = 'careers/hr_associate';
$route['careers/back-end-developer'] = 'careers/back_end_developer';

// Industries page custom routes
$route['industries/capital-markets'] = 'industries/capital_markets';

// Informatioal pages
$route['contact-us'] = 'contactus';

// hire-ios-dev page
$route['hire'] = 'Hire_ios_dev';

// apply-ios-dev page
$route['join'] = 'Apply_ios_dev';

// sitemaps
$route['sitemap.xml'] = 'sitemap/index/';
$route['static_pages.xml'] = 'sitemap/staticPages/';
$route['profiles_listings.xml'] = 'sitemap/profiles/';
$route['skills_listings.xml'] = 'sitemap/skills/';

// our-story page
$route['our-story'] = 'Our_story';

// terms and conditions page
$route['terms-and-conditions'] = 'Terms';

// privacy policy page
$route['privacy-policy'] = 'Privacy';

// about us page
$route['about-us'] = 'About';

// about us page
$route['corporate-information'] = 'Corporateinfo';

// forgot password page
$route['forgot-password'] = 'home/forgotpassword';

// profiles page
$route['profiles/(:any)'] = 'Profiles/index/$1';
$route['profile/(:any)'] = 'Profile/index/$1';
$route['profile/(:any)/(:any)'] = 'Profile/index/$2/$1';

$route['skills/(:any)'] = 'Skills/index/$1';

$route['remote-ios-jobs'] = 'Jobs';
$route['remote-ios-jobs/(:any)'] = 'Jobs/index/$1';

$route['job/(:any)'] = 'Jobs/job/$1';
// API
$route['api'] = 'Api';

//Global profile list
$route['admin/vendor/global-profile-list'] = 'admin/vendor/global_profile_list';

// info pages
$route['on-demand-talent'] = 'Info';
$route['on-demand-talent-2'] = 'Info/odt2';
$route['pricing'] = 'Info/pricing';
$route['press'] = 'Info/press';
$route['payment-success'] = 'Info/success';


