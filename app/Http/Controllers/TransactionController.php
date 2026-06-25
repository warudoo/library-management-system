<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| CONTROLLER TRANSACTION
|--------------------------------------------------------------------------
|
| Mengatur alur peminjaman (borrow) ATAU penjualan (sale) item.
|
| Aturan akses:
| - User biasa : hanya lihat & buat transaksi miliknya sendiri,
|                 serta menyelesaikan (kembalikan) transaksinya sendiri.
| - Admin      : bisa lihat semua transaksi & mengubah status siapa saja.
|
| Aturan stok:
| - type = borrow : stok berkurang saat dibuat, BALIK lagi saat status
|                    diubah jadi "returned".
| - type = sale    : stok berkurang saat dibuat dan TIDAK balik lagi
|                    (barang sudah terjual/habis terpakai).
*/
class TransactionController extends Controller
{
    // Menampilkan daftar transaksi (admin lihat semua, user lihat miliknya saja)
    public function index(Request $request)
    {
        $query = Transaction::with(['item', 'user']);

        if (! auth()->user()->isAdmin()) {
            $query->where('user_id', auth()->id());
        }

        // Filter opsional: berdasarkan status atau tipe
        $query->when($request->status, fn ($q, $status) => $q->where('status', $status));
        $query->when($request->type, fn ($q, $type) => $q->where('type', $type));

        $transactions = $query->latest()->get();

        return view('transactions.index', compact('transactions'));
    }

    // Form pembuatan transaksi baru
    public function create()
    {
        // Hanya item dengan stok > 0 yang bisa ditransaksikan
        $items = Item::where('stock', '>', 0)->orderBy('name')->get();

        return view('transactions.create', compact('items'));
    }

    // Menyimpan transaksi baru + mengurangi stok item
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'type' => 'required|in:borrow,sale',
            'transaction_date' => 'required|date',
            'due_date' => 'nullable|date|after_or_equal:transaction_date',
            'notes' => 'nullable|string|max:500',
        ]);

        $item = Item::findOrFail($validated['item_id']);

        // Pastikan stok cukup sebelum transaksi dibuat
        if ($item->stock < $validated['quantity']) {
            return back()
                ->withInput()
                ->with('error', 'Stok tidak cukup. Sisa stok: '.$item->stock);
        }

        // due_date wajib ada kalau tipenya pinjam
        if ($validated['type'] === 'borrow' && empty($validated['due_date'])) {
            return back()
                ->withInput()
                ->with('error', 'Tanggal jatuh tempo wajib diisi untuk peminjaman.');
        }

        Transaction::create([
            'user_id' => auth()->id(),
            'item_id' => $item->id,
            'quantity' => $validated['quantity'],
            'type' => $validated['type'],
            'status' => $validated['type'] === 'borrow' ? 'active' : 'completed',
            'total_price' => $item->price * $validated['quantity'],
            'transaction_date' => $validated['transaction_date'],
            'due_date' => $validated['due_date'] ?? null,
            'notes' => $validated['notes'] ?? null,
        ]);

        // Stok langsung berkurang begitu transaksi dibuat
        $item->decrement('stock', $validated['quantity']);

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaksi berhasil dibuat.');
    }

    // Detail satu transaksi
    public function show(Transaction $transaction)
    {
        $this->authorizeOwner($transaction);

        return view('transactions.show', compact('transaction'));
    }

    // Mengubah status transaksi (mis. tandai "returned" / "cancelled")
    public function updateStatus(Request $request, Transaction $transaction)
    {
        $this->authorizeOwner($transaction);

        $request->validate([
            'status' => 'required|in:pending,active,returned,completed,cancelled',
        ]);

        $newStatus = $request->status;
        $wasActive = $transaction->status === 'active';

        $transaction->update([
            'status' => $newStatus,
            'completed_date' => in_array($newStatus, ['returned', 'completed'])
                ? now()->toDateString()
                : $transaction->completed_date,
        ]);

        // Kalau ini peminjaman dan baru saja ditandai "returned",
        // stok item dikembalikan ke gudang.
        if ($transaction->isBorrow() && $wasActive && $newStatus === 'returned') {
            $transaction->item->increment('stock', $transaction->quantity);
        }

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Status transaksi berhasil diperbarui.');
    }

    // Helper: hanya pemilik transaksi atau admin yang boleh mengakses
    private function authorizeOwner(Transaction $transaction): void
    {
        abort_unless(
            auth()->user()->isAdmin() || $transaction->user_id === auth()->id(),
            403,
            'Anda tidak punya akses ke transaksi ini.'
        );
    }
}
