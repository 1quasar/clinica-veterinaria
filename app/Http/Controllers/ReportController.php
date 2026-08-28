<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\Animal;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->get('start_date');
        $finishDate = $request->get('finish_date');
        $status     = $request->get('status');
        $veterinarianId = $request->get('veterinarian_id');

        $query = Consultation::with(['animal.tutor', 'veterinarian']);

        // Filtros dinâmicos encadeados via Eloquent
        $query->when($startDate, function ($q) use ($startDate) {
            return $q->whereDate('date_time', '>=', $startDate);
        });

        $query->when($finishDate, function ($q) use ($finishDate) {
            return $q->whereDate('date_time', '<=', $finishDate);
        });

        $query->when($status, function ($q) use ($status) {
            return $q->where('status', $status);
        });

        $query->when($veterinarianId, function ($q) use ($veterinarianId) {
            return $q->where('user_id', $veterinarianId);
        });

        $consultations = $query->orderBy('date_time', 'desc')->get();

        $veterinarians = User::where('role', 'veterinario')->get();

        return view('reports.index', compact(
            'consultations',
            'veterinarians',
            'startDate',
            'finishDate',
            'status',
            'veterinarianId'
        ));
    }


    public function exportPdf(Request $request)
    {
        $startDate = $request->get('start_date');
        $finishDate = $request->get('finish_date');
        $status     = $request->get('status');
        $veterinarianId = $request->get('veterinarian_id');

        $query = Consultation::with(['animal.tutor', 'veterinarian']);

        // Filtros dinâmicos encadeados via Eloquent
        $query->when($startDate, function ($q) use ($startDate) {
            return $q->whereDate('date_time', '>=', $startDate);
        });

        $query->when($finishDate, function ($q) use ($finishDate) {
            return $q->whereDate('date_time', '<=', $finishDate);
        });

        $query->when($status, function ($q) use ($status) {
            return $q->where('status', $status);
        });

        $query->when($veterinarianId, function ($q) use ($veterinarianId) {
            return $q->where('user_id', $veterinarianId);
        });

        $consultations = $query->orderBy('date_time', 'desc')->get();

        $revenueTotal = $consultations->where('status', 'concluida')->sum('value');

        // Carrega a view Blade formatada para impressão
        $pdf = Pdf::loadView('reports.pdf', compact('consultations', 'revenueTotal', 'startDate', 'finishDate'));

        // Retorna a exibição direta no navegador (stream)
        return $pdf->stream('report-consultations-' . date('d-m-Y') . '.pdf');
    }
}
