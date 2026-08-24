<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutor;
use App\Http\Requests\TutorRequest;

class TutorController extends Controller
{
    /**
     *  Lista os tutores com paginação e barra de pesquisa
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $tutors = Tutor::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%{$search}%')
                    ->orWhere('cpf', 'like', '%{$search}%');
            })
            ->orderBy('name', 'asc')
            ->paginate(10)
            ->withQueryString();

        return view('tutors.index', compact('tutors', 'search'));
    }

    /**
     * Mostra o formulário de cadastro
     */
    public function create()
    {
        return view('tutors.create');
    }

    /**
     * Salva os dados validados no banco
     */
    public function store(TutorRequest $request)
    {
        Tutor::create($request->validated());

        return redirect()
            ->route('tutors.index')
            ->with('success', 'Tutor cadastrado com sucesso!');
    }

    /**
     * Mostra detalhes de um Tutor
     */
    public function show(Tutor $tutor)
    {
        return view('tutors.show', ['tutor' => $tutor]);
    }

    /**
     * Mostra o formulário de edição
     */
    public function edit(Tutor $tutor)
    {
        return view('tutors.edit', ['tutor' => $tutor]);
    }

    /**
     * Atualiza os dados validados no banco
     */
    public function update(TutorRequest $request, Tutor $tutor)
    {
        $tutor->update($request->validated());

        return redirect()
            ->route('tutors.index')
            ->with('success', 'Tutor atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tutor $tutor)
    {
        $tutor->delete();

        return redirect()
            ->route('tutors.index')
            ->with('success', 'Tutor excluído com sucesso!');
    }
}
