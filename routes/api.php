use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\LoanController;

Route::apiResource('users', UserController::class);
Route::apiResource('genres', GenreController::class);
Route::apiResource('books', BookController::class);
Route::apiResource('loans', LoanController::class);
