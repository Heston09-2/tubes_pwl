<?php

use App\Http\Controllers\Admin\KontakController;
use App\Http\Controllers\Pelajar\KuisController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\ManagerMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ManagerController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\NotificationController;
//mode pelajar
use App\Http\Controllers\PelajarAuth\PelajarRegisterController;
use App\Http\Controllers\PelajarAuth\PelajarLoginController;
use App\Http\Controllers\PelajarController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Pelajar\KategoriController;
use App\Http\Controllers\Pelajar\MateriController;
use App\Http\Controllers\ContactController;






use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\QuestionController;











Route::get('/', [ArtworkController::class, 'welcome'])->name('welcome');








//ROUTE JIKA ROLE = USER
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [ArtworkController::class, 'index'])->name('dashboard');
   

    Route::get('/gallery', [ArtworkController::class, 'gallery'])->name('gallery');
    Route::get('/gallery/filter', [ArtworkController::class, 'filter'])->name('gallery.filter');
    Route::get('/gallery/search', [ArtworkController::class, 'search'])->name('gallery.search');
    
    
    
    Route::get('/category/{category}', [ArtworkController::class, 'showCategory'])->name('category.show');
   
    
    Route::get('/artworks/{id}', [ArtworkController::class, 'detail'])->name('artworks.detail');
    Route::get('/aboutus', [ArtworkController::class, 'about'])->name('aboutus');
});



Route::middleware('auth',)->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';



// Route untuk admin
Route::middleware(['auth', 'verified',AdminMiddleware::class])->group(function () {
     Route::get('/admin/dashboard_admin', [AdminController::class, 'dashboard'])->name('admin.dashboard_admin');
    
    Route::get('/admin/show', [ArtworkController::class, 'show'])->name('admin.show');
    Route::get('/admin/pending', [ArtworkController::class, 'showPending'])->name('admin.pending');
    Route::get('/admin/rejected', [ArtworkController::class, 'showRejected'])->name('admin.rejected');


    Route::delete('/admin/show/{id}', [ArtworkController::class, 'destroy'])->name('admin.destroy');    
    Route::get('/admin/edit/{id}', [ArtworkController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/edit/{id}', [ArtworkController::class, 'update'])->name('admin.update');
    Route::get('/admin/create', function () {
        return view('admin.create');
    })->name('admin.create');
    Route::post('/admin/create', [ArtworkController::class, 'store'])->name('admin.store');
    
    
    
    Route::get('/admin/import', function () {
    return view('admin.import'); // Pastikan nama view benar
    })->name('admin.import');
    Route::post('/admin/import', [ArtworkController::class, 'import'])->name('artworks.import');
    Route::delete('/admin/artworks/clean-all', [ArtworkController::class, 'cleanAll'])->name('admin.artworks.cleanAll');


});

// Route untuk manager

Route::middleware(['auth', 'verified',ManagerMiddleware::class ])->prefix('manager')->name('manager.')->group(function () {
    
    // Dashboard manager
    Route::get('/dashboard', [ManagerController::class, 'dashboard'])->name('dashboard');

    // Kelola pengguna
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    
    

    // Kelola barang museum
    Route::get('/items', [ManagerController::class, 'items'])->name('items');
});

// Manager Artworks
Route::middleware(['auth', 'verified',ManagerMiddleware::class ])-> prefix('manager/artworks')->name('manager.artworks.')->group(function () {
    Route::get('/', [ManagerController::class, 'show'])->name('show');
    Route::get('/create', [ManagerController::class, 'create'])->name('create');
    Route::post('/', [ManagerController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [ManagerController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ManagerController::class, 'update'])->name('update');
    Route::delete('/delete-all', [ManagerController::class, 'destroyAll'])->name('deleteAll');
    Route::delete('/delete-by-category', [ManagerController::class, 'destroyByCategory'])->name('deleteByCategory');
    Route::delete('/{id}', [ManagerController::class, 'destroy'])->name('destroy');


    
    
    
    // Import Excel
    Route::post('/import', [ManagerController::class, 'import'])->name('import');
});

Route::middleware(['auth', 'verified', ManagerMiddleware::class,])->group(function () {
    Route::get('/manager/pending-artworks', [ManagerController::class, 'pendingArtworks'])->name('manager.pending');
    Route::post('/manager/artworks/{id}/approve', [ManagerController::class, 'approveArtwork'])->name('manager.approve');
    Route::post('/manager/artworks/{id}/reject', [ManagerController::class, 'rejectArtwork'])->name('manager.reject');
    Route::post('/manager/pending-artworks/approve-all', [ManagerController::class, 'approveAll'])->name('manager.approveAll');
    Route::delete('/manager/pending-artworks/delete-all', [ManagerController::class, 'deleteAllPending'])->name('manager.deleteAllPending');
    Route::get('/manager/tickets', [ManagerController::class, 'ticketHistory'])->name('manager.tickets.history');
    Route::get('/manager/statistics', [ManagerController::class, 'statistics'])->name('manager.statistics');
    Route::get('/laporan-pengunjung', [ManagerController::class, 'laporanPengunjung'])->name('manager.laporan.pengunjung');
    


    
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/favorites/{id}/toggle', [FavoriteController::class, 'toggleFavorite'])->name('favorites.toggle');
    Route::get('/favorites', [FavoriteController::class, 'myFavorites'])->name('favorites.index');
    Route::get('/favorites/popular', [FavoriteController::class, 'mostFavorited'])->name('favorites.popular');
    Route::delete('/favorites/{id}', [FavoriteController::class, 'removeFavorite'])->name('favorites.remove');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/my', [TicketController::class, 'myTickets'])->name('tickets.my');
    Route::get('/tickets/{ticket}/download', [TicketController::class, 'download'])->name('tickets.download');
    Route::post('/tickets/fill-names', [TicketController::class, 'fillNames'])->name('tickets.fillNames');
});



Route::middleware(['auth', 'verified',AdminMiddleware::class ])->prefix('admin')->group(function () {
    Route::get('/pengunjung', [AdminController::class, 'pengunjungIndex'])->name('admin.pengunjung.index');
    Route::post('/pengunjung', [AdminController::class, 'storePengunjung'])->name('admin.pengunjung.store');
    Route::patch('/pengunjung/{id}/finalize', [AdminController::class, 'finalizePengunjung'])->name('admin.pengunjung.finalize');
    Route::get('/pengunjung/{id}/edit', [AdminController::class, 'editPengunjung'])->name('admin.pengunjung.edit');
Route::put('/pengunjung/{id}', [AdminController::class, 'updatePengunjung'])->name('admin.pengunjung.update');
Route::delete('/admin/pengunjung/{id}', [AdminController::class, 'destroyPengunjung'])->name('admin.pengunjung.destroy');


});








Route::patch('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
Route::delete('/manager/notifications/{id}', [NotificationController::class, 'destroy'])->name('manager.notifications.destroy');
Route::patch('admin/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('admin.notifications.markAsRead');


//MODE PERLAJAR===================================================================================================================
Route::view('/welcome', 'pelajar.welcome')->name('pelajar.welcome');
Route::prefix('pelajar')->name('pelajar.')->group(function () {

    // Register
    Route::get('register', [PelajarRegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [PelajarRegisterController::class, 'register']);

    // Login
    Route::get('login', [PelajarLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [PelajarLoginController::class, 'login']);

    // Logout
    Route::post('logout', [PelajarLoginController::class, 'logout'])->name('logout');

    // Protected routes for pelajar after login
    Route::middleware('auth:pelajar')->group(function () {
        Route::get('home', function () {
            return view('pelajar.home');
        })->name('home');
    });
    
});
 

Route::middleware(['auth:pelajar'])->prefix('pelajar')->name('pelajar.')->group(function () {
    Route::get('/home/', [MateriController::class, 'home'])->name('home');
    Route::get('/', [KategoriController::class, 'index'])->name('materi');
    Route::get('/kategori/{category}', [KategoriController::class, 'show'])->name('kategori.show');
    Route::get('/subkategori/{subcategory}/materi', [MateriController::class, 'detailMateri'])->name('materi.detail');
    
    Route::get('/materi/{id}', [MateriController::class, 'showMateri'])->name('materi.show');

    Route::get('/materi/{id}/download', [MateriController::class, 'download'])->name('materi.download');
    Route::post('/materi/{id}/like', [MateriController::class, 'toggleLike'])->name('materi.like');
    Route::post('/materi/{id}/komentar', [MateriController::class, 'storeComment'])->name('materi.komentar');
    Route::get('/saved', [MateriController::class, 'saved'])->name('saved');

    Route::get('/contact-us', [ContactController::class, 'showForm'])->name('contact.form');
    Route::post('/contact-us', [ContactController::class, 'submitForm'])->name('contact.submit');
    



});





Route::prefix('pelajar')->middleware(['auth:pelajar'])->group(function () {
    Route::get('/kategori', [KuisController::class, 'index'])->name('pelajar.quizzes.index');
    Route::get('/kategori/{id}/quizzes', [KuisController::class, 'quizzesByCategory'])->name('pelajar.quizzes.byCategory');
    Route::get('/quizzes/{quiz}', [KuisController::class, 'show'])->name('pelajar.quiz.take');
    Route::post('/quizzes/{quiz}/submit', [KuisController::class, 'submit'])->name('pelajar.quiz.submit');
    Route::get('/quiz/result/{result}', [KuisController::class, 'result'])->name('pelajar.quiz.result');

});




Route::middleware(['auth:pelajar'])->prefix('pelajar')->name('pelajar.')->group(function () {
    Route::get('/profile', [PelajarController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [PelajarController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [PelajarController::class, 'update'])->name('profile.update');
    Route::post('/profile/delete', [PelajarController::class, 'destroy'])->name('profile.delete');
    



// Beranda (tampil kategori)

    // Subkategori berdasarkan kategori
   
    
});

//kelola perlajar oleh manager


Route::middleware(['auth', 'verified',ManagerMiddleware::class,])->prefix('manager')->name('manager.')->group(function () {
    Route::get('/pelajar', [ManagerController::class, 'pelajarIndex'])->name('pelajar.index');
    Route::get('/pelajar/create', [ManagerController::class, 'pelajarCreate'])->name('pelajar.create');
    Route::post('/pelajar', [ManagerController::class, 'pelajarStore'])->name('pelajar.store');
    Route::get('/pelajar/{id}/edit', [ManagerController::class, 'pelajarEdit'])->name('pelajar.edit');
    Route::put('/pelajar/{id}', [ManagerController::class, 'pelajarUpdate'])->name('pelajar.update');
    Route::delete('/pelajar/{id}', [ManagerController::class, 'pelajarDestroy'])->name('pelajar.destroy');
});

//upload materi oleh admin



Route::middleware(['auth', 'verified', AdminMiddleware::class])->group(function () {
    
    // Materials
    Route::get('/admin/materials', [MaterialController::class, 'index'])->name('admin.materials.index');
    Route::get('/admin/materials/create', [MaterialController::class, 'create'])->name('admin.materials.create');
    Route::post('/admin/materials', [MaterialController::class, 'store'])->name('admin.materials.store');
    Route::get('/admin/materials/{material}/edit', [MaterialController::class, 'edit'])->name('admin.materials.edit');
    Route::put('/admin/materials/{material}', [MaterialController::class, 'update'])->name('admin.materials.update');
    Route::delete('/admin/materials/{material}', [MaterialController::class, 'destroy'])->name('admin.materials.destroy');

    // Categories
    Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');

    // Subcategories
    Route::get('/admin/subcategories/create', [SubcategoryController::class, 'create'])->name('admin.subcategories.create');
    Route::post('/admin/subcategories', [SubcategoryController::class, 'store'])->name('admin.subcategories.store');

    // AJAX Subcategories
    Route::get('/admin/categories/{category}/subcategories', function (\App\Models\Category $category) {
        return response()->json($category->subcategories);
    })->name('admin.categories.subcategories');

    // ✅ Quizzes
    Route::get('/admin/quizzes', [QuizController::class, 'index'])->name('admin.quizzes.index');
    Route::get('/admin/quizzes/create', [QuizController::class, 'create'])->name('admin.quizzes.create');
    Route::post('/admin/quizzes', [QuizController::class, 'store'])->name('admin.quizzes.store');
    Route::get('/admin/quizzes/{quiz}/edit', [QuizController::class, 'edit'])->name('admin.quizzes.edit');
    Route::put('/admin/quizzes/{quiz}', [QuizController::class, 'update'])->name('admin.quizzes.update');
    Route::delete('/admin/quizzes/{quiz}', [QuizController::class, 'destroy'])->name('admin.quizzes.destroy');

    // Question routes terkait quiz tertentu
    Route::get('/quizzes/{quiz}/questions', [QuestionController::class, 'index'])->name('admin.questions.index');
    Route::get('/quizzes/{quiz}/questions/create', [QuestionController::class, 'create'])->name('admin.questions.create');
    Route::post('/quizzes/{quiz}/questions', [QuestionController::class, 'store'])->name('admin.questions.store');
    
    Route::get('/quizzes/{quiz}/questions/{question}/edit', [QuestionController::class, 'edit'])->name('admin.questions.edit');
    Route::put('/quizzes/{quiz}/questions/{question}', [QuestionController::class, 'update'])->name('admin.questions.update');
    Route::delete('/quizzes/{quiz}/questions/{question}', [QuestionController::class, 'destroy'])->name('admin.questions.destroy');

     Route::get('/contacts', [KontakController::class, 'index'])->name('admin.contacts.index');


});






