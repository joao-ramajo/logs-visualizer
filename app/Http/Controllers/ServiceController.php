<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\services\Loggers\MonologService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;

class ServiceController extends Controller
{
    public function __construct(
        protected MonologService $logger
    )
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return view('services.list', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('services.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'api_key' => 'required|string',
            'type' => 'required'
        ]);

        $api_key = Crypt::encryptString($request->input('api_key'));

        $service = new Service([
            'name' => $request->input('name'),
            'url' => $request->input('url'),
            'api_key' => $api_key,
            'type' => $request->input('type')
        ]);

        $service->save();

        return redirect()
            ->route('home')
            ->with('success', 'Serviço registrado com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Service::findOrFail($id);

        $api_key = Crypt::decryptString($service->api_key);

        try {
            $response = Http::withToken($api_key)
                ->acceptJson()
                ->get($service->url);

            $rawLogs = $response->successful() ? $response->json() : [];
        } catch (\Exception $e) {
            logger()->error('Erro ao buscar logs', ['exception' => $e]);
            $rawLogs = [
                [
                    'timestamp' => now()->toDateTimeString(),
                    'level' => 'ERROR',
                    'context' => 'ERROR',
                    'message' => 'Não foi possível obter os logs do serviço.'
                ]
            ];
        }
        $logs = $this->logger->handle($rawLogs);

        // dd($logs);

        return view('services.index', compact('service', 'logs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::findOrFail($id);

        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'api_key' => 'required|string',
            'type' => 'required'
        ]);

        $service = Service::findOrFail($id);
        
        $api_key = Crypt::encryptString($request->input('api_key'));

        $service->update([
            'name' => $request->input('name'),
            'url' => $request->input('url'),
            'api_key' => $api_key,
            'type' => $request->input('type')
        ]);

        return redirect()
            ->route('services.index')
            ->with('success', 'Serviço atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()
            ->route('services.index')
            ->with('success', 'Serviço removido com sucesso');
    }
}
