<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    public function index()
    {
        $approvals = Approval::with(['booking', 'approver'])->get();
        return view('approvals.index', compact('approvals'));
    }

    public function show(Approval $approval)
    {
        $approval->load(['booking', 'approver']);
        return view('approvals.show', compact('approval'));
    }

    public function edit(Approval $approval)
    {
        return view('approvals.edit', compact('approval'));
    }

    public function update(Request $request, Approval $approval)
    {
        $data = $request->validate([
            'status' => 'required|in:approved,rejected',
            'note' => 'nullable|string',
        ]);
        $approval->update($data);
        // Update status booking jika semua approval sudah approved
        $booking = $approval->booking;
        if ($booking->approvals()->where('status', 'pending')->count() == 0 && $booking->approvals()->where('status', 'rejected')->count() == 0) {
            $booking->update(['status' => 'approved']);
        } elseif ($booking->approvals()->where('status', 'rejected')->count() > 0) {
            $booking->update(['status' => 'rejected']);
        }
        return redirect()->route('approvals.index')->with('success', 'Approval berhasil diproses.');
    }

    public function destroy(Approval $approval)
    {
        $approval->delete();
        return redirect()->route('approvals.index')->with('success', 'Approval berhasil dihapus.');
    }

    public function history()
    {
        $approvals = Approval::where('approver_id', auth()->id())->with(['booking', 'approver'])->latest()->paginate(20);
        return view('approvals.history', compact('approvals'));
    }
} 