<?php

use App\Models\Content;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ContentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});


// // عرض جميع المحتويات
// Route::get('/content', [ContentController::class, 'index'])->name('content.index');

// // عرض نموذج إنشاء محتوى جديد
// Route::get('/content/create', [ContentController::class, 'create'])->name('content.create');
// Route::get('/content/create', function () {
//     return view('contents.create-content');
// })->name('content.create');

// // تخزين محتوى جديد
// Route::post('/content/store', [ContentController::class, 'store'])->name('content.store');

// // عرض نموذج تعديل محتوى محدد
// Route::get('/content/{content}/edit', [ContentController::class, 'edit'])->name('content.edit');
// Route::get('/content/{content}/edit', function ($id) {
//     $content = Content::findOrFail($id);
//     return view('contents.edit-content', compact('content'));
// })->name('content.edit');

// // تحديث محتوى محدد
// Route::put('/content/{content}', [ContentController::class, 'update'])->name('content.update');
// Route::get('/content/{content}', function ($id) {
//     $content = Content::findOrFail($id);
//     return view('contents.edit-content', compact('content'));
// })->name('content.update');
// // حذف محتوى محدد
// Route::delete('/content/{content}', [ContentController::class, 'destroy'])->name('content.destroy');
// // حذف محتوى محدد
// Route::delete('/content/{content}', function ($id) {
//     $content = Content::findOrFail($id);
//     $content->delete();
//     return redirect()->route('content.index')->with('success', 'تم حذف المحتوى بنجاح!');
// })->name('content.destroy');

// Route::get('/content', [ContentController::class, 'index'])->name('content.index');

// Route::get('/content/create', [ContentController::class, 'create'])->name('content.create');
// Route::post('/content/store', [ContentController::class, 'store'])->name('content.store');

// Route::get('/content/create', function () {
//     return view('contents.create-content');
// })->name('content.create');
// Route::put('/content/update', function () {
//     return view('contents.edit-content');
// })->name('content.update');

// Route::post('/content', [ContentController::class, 'store'])->name('content.store');
// Route::put('/content/{content}/edit', [ContentController::class, 'edit'])->name('content.edit');
// Route::put('/content/{content}', [ContentController::class, 'update'])->name('content.update');
// Route::delete('/content/{content}', [ContentController::class, 'destroy'])->name('content.destroy');
