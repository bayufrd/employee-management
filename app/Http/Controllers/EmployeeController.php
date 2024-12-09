<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeeImport;
use App\Models\Employee;
use App\Models\Company;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('index'); 
    }

    public function exportPdf($companyId)
    {
        $company = Company::with('employees')->findOrFail($companyId);

        $pdf = SnappyPdf::loadView('pdf.employees', compact('company'));
        return $pdf->download("employees_{$company->name}.pdf");
    }
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        Excel::import(new EmployeeImport, $request->file('file')->store('temp'));

        return redirect()->back()->with('success', 'Data berhasil diimport.');
    }
    public function getCompanies(Request $request)
    {
        $companies = Company::paginate(10); // Ambil data perusahaan dengan paginasi

        return response()->json([
            'data' => $companies->items(), // Data untuk halaman ini
            'pagination' => [
                'more' => $companies->hasMorePages() // Indikator jika masih ada data
            ]
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'company_id' => 'required|exists:companies,id',
        ]);

        Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'company_id' => $request->company_id,
        ]);

        return redirect()->back()->with('success', 'Employee added successfully.');
    }


}
