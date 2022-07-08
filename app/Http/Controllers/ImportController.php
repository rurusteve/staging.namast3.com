<?php

namespace App\Http\Controllers;
use App\Imports\ImportClientData;
use App\Imports\TimeReportImport;
use App\Imports\UserImport;
use App\TimeReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class ImportController extends Controller
{
    public function importExport()
    {
        $nip = Auth::user()->nip;
        $nama = DB::table('masteremployee')
            ->where('nip', '=', $nip)->pluck('nama')
            ->implode('nama');
        return view('importExport')->with('nama', $nama);
    }

    public function import(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Excel::import(new PesertaImportCollection, $file);
            Excel::import(new TimeReportImport(), $file);


            return redirect('/timesheets/main')->with('successalert', 'Time report anda berhasil disimpan');
        } else {
            return redirect('home');
        }
    }
    public function importExportClient()
    {
        return view('importExportClient');
    }

    public function importClient(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Excel::import(new PesertaImportCollection, $file);
            // Excel::import(new PesertaImport, $file);
            Excel::import(new ImportClientData(), $file);


            return redirect('/administration/timereport/clients');
        } else {
            return redirect('home');
        }
    }

    public function importUsers(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Excel::import(new PesertaImportCollection, $file);
            // Excel::import(new PesertaImport, $file);
            Excel::import(new UserImport(), $file);

            return redirect('/home');
        } else {
            return redirect('/');
        }
    }
    public function getImport()
    {
        return view('importemployee');
    }

    public function parseImport(CsvImportRequest $request)
    {

        $path = $request->file('csv_file')->getRealPath();

        if ($request->has('header')) {
            $data = Excel::load($path, function($reader) {})->get()->toArray();
        } else {
            $data = array_map('str_getcsv', file($path));
        }


        if (count($data) > 0) {
            if ($request->has('header')) {
                $csv_header_fields = [];
                foreach ($data[0] as $key => $value) {
                    $csv_header_fields[] = $key;
                }
            }
            $csv_data = array_slice($data, 0, 200);

            $csv_data_file = CsvData::create([
                'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
                'csv_header' => $request->has('header'),
                'csv_data' => json_encode($data)
            ]);
        } else {
            return redirect()->back();
        }

        return view('import_fields', compact( 'csv_header_fields', 'csv_data', 'csv_data_file'));

    }

    public function processImport(Request $request)
    {
        $data = CsvData::find($request->csv_data_file_id);
        $csv_data = json_decode($data->csv_data, true);
        foreach ($csv_data as $row) {
            $contact = new MasterEmployee();
            foreach (config('app.db_fields') as $index => $field) {
                if ($data->csv_header) {
                    $contact->$field = $row[$request->fields[$field]];
                } else {
                    $contact->$field = $row[$request->fields[$index]];
                }
            }
            $contact->save();
        }

        return view('import_success');
    }

    public function getImportBiodata()
    {
        return view('importbiodata');
    }

    public function parseImportBiodata(CsvImportRequest $request)
    {

        $path = $request->file('csv_file')->getRealPath();

        if ($request->has('header')) {
            $data = Excel::load($path, function($reader) {})->get()->toArray();
        } else {
            $data = array_map('str_getcsv', file($path));
        }


        if (count($data) > 0) {
            if ($request->has('header')) {
                $csv_header_fields = [];
                foreach ($data[0] as $key => $value) {
                    $csv_header_fields[] = $key;
                }
            }
            $csv_data = array_slice($data, 0, 200);

            $csv_data_file = CsvData::create([
                'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
                'csv_header' => $request->has('header'),
                'csv_data' => json_encode($data)
            ]);
        } else {
            return redirect()->back();
        }

        return view('import_fields_biodata', compact( 'csv_header_fields', 'csv_data', 'csv_data_file'));

    }

    public function processImportBiodata(Request $request)
    {
        $data = CsvData::find($request->csv_data_file_id);
        $csv_data = json_decode($data->csv_data, true);
        foreach ($csv_data as $row) {
            $biodata = new MasterBiodata();
            foreach (config('app.db_fieldsbiodata') as $index => $field) {
                if ($data->csv_header) {
                    $biodata->$field = $row[$request->fields[$field]];
                } else {
                    $biodata->$field = $row[$request->fields[$index]];
                }
            }
            $biodata->save();
        }

        return view('import_success_biodata');
    }
    public function getImportPayrollInput()
    {
        return view('importpayrollinput');
    }

    public function parseImportPayrollInput(CsvImportRequest $request)
    {

        $path = $request->file('csv_file')->getRealPath();

        if ($request->has('header')) {
            $data = Excel::load($path, function($reader) {})->get()->toArray();
        } else {
            $data = array_map('str_getcsv', file($path));
        }


        if (count($data) > 0) {
            if ($request->has('header')) {
                $csv_header_fields = [];
                foreach ($data[0] as $key => $value) {
                    $csv_header_fields[] = $key;
                }
            }
            $csv_data = array_slice($data, 0, 200);

            $csv_data_file = CsvData::create([
                'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
                'csv_header' => $request->has('header'),
                'csv_data' => json_encode($data)
            ]);
        } else {
            return redirect()->back();
        }

        return view('import_fields_payrollinput', compact( 'csv_header_fields', 'csv_data', 'csv_data_file'));

    }

    public function processImportPayrollInput(Request $request)
    {
        $data = CsvData::find($request->csv_data_file_id);
        $csv_data = json_decode($data->csv_data, true);
        foreach ($csv_data as $row) {
            $payrollinput = new MasterPayrollInput();
            foreach (config('app.db_fieldspayrollinput') as $index => $field) {
                if ($data->csv_header) {
                    $payrollinput->$field = $row[$request->fields[$field]];
                } else {
                    $payrollinput->$field = $row[$request->fields[$index]];
                }
            }
            $payrollinput->save();
        }

        return view('import_success_payrollinput');
    }
    public function getImportUsers()
    {
        return view('importusers');
    }

    public function parseImportUsers(CsvImportRequest $request)
    {
        $path = $request->file('csv_file')->getRealPath();
        $path = $request->file('csv_file')->getRealPath();

        if ($request->has('header')) {
            $data = Excel::load($path, function($reader) {})->get()->toArray();
        } else {
            $data = array_map('str_getcsv', file($path));
        }


        if (count($data) > 0) {
            if ($request->has('header')) {
                $csv_header_fields = [];
                foreach ($data[0] as $key => $value) {
                    $csv_header_fields[] = $key;
                }
            }
            $csv_data = array_slice($data, 0, 200);

            $csv_data_file = CsvData::create([
                'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
                'csv_header' => $request->has('header'),
                'csv_data' => json_encode($data)
            ]);
        } else {
            return redirect()->back();
        }

        return view('import_fields_users', compact( 'csv_header_fields', 'csv_data', 'csv_data_file'));

    }

    public function processImportUsers(Request $request)
    {
        $data = CsvData::find($request->csv_data_file_id);
        $csv_data = json_decode($data->csv_data, true);
        foreach ($csv_data as $row) {
            $payrollinput = new MasterUsers();
            foreach (config('app.db_fieldsusers') as $index => $field) {
                if ($data->csv_header) {
                    $payrollinput->$field = $row[$request->fields[$field]];
                } else {
                    $payrollinput->$field = $row[$request->fields[$index]];
                }
            }
            $payrollinput->save();
        }

        return view('import_success_users');
    }

}