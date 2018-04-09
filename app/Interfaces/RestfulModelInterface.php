<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

interface RestfulModelInterface {

    /**
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse;

    /**
     * @param Request $request
     * @param mixed $id
     *
     * @return JsonResponse
     */
    public function show(Request $request, $id): JsonResponse;


    /**
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse;

    /**
     *
     * @param Request $request
     * @param mixed $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse;

    /**
     *
     * @param Request $request
     * @param mixed $id
     *
     * @return JsonResponse
     */
    public function destroy(Request $request, $id): JsonResponse;
}
