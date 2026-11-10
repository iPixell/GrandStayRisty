<?php
namespace App\Http\Controllers;
use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class GrandStayController extends Controller
{
  public function index(Request $request)
  {
    $query = Room::query();

    // CARI KAMAR BERDASARKAN TANGGAL - wajib kisi-kisi
    if ($request->check_in && $request->check_out) {
      $query->whereDoesntHave("reservations", function ($q) use ($request) {
        $q->where("check_in", "<", $request->check_out)->where(
          "check_out",
          ">",
          $request->check_in
        );
      });
    }

    $rooms = $query->get();
    return view("room", compact("rooms"));
  }

  public function reservationForm(Room $room)
  {
    return view("reservation", compact("room"));
  }

  public function reservationStore(Request $request, Room $room)
  {
    $request->validate([
      "check_in" => "required|date|after_or_equal:today",
      "check_out" => "required|date|after:check_in",
    ]);

    // CEK DOUBLE BOOKING
    $nabrak = Reservation::where("room_id", $room->id)
      ->where("check_in", "<", $request->check_out)
      ->where("check_out", ">", $request->check_in)
      ->exists();

    if ($nabrak) {
      return back()->with(
        "error",
        "Kamar ini sudah di-reservation di tanggal tersebut. Coba tanggal lain."
      );
    }

    $nights = Carbon::parse($request->check_in)->diffInDays(
      $request->check_out
    );
    $reservation = Reservation::create([
      "user_id" => Auth::id(),
      "room_id" => $room->id,
      "check_in" => $request->check_in,
      "check_out" => $request->check_out,
      "nights" => $nights, // ini yang ketinggalan di code kamu
      "total" => $nights * $room->price,
    ]);
    return redirect()->route("reservation.success", $reservation->id);
  }

  // INI YANG KETINGGALAN, padahal ada di routes kamu
  public function success(Reservation $reservation)
  {
    $reservation->load(["room", "user"]);
    return view("reservation_success", compact("reservation"));
  }

  public function history()
  {
    // Kalau admin, liat semua. Kalau customer, liat punya dia aja
    if (Auth::user()->role == "admin") {
      $reservations = Reservation::with(["room", "user"])
        ->latest()
        ->get();
    } else {
      $reservations = Reservation::where("user_id", Auth::id())
        ->with("room")
        ->get();
    }
    return view("history", compact("reservations"));
  }

  public function adminIndex()
  {
    $rooms = Room::all();
    return view("admin", compact("rooms")); // bukan admin.rooms lagi
  }

  public function adminStore(Request $request)
  {
    $request->validate(["name" => "required", "price" => "required|numeric"]);
    $data = $request->only(["name", "price"]);
    if ($request->hasFile("img")) {
      $data["img"] = $request->file("img")->store("rooms", "public");
    }
    Room::create($data);
    return back();
  }

  public function adminDelete(Room $room)
  {
    $room->delete();
    return back();
  }
}
