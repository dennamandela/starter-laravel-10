<?php

namespace App\Services\ExpenseVoucher;

use LaravelEasyRepository\Service;
use App\Repositories\ExpenseVoucher\ExpenseVoucherRepository;
use App\Repositories\ExpenseDetail\ExpenseDetailRepository;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Dompdf\Options;

class ExpenseVoucherServiceImplement extends Service implements ExpenseVoucherService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;
     protected $detailRepository;

    public function __construct(ExpenseVoucherRepository $mainRepository, ExpenseDetailRepository $detailRepository)
    {
      $this->mainRepository = $mainRepository;
      $this->detailRepository = $detailRepository;
    }

    public function getAll($perPage = 10)
    {
      try {
        $voucher = $this->mainRepository->all($perPage);

        return $voucher;
      } catch (\Exception $e) {
        throw $e;
      }
    }

    public function printPdf($id)
    {
        try {
            $voucher = $this->mainRepository->find($id);

            if (!$voucher) {
                throw new \Exception('Voucher tidak ditemukan');
            }

            $options = new Options();
            $options->set('isRemoteEnabled', true);
            $options->set('defaultFont', 'Arial');
            $options->set('chroot', public_path());

            $dompdf = new Dompdf($options);

            $html = view('print', compact('voucher'))->render();

            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            return [
                'dompdf' => $dompdf,
                'filename' => 'BUKTI_PENGELUARAN_' . $voucher->number . '.pdf'
            ];

        } catch (\Exception $e) {
          throw $e;
        }
      }

  public function getById($id)
  {
    try {
      $voucher = $this->mainRepository->find($id);
  
      return $voucher;
    } catch (\Exception $e) {
      throw $e;
    }
  }

  public function createVoucher($data)
  {
    DB::beginTransaction();

    try {

      if (empty($data['details'])) {
        throw new \Exception('Detail pengeluaran wajib diisi');
      }

      $total = collect($data['details'])->sum('amount');

      $number = 'BP-' . date('Ymd') . '-' . mt_rand(10,99) . time();
      $date = date('Y-m-d');

      $voucher = $this->mainRepository->create([
        'number' => $number,
        'date' => $date,
        'paid_to' => $data['paid_to'],
        'payment_method' => $data['payment_method'],
        'total' => $total,
        'notes' => $data['notes'] ?? null
      ]);

      foreach($data['details'] as $item) {
        $this->detailRepository->create([
          'expense_voucher_id' => $voucher->id,
          'description' => $item['description'],
          'amount' => $item['amount']
        ]);
      }

      DB::commit();
      return $voucher;

    } catch (\Exception $e) {
      DB::rollBack();
      throw $e;
    }
  }

  public function updateVoucher($id, $data)
  {
    DB::beginTransaction();

    try {

      $voucher = $this->mainRepository->find($id);

      if (!$voucher) {
        throw new \Exception('Voucher tidak ditemukan');
      }

      if (empty($data['details'])) {
        throw new \Exception('Detail pengeluaran wajib diisi');
      }

      // hitung ulang total
      $total = collect($data['details'])->sum('amount');

      // update HEADER
      $this->mainRepository->update($id, [
        'paid_to' => $data['paid_to'],
        'payment_method' => $data['payment_method'],
        'notes' => $data['notes'] ?? null,
        'total' => $total,
      ]);

      // 🔥 HAPUS DETAIL LAMA
      $voucher->details()->delete();

      // 🔥 INSERT DETAIL BARU
      foreach ($data['details'] as $item) {
        $this->detailRepository->create([
          'expense_voucher_id' => $voucher->id,
          'description' => $item['description'],
          'amount' => $item['amount'],
        ]);
      }

      DB::commit();
      return $voucher;

    } catch (\Exception $e) {
      DB::rollBack();
      throw $e;
    }
  }

  public function deleteVoucher($id)
  {
    DB::beginTransaction();
    try {
      $voucher = $this->mainRepository->find($id);

      $voucher = $this->mainRepository->delete($id);

      DB::commit();
      return $voucher;

    } catch (\Exception $e) {
      DB::rollBack();
      throw $e;
    }
  }

  public function getSearch($data, $perPage = 10)
  {
      $search = $data['search'] ?? null;

      return $this->mainRepository->search($search, $perPage);
  }
}
