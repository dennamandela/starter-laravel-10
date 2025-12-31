<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseHelpers;
use App\Http\Requests\RequestExpense;
use App\Services\ExpenseVoucher\ExpenseVoucherService;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{

    private $expenseVoucherService;

    public function __construct(ExpenseVoucherService $expenseVoucherService)
    {
        $this->expenseVoucherService = $expenseVoucherService;
    }

    public function index(Request $request)
    {
        try {
            $voucher = $this->expenseVoucherService->getSearch(
                $request->all(),
                10
            );

            return view('receipt', compact('voucher'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong' . $e->getMessage());
        }
    }

    public function create()
    {
        $number = 'BP-' . date('Ymd') . '-' . rand(100,999);

        return view('form', compact('number'));
    }

    public function show($id)
    {
        $voucher = $this->expenseVoucherService->getById($id);

        if (!$voucher) {
            return redirect()
                ->route('expense-voucher')
                ->with('error', 'Data bon tidak ditemukan');
        }

        return view('detail', compact('voucher'));
    }

    public function store(Request $request)
    {
        $voucher = $this->expenseVoucherService->createVoucher($request->all());

        return redirect()->route('expense-voucher')->with('success', 'Bon pengeluaran berhasil disimpan');
    }

    public function print($id)
    {
        $result = $this->expenseVoucherService->printPdf($id);

        return response(
            $result['dompdf']->output(),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' =>
                    'inline; filename="'.$result['filename'].'"',
            ]
        );
    }

    public function edit($id)
    {
        $voucher = $this->expenseVoucherService->find($id);

        return view('edit', compact('voucher'));
    }

    public function update(Request $request, $id)
    {
        $this->expenseVoucherService->updateVoucher($id, $request->all());

        return redirect()
            ->route('expense-voucher')
            ->with('success', 'Bon berhasil diperbarui');
    }

    public function destroy($id)
    {
        try {
            $this->expenseVoucherService->deleteVoucher($id);
            return redirect()->route('expense-voucher')->with('success', 'Bon berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menghapus Bon. Error: ' . $e->getMessage());
        }
    }

    public function search(Request $request)
    {
        $voucher = $this->expenseVoucherService->getSearch(
            $request->only('search'),
            10
        );

        return view('receipt', compact('vouchers'));
    }
}
