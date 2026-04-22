<?php

namespace App\Http\Controllers;

use App\Models\RealEstateUnit;
use App\Models\Client;
use App\Models\ClientProperty;
use App\Models\ClientTransaction;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RealEstateController extends Controller
{
    // ------------------------------------------------------------------
    // Real Estate Units
    // ------------------------------------------------------------------

    /**
     * Get all real estate units, ordered by most recently created.
     */
    public function indexUnits(): JsonResponse
    {
        // Using latest() respects the model's CREATED_AT constant ('created_on')
        $units = RealEstateUnit::latest()->get();
        return response()->json($units);
    }

    /**
     * Store a new real estate unit.
     */
    public function storeUnit(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'real_estate_unit_name'      => 'required|string|max:255|unique:real_estate_units',
            'real_estate_location'       => 'required|string|max:255',
            'real_estate_license_number' => 'nullable|string|max:100|unique:real_estate_units',
            'real_estate_valuation'      => 'required|numeric|min:0',
            'real_estate_ownership'      => 'required|string|max:100',
            'real_estate_status'         => 'required|in:Available,Sold,Reserved',
        ]);

        $validated['created_by'] = Auth::id() ?? 1;

        $unit = RealEstateUnit::create($validated);
        return response()->json($unit, 201);
    }

    /**
     * Display a specific real estate unit.
     */
    public function showUnit(RealEstateUnit $unit): JsonResponse
    {
        return response()->json($unit);
    }

    /**
     * Update an existing real estate unit.
     */
    public function updateUnit(Request $request, RealEstateUnit $unit): JsonResponse
    {
        $validated = $request->validate([
            'real_estate_unit_name'      => "sometimes|string|max:255|unique:real_estate_units,real_estate_unit_name,{$unit->real_estate_unit_id},real_estate_unit_id",
            'real_estate_location'       => 'sometimes|string|max:255',
            'real_estate_license_number' => "nullable|string|max:100|unique:real_estate_units,real_estate_license_number,{$unit->real_estate_unit_id},real_estate_unit_id",
            'real_estate_valuation'      => 'sometimes|numeric|min:0',
            'real_estate_ownership'      => 'sometimes|string|max:100',
            'real_estate_status'         => 'sometimes|in:Available,Sold,Reserved',
        ]);

        $unit->update($validated);
        return response()->json($unit);
    }

    /**
     * Delete a real estate unit.
     */
    public function destroyUnit(RealEstateUnit $unit): JsonResponse
    {
        $unit->delete();
        return response()->json(['message' => 'Unit deleted successfully']);
    }

    // ------------------------------------------------------------------
    // Count Endpoints
    // ------------------------------------------------------------------

    /**
     * Get total count of all real estate units.
     */
    public function countAllRealEstate(): JsonResponse
    {
        return response()->json(['total' => RealEstateUnit::count()]);
    }

    /**
     * Get count of sold real estate units.
     */
    public function countSoldRealEstate(): JsonResponse
    {
        return response()->json(['sold' => RealEstateUnit::where('real_estate_status', 'Sold')->count()]);
    }

    /**
     * Get count of available real estate units.
     */
    public function countAvailableRealEstate(): JsonResponse
    {
        return response()->json(['available' => RealEstateUnit::where('real_estate_status', 'Available')->count()]);
    }

    // ------------------------------------------------------------------
    // Clients
    // ------------------------------------------------------------------

    /**
     * Get all clients with their properties and transactions.
     */
    public function getAllClients(): JsonResponse
    {
        $clients = Client::with(['properties.unit', 'properties.transactions'])
            ->latest() // uses created_on
            ->get();

        $clients->each->append('full_name');

        return response()->json($clients);
    }

    /**
     * Store a new client.
     */
    public function storeClient(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'real_estate_fname'     => 'required|string|max:100',
            'real_estate_lname'     => 'required|string|max:100',
            'real_estate_email'     => 'required|email|unique:real_estate_clients,real_estate_email',
            'real_estate_phone'     => 'required|string|max:20|unique:real_estate_clients,real_estate_phone',
            'real_estate_id_number' => 'required|string|unique:real_estate_clients,real_estate_id_number',
            'real_estate_KRA'       => 'nullable|string|max:50|unique:real_estate_clients,real_estate_KRA',
            'real_estate_status'    => 'sometimes|in:Active,Inactive',
        ]);

        $validated['created_by'] = Auth::id() ?? 1;

        $client = Client::create($validated);
        return response()->json($client, 201);
    }

    /**
     * Display a specific client with properties and transactions.
     */
    public function showClient(Client $client): JsonResponse
    {
        $client->load(['properties.unit', 'properties.transactions']);
        $client->append('full_name');
        return response()->json($client);
    }

    /**
     * Update an existing client.
     */
    public function updateClient(Request $request, Client $client): JsonResponse
    {
        $validated = $request->validate([
            'real_estate_fname'     => 'sometimes|string|max:100',
            'real_estate_lname'     => 'sometimes|string|max:100',
            'real_estate_email'     => "sometimes|email|unique:real_estate_clients,real_estate_email,{$client->real_estate_client_id},real_estate_client_id",
            'real_estate_phone'     => "sometimes|string|max:20|unique:real_estate_clients,real_estate_phone,{$client->real_estate_client_id},real_estate_client_id",
            'real_estate_id_number' => "sometimes|string|unique:real_estate_clients,real_estate_id_number,{$client->real_estate_client_id},real_estate_client_id",
            'real_estate_KRA'       => "nullable|string|max:50|unique:real_estate_clients,real_estate_KRA,{$client->real_estate_client_id},real_estate_client_id",
            'real_estate_status'    => 'sometimes|in:Active,Inactive',
        ]);

        $client->update($validated);
        return response()->json($client);
    }

    /**
     * Delete a client.
     */
    public function destroyClient(Client $client): JsonResponse
    {
        $client->delete();
        return response()->json(['message' => 'Client deleted successfully']);
    }

    // ------------------------------------------------------------------
    // Client Properties
    // ------------------------------------------------------------------

    /**
     * Assign a property (unit) to a client.
     */
    public function storeProperty(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'real_estate_client'         => 'required|exists:real_estate_clients,real_estate_client_id',
            'real_estate_unit'           => 'required|exists:real_estate_units,real_estate_unit_id',
            'real_estate_purchase_date'  => 'required|date',
            'real_estate_purchase_amount'=> 'required|numeric|min:0',
            'real_estate_purchase_status'=> 'sometimes|in:Pending,Completed,Cancelled',
        ]);

        $validated['created_by'] = Auth::id() ?? 1;

        $property = ClientProperty::create($validated);
        return response()->json($property, 201);
    }

    /**
     * Update a client property assignment.
     */
    public function updateProperty(Request $request, ClientProperty $property): JsonResponse
    {
        $validated = $request->validate([
            'real_estate_purchase_date'  => 'sometimes|date',
            'real_estate_purchase_amount'=> 'sometimes|numeric|min:0',
            'real_estate_purchase_status'=> 'sometimes|in:Pending,Completed,Cancelled',
        ]);

        $property->update($validated);
        return response()->json($property);
    }

    /**
     * Delete a client property assignment.
     */
    public function destroyProperty(ClientProperty $property): JsonResponse
    {
        $property->delete();
        return response()->json(['message' => 'Property assignment deleted']);
    }

    // ------------------------------------------------------------------
    // Client Transactions
    // ------------------------------------------------------------------

    /**
     * Record a new transaction for a client property.
     */
    public function storeTransaction(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'real_estate_property' => 'required|exists:real_estate_client_properties,real_estate_property_id',
            'transaction_amount'   => 'required|numeric|min:0',
            'transaction_date'     => 'required|date',
            'transaction_status'   => 'sometimes|in:Pending,Completed,Failed',
            'transaction_type'     => 'required|string|max:50',
            'transaction_mode'     => 'required|string|max:50',
            'transaction_code'     => 'required|string|unique:real_estate_client_transactions,transaction_code',
        ]);

        $validated['created_by'] = Auth::id() ?? 1;

        $transaction = ClientTransaction::create($validated);
        return response()->json($transaction, 201);
    }

    /**
     * Update an existing transaction.
     */
    public function updateTransaction(Request $request, ClientTransaction $transaction): JsonResponse
    {
        $validated = $request->validate([
            'transaction_amount'   => 'sometimes|numeric|min:0',
            'transaction_date'     => 'sometimes|date',
            'transaction_status'   => 'sometimes|in:Pending,Completed,Failed',
            'transaction_type'     => 'sometimes|string|max:50',
            'transaction_mode'     => 'sometimes|string|max:50',
            'transaction_code'     => "sometimes|string|unique:real_estate_client_transactions,transaction_code,{$transaction->real_estate_transaction_id},real_estate_transaction_id",
        ]);

        $transaction->update($validated);
        return response()->json($transaction);
    }

    /**
     * Delete a transaction.
     */
    public function destroyTransaction(ClientTransaction $transaction): JsonResponse
    {
        $transaction->delete();
        return response()->json(['message' => 'Transaction deleted']);
    }
}
