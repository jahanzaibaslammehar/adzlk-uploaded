<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    /**
     * Store a new report.
     */
    public function store(Request $request): JsonResponse
    {
        // Log the incoming request for debugging
        Log::info('Report submission request', [
            'method' => $request->method(),
            'content_type' => $request->header('Content-Type'),
            'data' => $request->all(),
            'ip' => $request->ip()
        ]);

        $request->validate([
            'ad_id' => 'required|exists:ads,id',
            'reason' => 'required|string|in:inappropriate,spam,fake,offensive,illegal,duplicate,other',
            'description' => 'nullable|string|max:1000',
        ]);

        try {
            // Check if this IP has already reported this ad with the same reason recently (within 24 hours)
            // This allows multiple reports for different reasons but prevents spam
            $recentReport = Report::where('ad_id', $request->ad_id)
                ->where('reporter_ip', $request->ip())
                ->where('reason', $request->reason)
                ->where('created_at', '>=', now()->subDay())
                ->first();

            if ($recentReport) {
                return response()->json([
                    'success' => false,
                    'message' => 'You have already reported this ad for the same reason recently. Please wait 24 hours before reporting again with the same reason.'
                ], 429);
            }

            // Create the report
            $report = Report::create([
                'ad_id' => $request->ad_id,
                'reason' => $request->reason,
                'description' => $request->description,
                'reporter_ip' => $request->ip(),
                'reporter_user_agent' => $request->userAgent(),
                'status' => 'pending'
            ]);

            Log::info('Report created successfully', ['report_id' => $report->id]);

            return response()->json([
                'success' => true,
                'message' => 'Report submitted successfully! Thank you for helping us maintain quality.',
                'report_id' => $report->id
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating report', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while submitting the report. Please try again.'
            ], 500);
        }
    }

    /**
     * Get reports for an ad (admin only).
     */
    public function getAdReports($adId): JsonResponse
    {
        $reports = Report::where('ad_id', $adId)
            ->with('ad')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'reports' => $reports
        ]);
    }
}
