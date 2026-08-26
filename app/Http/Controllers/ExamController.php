<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Consultation;
use App\Models\Animal;
use App\Http\Requests\ExamRequest;
use Illuminate\Support\Facades\Storage;

class ExamController extends Controller
{
    public function index(Request $request)
    {   
        $search = $request->get("search");

        $exams = Exam::with(['animal.tutor', 'consultation'])
            ->when($search, function ($query) use ($search){
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('laboratory', 'like', "%{$search}%")
                    ->orWhereHas('animal', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->orderBy('exam_date', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('exams.index', compact('exams', 'search'));
    }

    public function create()
    {
        $animals = Animal::with('tutor')->orderBy('name', 'asc')->get();
        $consultations = Consultation::with('animal')->orderBy('date_time', 'desc')->get();

        return view('exams.create', compact('animals', 'consultations'));
    }

    public function store(ExamRequest $request)
    {
        $data = $request->validated();
        
        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('exams', 'public');
        }

        Exam::create($data);

        return redirect()
            ->route('exams.index')
            ->with('success', 'Exame cadastrado e arquivo anexado com sucesso!');
    }

    public function show(Exam $exam)
    {
        $exam->load(['animal.tutor', 'consultation']);
        return view('exams.show', compact('exam'));
    }

    public function edit(Exam $exam)
    {
        $animals = Animal::with('tutor')->orderBy('name', 'asc')->get();
        $consultations = Consultation::with('animal')->orderBy('date_time', 'desc')->get();

        return view('exams.edit', compact('exam', 'animals', 'consultations'));
    }

    public function update(ExamRequest $request, Exam $exam)
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            if ($exam->file_path && Storage::disk('public')->exists($exam->file_path)) {
                Storage::disk('public')->delete($exam->file_path);
            }

            $data['file_path'] = $request->file('file')->store('exams', 'public');
        }

        $exam->update($data);

        return redirect()
            ->route('exams.index')
            ->with('success', 'Dados do exame e anexo atualizado com sucesso!');
        
    }

    public function destroy(Exam $exam)
    {
        if ($exam->file_path && Storage::disk('public')->exists($exam->file_path)) {
            Storage::disk('public')->delete($exam->file_path);
        }

        $exam->delete();

        return redirect()
            ->route('exams.index')
            ->with('success', 'Exame e arquivo anexo foram removidos com sucesso!');
    }
}
