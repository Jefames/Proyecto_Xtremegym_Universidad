<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ClienteMembresia;
use App\Models\Membresia;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


class ClienteMembresiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clienteMembresias = ClienteMembresia::with('cliente','membresia')->get();
        $membresias = Membresia::all();
        return view('services.suscripciones.index',compact('clienteMembresias', 'membresias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::whereDoesntHave('suscripciones', function($query) {
            $query->where('estado', 'activa');
        })->get();
        $membresias = Membresia::all();
        return view('services.suscripciones.create', compact('clientes','membresias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'membresia_id' => 'required|exists:membresias,id',
            'fecha_inicio' => 'required|date',
            'fecha_finalizacion' => 'required|date',
            'subtotal' => 'numeric',
            'total' => 'numeric',
            'metodo_pago' => 'required|in:efectivo',
        ]);
    
        // Crear una nueva instancia del modelo ClienteMembresia
        $clienteMembresia = new ClienteMembresia();
        
        // Asignar valores al modelo
        $clienteMembresia->cliente_id = $validatedData['cliente_id'];
        $clienteMembresia->membresia_id = $validatedData['membresia_id'];
        $clienteMembresia->fecha_inicio = $validatedData['fecha_inicio'];
        $clienteMembresia->fecha_finalizacion = $validatedData['fecha_finalizacion'];
        $clienteMembresia->subtotal = $validatedData['subtotal'];
        $clienteMembresia->total = $validatedData['total'];
        $clienteMembresia->metodo_pago = $validatedData['metodo_pago'];
        
        // Guardar en la base de datos
        $clienteMembresia->save();
    
        return redirect()->route('suscripciones.index')->with('success', 'Suscripción creada con éxito');
    }
    
    public function suspender($id)
    {
        // Buscar la suscripción
        $suscripcion = ClienteMembresia::findOrFail($id);

        // Verificar si ya está suspendida
        if ($suscripcion->estado == 'inactiva') {
            return redirect()->route('suscripciones.index')->with('error', 'La suscripción ya está suspendida.');
        }

        // Cambiar el estado a inactiva
        $suscripcion->estado = 'inactiva';
        $suscripcion->save();

        return redirect()->route('suscripciones.index')->with('success', 'Suscripción suspendida con éxito.');
    }

    public function indexPagos()
    {
        $pagos = ClienteMembresia::with(['cliente', 'membresia'])->get();
        return view('services.pagos.index', compact('pagos'));
    }

    public function reportesPagos()
    {
        return view('services.pagos.reportes');
    }

    // GENERAR REPORTES EN PDF O EXCEL
    public function generarReportePagos(Request $request)
    {
        $validatedData = $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'tipo_reporte' => 'required',
        ]);

        // Consultar las suscripciones (ClienteMembresia) dentro del rango de fechas seleccionado
        $data = ClienteMembresia::with(['cliente', 'membresia'])->whereBetween('fecha_inicio', [$validatedData['fecha_inicio'], $validatedData['fecha_fin']])->get();

        if ($validatedData['tipo_reporte'] == 'pdf') {
            // Generar reporte en PDF
            $clienteMembresias = $data->toArray();
            $form_data = $validatedData;
            $pdf = Pdf::loadView('services.pagos.reporte_pdf', compact('form_data', 'clienteMembresias'));
            return $pdf->stream('reporte_pagos.pdf');
        } else if ($validatedData['tipo_reporte'] == 'excel') {
            // Generar reporte en Excel
            $export = new class($data) implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithEvents
            {
                use RegistersEventListeners;
                private $data;

                public function __construct($data)
                {
                    $this->data = $data;
                }

                public function collection()
                {
                    return $this->data->map(function ($item, $index) {
                        return [
                            'No' => $index + 1,
                            'Cliente' => $item->cliente->nombre . ' ' . $item->cliente->apellido,
                            'Membresía' => $item->membresia->tipomem,
                            'Fecha de Facturación' => $item->fecha_inicio ?: 'N/A',
                            'Monto' => $item->total ?: 'N/A',
                        ];
                    });
                }

                public function headings(): array
                {
                    return [
                        'No',
                        'Cliente',
                        'Membresía',
                        'Fecha de Facturación',
                        'Monto',
                    ];
                }

                public function styles(Worksheet $sheet)
                {
                    $sheet->getStyle('A1:E1')->applyFromArray([
                        'font' => [
                            'bold' => true,
                        ],
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => [
                                'argb' => 'FFFF00', // Color amarillo para los encabezados
                            ],
                        ],
                    ]);
                }

                public static function beforeSheet(BeforeSheet $event)
                {
                    $drawing = new Drawing();
                    $drawing->setName('Logo');
                    $drawing->setDescription('Logo de la Empresa');
                    $drawing->setPath(public_path('assets/img/logo.png')); // Ruta al logo
                    $drawing->setHeight(60); // Ajusta la altura del logo
                    $drawing->setCoordinates('A1');
                    $drawing->setWorksheet($event->sheet->getDelegate());
                    // Insertar filas adicionales al principio
                    $event->sheet->getDelegate()->insertNewRowBefore(2, 2);
                }

                public function registerEvents(): array
                {
                    return [
                        BeforeSheet::class => [self::class, 'beforeSheet'],
                    ];
                }
            };

            return Excel::download($export, 'reporte_pagos_' . $validatedData['fecha_inicio'] . '_al_' . $validatedData['fecha_fin'] . '.xlsx');
        }
    }

        public function mostrarPago($id)
    {
        $pago = ClienteMembresia::with(['cliente', 'membresia'])->findOrFail($id);
        
        return view('services.pagos.show', compact('pago'));
    }


        public function generarFactura($id)
    {
        // Obtener los detalles del pago (ClienteMembresia) y cargar la relación del cliente y la membresía
        $pago = ClienteMembresia::with(['cliente', 'membresia'])->findOrFail($id);

        // Generar el PDF usando la vista 'services.pagos.factura_pdf'
        $pdf = Pdf::loadView('services.pagos.factura_pdf', compact('pago'));

        // Descargar el PDF como archivo
        return $pdf->download('factura_cliente_' . $pago->cliente->nombre . '.pdf');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
