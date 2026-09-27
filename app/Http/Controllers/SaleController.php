<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('details.product')->latest()->get();
        
        return view('sales.index', compact('sales'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // 1. Crear la venta principal
            $sale = Sale::create([
                'total' => $request->total,
                'pago_con' => $request->pago_con ?? $request->total,
                'cambio' => $request->cambio ?? 0,
                'metodo_pago' => $request->payment_method ?? 'Efectivo',
            ]);

            // 2. Guardar los detalles y descontar stock
            foreach ($request->items as $item) {
                SaleDetail::create([
                    'sale_id' => $sale->id,
                    'product_id' => $item['id'],
                    'cantidad' => $item['quantity'],
                    'precio_unitario' => $item['price'],
                    'subtotal' => $item['quantity'] * $item['price'],
                ]);

                // Descontar stock del producto
                $product = Product::find($item['id']);
                if ($product) {
                    $product->stock -= $item['quantity'];
                    $product->save();
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => '¡Venta realizada con éxito!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar la venta: ' . $e->getMessage()
            ], 500);
        }
    }
}