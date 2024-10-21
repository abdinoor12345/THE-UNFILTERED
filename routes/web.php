<?php

use App\Http\Controllers\BusinessController;
use App\Http\Controllers\OpinionsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SportsController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\TopStoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\The_UnfilteredController;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\LinkController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/sports',[The_UnfilteredController::class,'Sports'])->name('sports');
Route::get('/news/trending', [The_UnfilteredController::class, 'create_news'])->middleware(['auth'])->name('news.trending');
Route::post('/news/store/trendings', [The_UnfilteredController::class, 'store_news'])->name('news.store');
route::get('/',[The_UnfilteredController::class,'get_news'])->name('news');
Route::get('/news/{slug}', [The_UnfilteredController::class, 'show'])->name('news.show');
Route::get('/edit_news/{trending}/news', [The_UnfilteredController::class, 'edit_news'])->name('news.edit');
Route::put('news/{trending}', [The_UnfilteredController::class, 'update_news'])->name('news.update');
Route::get('/top_stories/create', [TopStoryController::class, 'create_news'])->middleware(['auth'])->name('top.stories');
Route::post('/news/store', [TopStoryController::class, 'store_news'])->name('top_stories.store');route::get('/top_stories',[TopStoryController::class,'index'])->name('news.top_story');
Route::get('/edit_news/{Top_Story}/top_stories', [ TopStoryController::class, 'edit_news'])->name('top_stories.edit')->middleware(['auth']);
Route::put('news/{trending}', [TopStoryController::class, 'update_news'])->name('news.update')->middleware(['auth']);
 Route::get('/top_stories/{slug}', [TopStoryController::class, 'show'])->name('top_stories.show');
Route::get('/delete/{id}',[TopStoryController::class,'destroy_news'])->name( 'delete.top_stories_news')->middleware(['auth']);
Route::get('/opinions/create',[OpinionsController::class,'create_news'])->name('opinions.create')->middleware(['auth']);
Route::post('/opinions/store',[OpinionsController::class,'store_news'])->name('opinions.store');
Route::get('/opinions/news',[OpinionsController::class,'get_news'])->name( 'opinions');
Route::get('/opinions/{slug}',[OpinionsController::class,'show'])->name('opinions.show');
Route::get('/edit/{Opinion}opinions',[OpinionsController::class,'edit_opinions'])->name('opinions.edit')->middleware(['auth']);
Route::put('/opinions/{Opinion}',[OpinionsController::class,'update_opinions'])->name('opinions.update')->middleware(['auth']);
Route::get('delete_opinions/{id}',[OpinionsController::class,'destroy_news'])->name('delete.opinions')->middleware(['auth']);
Route::get('/soccer',[SportsController::class,'soccer'])->name('soccer');
Route::get('/hockey',[SportsController::class,'Hockey'])->name('Hockey');
Route::get('/cricket',[SportsController::class,'Cricket'])->name('Cricket');
Route::get('/basketball',[SportsController::class,'Rugby'])->name('Rugby');

Route::get('/sports/page',[SportsController::class,'get_news'])->name('sports.get');
Route::get('/create/sports',[SportsController::class,'create_news'])->name('create.sports')->middleware(['auth']);
Route::post('/store/sports',[SportsController::class,'store_news'])->name('sports.store');
 Route::get('sports{slug}',[SportsController::class,'show'])->name('sports.show');
 Route::get('news/{SportSport}/sport',[SportsController::class,'edit_news'])->name('sports.edit')->middleware(['auth']);
 Route::put('/update/{SportSport}/sports',[SportsController::class,'update_news'])->name('update.sports')->middleware(['auth']);
  Route::get('/soccer{slug}',[SportsController::class,'Soccer_show'])->name('sport.show');
 Route::get('/cricket{slug}',[SportsController::class,'Cricket_show'])->name('cricket.show');
Route::get('/basket{slug}',[SportsController::class,'Basketball_show'])->name('basket.show');
Route::get('/hockey{slug}',[SportsController::class,'hockey_show'])->name('hockey.show');

Route::get('/technology/create',[TechnologyController::class,'create'])->name('technology')->middleware(['auth']);
Route::post('/technology/store',[TechnologyController::class,'store'])->name('technology.store');
route::get('/technology',[TechnologyController::class,'index'])->name('technology.index');
Route::get('/tecgnology{slug}',[TechnologyController::class,'show'])->name('technology.show');
Route::get('/news{technology}/technology',[TechnologyController::class,'edit_technology'])->name('technology.edit');
Route::put('/update/{technology}/technology',[TechnologyController::class,'update'])->name('technology.update')->middleware(['auth']);
Route::delete('/technology{id}', [ TechnologyController::class, 'destroy'])->name('technology.destroy')->middleware(['auth']);
 Route::get('/create/business',[BusinessController::class,'create'])->name('business.create')->middleware(['auth']);
Route::post('/post/business',[BusinessController::class,'store'])->name('business.store');
Route::get('/business',[BusinessController::class,'index'])->name('business');
Route::get('/business{slug}',[BusinessController::class,'show'])->name('business.show');
Route::get('/news{business}/business',[ BusinessController::class,'edit'])->name('business.edit')->middleware(['auth']);
Route::put('/update/{business}/business',[ BusinessController::class,'update'])->name('business.update')->middleware(['auth']);
Route::delete('/business{id}', [ BusinessController::class, 'destroy'])->name('business.destroy')->middleware(['auth']);
 Route::get('/video',[The_UnfilteredController::class,'video'])->name('video');
 Route::get('/BreakingNews',[The_UnfilteredController::class,'BreakingNews'])->name('BreakingNews');
 Route::get('/Interviews',[The_UnfilteredController::class,'Interviews'])->name('Interviews');
 Route::get('/Livestream',[The_UnfilteredController::class,'Livestream'])->name('Livestream');
 Route::get('/SpecialReports',[The_UnfilteredController::class,'SpecialReports'])->name('SpecialReports');
 Route::get('/TrendingNow',[The_UnfilteredController::class,'TrendingNow'])->name('TrendingNow');
  
  Route::put('/roles/{roleId}/give-permissions', [RoleController::class, 'updatePermissions']);
 Route::get('/roles/{roleId}/give_permissions', [RoleController::class, 'AssignPermission']);
 Route::get('/users/{user}/assign-roles', [UserController::class, 'assignRoles'])->name('users.assignRoles');
 Route::put('/users/{user}/update-roles', [UserController::class, 'updateRoles'])->name('users.updateRoles');
 Route::group(['middleware' => ['role:super-admin|An author']], function () {
    Route::resource('users',  UserController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);
    Route::get('/sports/authors',[AuthorsController::class,'SportPage'])->name('sport.view');
    Route::get('/businesspage',[AuthorsController::class,'BusinessPage'])->name('businessview')->middleware(['auth']);
    Route::get('/TechnologyPage',[AuthorsController::class,'TechnologyPage'])->name('TechnologyPage')->middleware(['auth']);
Route::get('/OpinionPage',[AuthorsController::class,'OpinionPage'])->name('OpinionPage');
Route::get('/TopStoriesPage',[AuthorsController::class,'TopStoriesPage'])->name('TopStoriesPage')->middleware(['auth']);
Route::get('/viewlandingpage',[AuthorsController::class,'ViewLandingPage'])->name('viewlandingpage');
Route::get('/links/create', [LinkController::class, 'create'])->name('links.create');
Route::post('/links/store', [LinkController::class, 'store'])->name('links.store');
 });
 Route::resource('videos', VideoController::class);
 Route::post('/posts/{post}/like', [The_UnfilteredController::class, 'like'])->name('posts.like');


  require __DIR__.'/auth.php';  
