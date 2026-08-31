<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\Animal;
use App\Http\Requests\CertificateRequest;
use App\Models\Consultation;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get("search");

        $certificates = Certificate::with(['animal.tutor'])
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                ->orWhereHas('animal', function ($q) use ($search){
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->orderBy('issue_date', 'desc')
            ->paginate(10)
            ->withQueryString();
        return view('certificates.index', compact('certificates', 'search'));
    }

    public function create()
    {
        $animals = Animal::with('tutor')->orderBy('name', 'asc')->get();

        return view('certificates.create', compact('animals', 'certificates'));
    }

        public function store(CertificateRequest $request)
    {
        $data = $request->validated();
        
        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('certificates', 'public');
        }

        Certificate::create($data);

        return redirect()
            ->route('certificates.index')
            ->with('success', 'Atestado Médico cadastrado e arquivo anexado com sucesso!');
    }
    
    public function show(Certificate $certificate)
    {
        $certificate->load(['animal.tutor']);
        return view('certificates.show', compact('certificate'));
    }
}
