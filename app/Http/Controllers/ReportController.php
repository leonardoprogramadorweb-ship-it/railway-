<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Si el usuario elige una fecha, la usamos; de lo contrario, la fecha de hoy
        $inputDate = $request->input('date', Carbon::today()->toDateString());
        
        try {
            $selectedDate = Carbon::parse($inputDate)->toDateString();
        } catch (\Exception $e) {
            $selectedDate = Carbon::today()->toDateString();
        }

        // Consultar las ventas de la fecha seleccionada con sus detalles
        $sales = Sale::with('details.product')
            ->whereDate('created_at', $selectedDate)
            ->latest()
            ->get();

        // Calcular el total vendido en el día
        $totalSales = $sales->sum('total');

        return view('reports.index', compact('sales', 'totalSales', 'selectedDate'));
    }

    public function destroyByDate(Request $request)
    {
        $date = $request->input('date');

        if ($date) {
            Sale::whereDate('created_at', $date)->delete();
        }

        return redirect()->route('reports.index', ['date' => $date])->with('success', 'Los reportes de la fecha seleccionada han sido eliminados correctamente.');
    }
}