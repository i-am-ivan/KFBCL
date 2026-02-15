<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'first_name' => 'required|string|max:100',
                'last_name' => 'required|string|max:100',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'type' => 'required|string|max:255',
                'date' => 'required|date', // Changed from appointment_date
                'time' => 'required',      // Changed from appointment_time
                'company' => 'nullable|string|max:255', // Changed from company_name
                'priority' => 'required|in:Low,Normal,High,Urgent'
            ]);

            // Combine date and time
            $appointmentDateTime = $request->date . ' ' . $request->time . ':00';

            // Map Urgent to Critical for database
            $priority = $request->priority === 'Urgent' ? 'Critical' : $request->priority;

            // Create the appointment
            $appointment = Appointment::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $this->formatPhone($request->phone),
                'type' => $request->type,
              'appointment_date' => $appointmentDateTime,
                'company_name' => $request->company, // Changed from company_name
                'priority' => $priority,
                'status' => 'Pending',
                'created_by' => Auth::id(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Appointment scheduled successfully!',
                'appointment_id' => $appointment->appointment_id
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    private function formatPhone($phone)
    {
        $phone = preg_replace('/\D/', '', $phone);

        if (strlen($phone) === 9 && (str_starts_with($phone, '7') || str_starts_with($phone, '1'))) {
            return '+254' . $phone;
        } elseif (strlen($phone) === 10 && str_starts_with($phone, '0')) {
            return '+254' . substr($phone, 1);
        } elseif (strlen($phone) === 12 && str_starts_with($phone, '254')) {
            return '+' . $phone;
        }

        return $phone;
    }

    // Get all appointments in JSON format
    public function getAllAppointments()
    {
        try {
            $appointments = Appointment::orderBy('appointment_date', 'desc')
                ->get()
                ->map(function ($appointment) {
                    return [
                        'id' => $appointment->id,
                        'referenceId' => $appointment->appointment_id,
                        'applicantName' => $appointment->first_name . ' ' . $appointment->last_name,
                        'applicantEmail' => $appointment->email,
                        'applicantPhone' => $appointment->phone,
                        'appointmentType' => $appointment->type,
                        'appointmentDate' => date('d M, Y', strtotime($appointment->appointment_date)),
                        'appointmentTime' => date('g:i A', strtotime($appointment->appointment_date)),
                        'subject' => $appointment->company_name ?: 'None',
                        'priority' => $this->mapPriority($appointment->priority),
                        'status' => ucfirst($appointment->status),
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $appointments
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving appointments: ' . $e->getMessage()
            ], 500);
        }
    }

    // Get today's confirmed appointments for the current user
    public function getMyTodayConfirmedAppointments()
    {
        try {
            $userId = Auth::id();
            $today = now()->format('Y-m-d');

            $appointments = Appointment::where('created_by', $userId)
                ->where('status', 'Confirmed')
                ->whereDate('appointment_date', $today)
                ->orderBy('appointment_date', 'asc')
                ->get()
                ->map(function ($appointment) {
                    return [
                        'id' => $appointment->id,
                        'referenceId' => $appointment->appointment_id,
                        'applicantName' => $appointment->first_name . ' ' . $appointment->last_name,
                        'applicantEmail' => $appointment->email,
                        'applicantPhone' => $appointment->phone,
                        'appointmentType' => $appointment->type,
                        'appointmentDate' => date('d M, Y', strtotime($appointment->appointment_date)),
                        'appointmentTime' => date('g:i A', strtotime($appointment->appointment_date)),
                        'subject' => $appointment->company_name ?: 'None',
                        'priority' => $this->mapPriority($appointment->priority),
                        'status' => ucfirst($appointment->status),
                        'createdBy' => $appointment->created_by,
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $appointments
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving today\'s confirmed appointments: ' . $e->getMessage()
            ], 500);
        }
    }

    // Get today's confirmed appointments for the current user - Top 10
    public function getMyTodayConfirmedTop10()
    {
        try {
            $userId = Auth::id();
            $today = now()->format('Y-m-d');

            $appointments = Appointment::where('created_by', $userId)
                ->where('status', 'Confirmed')
                ->whereDate('appointment_date', $today)
                ->orderBy('appointment_date', 'asc')
                ->limit(10)
                ->get()
                ->map(function ($appointment) {
                    return [
                        'id' => $appointment->id,
                        'referenceId' => $appointment->appointment_id,
                        'applicantName' => $appointment->first_name . ' ' . $appointment->last_name,
                        'applicantEmail' => $appointment->email,
                        'applicantPhone' => $appointment->phone,
                        'appointmentType' => $appointment->type,
                        'appointmentDate' => date('d M, Y', strtotime($appointment->appointment_date)),
                        'appointmentTime' => date('g:i A', strtotime($appointment->appointment_date)),
                        'subject' => $appointment->company_name ?: 'None',
                        'priority' => $this->mapPriority($appointment->priority),
                        'status' => ucfirst($appointment->status),
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $appointments
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving today\'s confirmed appointments: ' . $e->getMessage()
            ], 500);
        }
    }

    // Helper method to map database priority to frontend format
    private function mapPriority($priority)
    {
        $mapping = [
            'High' => 'high',
            'Normal' => 'normal',
            'Low' => 'low',
            'Critical' => 'urgent'
        ];

        return $mapping[$priority] ?? 'normal';
    }

    // Get dashboard stats (all in one) - Return JSON ONLY
    public function getDashboardStats(Request $request)
    {
        try {
            // 1. Count all appointments
            $totalAppointments = Appointment::count();

            // 2. Count all appointments for TODAY (not just confirmed, ALL appointments today)
            $today = now()->format('Y-m-d');
            $todayAppointments = Appointment::whereDate('appointment_date', $today)->count();

            // 3. Count all appointments with status = "Pending"
            $pendingAppointments = Appointment::where('status', 'Pending')->count();

            // Return JSON response
            return response()->json([
                'success' => true,
                'data' => [
                    'total_appointments' => $totalAppointments,
                    'today_appointments' => $todayAppointments, // Changed from today_confirmed
                    'pending_appointments' => $pendingAppointments, // Changed from upcoming_pending
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving stats: ' . $e->getMessage()
            ], 500);
        }
    }

    // Update appointment
    public function update(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'appointmentID' => 'required|string|exists:appointments,appointment_id',
                'newDate' => 'required|date',
                'newTime' => 'required',
                'newStatus' => 'required|in:Pending,Confirmed,Cancelled,Completed,Rescheduled'
            ]);

            $userId = Auth::id();

            // Find the appointment
            $appointment = Appointment::where('appointment_id', $request->appointmentID)
                ->where('created_by', $userId)
                ->first();

            if (!$appointment) {
                return response()->json([
                    'success' => false,
                    'message' => 'Appointment not found or you do not have permission to update it.'
                ], 404);
            }

            // Combine date and time
            $appointmentDateTime = $request->newDate . ' ' . $request->newTime . ':00';

            // Update the appointment with updated_at timestamp
            $appointment->update([
                'appointment_date' => $appointmentDateTime,
                'status' => $request->newStatus,
                'updated_at' => now(), // Add this line to update the timestamp
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Appointment updated successfully!',
                'data' => [
                    'appointment_id' => $appointment->appointment_id,
                    'new_date' => date('d M, Y', strtotime($appointmentDateTime)),
                    'new_time' => date('g:i A', strtotime($appointmentDateTime)),
                    'new_status' => $request->newStatus,
                    'updated_at' => $appointment->updated_at->toDateTimeString()
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Delete appointment
    public function destroy(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'appointmentID' => 'required|string|exists:appointments,appointment_id'
            ]);

            $userId = Auth::id();

            // Find and delete the appointment
            $appointment = Appointment::where('appointment_id', $request->appointmentID)
                ->where('created_by', $userId)
                ->first();

            if (!$appointment) {
                return response()->json([
                    'success' => false,
                    'message' => 'Appointment not found or you do not have permission to delete it.'
                ], 404);
            }

            $appointmentId = $appointment->appointment_id;
            $appointment->delete();

            return response()->json([
                'success' => true,
                'message' => 'Appointment deleted successfully!',
                'data' => [
                    'deleted_appointment_id' => $appointmentId
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
