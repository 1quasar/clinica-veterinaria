<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\Animal;
use App\Http\Requests\CertificateRequest;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get("search");

        $certificates = Certificate::with(['animal.tutor','certificate'])
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
}
