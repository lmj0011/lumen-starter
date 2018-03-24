<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

interface RestfulModelInterface {

    // HTTP VERB GET
    public function index(Request $request): JsonResponse;

    // HTTP VERB GET
    public function show(Request $request, $id): JsonResponse;

    // HTTP VERB PUT
    public function update(Request $request, $id): JsonResponse;

    // HTTP VERB POST
    public function store(Request $request): JsonResponse;

    // HTTP VERB DELETE
    public function destroy(Request $request, $id): JsonResponse;
}
