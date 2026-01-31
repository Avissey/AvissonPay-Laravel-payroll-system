<?php

namespace App\Livewire\Employer\Payroll;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Payroll;
use Livewire\Attributes\Title;

#[Title('Payroll List')]
class PayrollList extends Component
{
    use WithPagination;

    public $search = '';
    public $totalPayrolls;

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->totalPayrolls = Payroll::count();
    }

    public function deletePayroll($id)
    {
        $payroll = Payroll::findOrFail($id);
        $payroll->delete();

        session()->flash('message', 'Payroll record deleted successfully.');

        $this->totalPayrolls = Payroll::count(); // Update after delete
    }

    public function render()
    {
        $payrolls = Payroll::with('employee')
            ->whereHas('employee', function ($query) {
                $query->where('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);

        return view('livewire.employer.payroll.payroll-list', [
            'payrolls' => $payrolls,
            'totalPayrolls' => $this->totalPayrolls, //  fixed
        ]);
    }
}
