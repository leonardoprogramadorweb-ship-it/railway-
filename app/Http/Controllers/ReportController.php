<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Si el usuario elige una fecha, usamos esa; de lo contrario, la fecha de hoy
        $selectedDate = $request->input('date', Carbon::today()->toDateString());

        // Consultar las ventas de la fecha seleccionada con sus detalles
        $sales = Sale::with('details.product')
            ->whereDate('created_at', $selectedDate)
            ->latest()
            ->get();

        // Calcular el total vendido en el día
        $totalSales = $sales->sum('total');

        return view('reports.index', compact('sales', 'totalSales', 'selectedDate'));
    }
}