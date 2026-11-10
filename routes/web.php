<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GrandStayController;
use Illuminate\Support\Facades\Route;

// Halaman utama = daftar kamar, namanya "room" sesuai controller kamu
Route::get("/", [GrandStayController::class, "index"])->name("room");

Route::get("/login", [AuthController::class, "login"])->name("login");
Route::post("/login", [AuthController::class, "postlogin"])->name("postlogin");
Route::get("/register", [AuthController::class, "register"])->name("register");
Route::post("/register", [AuthController::class, "postregister"])->name(
  "postregister"
);
Route::post("/logout", [AuthController::class, "logout"])->name("logout");

Route::middleware("auth")->group(function () {
  Route::get("/reservation/{room}", [
    GrandStayController::class,
    "reservationForm",
  ])->name("reservation");
  Route::post("/reservation/{room}", [
    GrandStayController::class,
    "reservationStore",
  ])->name("reservation.store");
  Route::get("/reservation-success/{reservation}", [
    GrandStayController::class,
    "success",
  ])->name("reservation.success");
  Route::get("/history", [GrandStayController::class, "history"])->name(
    "history"
  );
  Route::get("/admin/rooms", [GrandStayController::class, "adminIndex"])->name(
    "admin.rooms"
  );
  Route::post("/admin/rooms", [GrandStayController::class, "adminStore"])->name(
    "admin.rooms.store"
  );
  Route::delete("/admin/rooms/{room}", [
    GrandStayController::class,
    "adminDelete",
  ])->name("admin.rooms.delete");
});
