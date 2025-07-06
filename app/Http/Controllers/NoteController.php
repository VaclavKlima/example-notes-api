<?php

namespace App\Http\Controllers;

use App\Enums\NotePriorityEnum;
use App\Http\Requests\NoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\Rule;

class NoteController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $request->validate([
            'priority' => [
                'nullable',
                'string',
                Rule::enum(NotePriorityEnum::class)
            ],
        ]);


        return NoteResource::collection(
            resource: Note::query()
                ->when(
                    value: $request->filled('priority'),
                    callback: static fn($query) => $query->where('priority', $request->input('priority'))
                )
                ->latest()
                ->get()
        );
    }

    public function store(NoteRequest $request): NoteResource
    {
        return new NoteResource(Note::create($request->validated()));
    }

    public function show(Note $note): NoteResource
    {
        return new NoteResource($note);
    }

    public function update(NoteRequest $request, Note $note): NoteResource
    {
        $note->update($request->validated());

        return new NoteResource($note);
    }

    public function destroy(Note $note): JsonResponse
    {
        $note->delete();

        return response()->json();
    }
}
