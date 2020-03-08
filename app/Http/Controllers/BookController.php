<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{
    public function index()
    {
        $appointments = Book::paginate(10);

        return view('book.index', compact('appointments'));
    }

    public function create()
    {
        return view('book.create');
    }

    public function store(CreateBookRequest $request)
    {
        Book::addAppointment($request->all());

        return response()->json(['success' => 'Successfully add new appointment.']);

    }

    public function show($id)
    {
        $appointment = Book::where('id', $id)->first();
        $first_name = $appointment->first_name;
        $last_name = $appointment->last_name;
        $other_client_appointments = Book::otherClientAppointments($first_name, $last_name, $id);

        return view('book.show', compact('appointment', 'other_client_appointments'));

    }

    public function edit($id)
    {
        $appointment = Book::where('id', $id)->first();

        return view('book.edit', compact('appointment'));

    }

    public function update(UpdateBookRequest $request)
    {
        Book::updateAppointment($request);

        return response()->json(['success' => 'Successfully updated appointment data.']);
    }

    public function destroy($id)
    {
        Book::where('id', $id)->delete();

        return response()->json(['success' => 'Successfully remove appointment.']);
    }
}
