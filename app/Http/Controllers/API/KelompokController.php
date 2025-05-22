<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AlurMagang;
use App\Models\Anggota;
use App\Models\Kelompok;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use stdClass;

class KelompokController extends Controller
{
    public function createKelompok(Request $request)
    {
        $data = null;
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        DB::beginTransaction();
        try {
            $kelompok = new Kelompok();
            $kelompok->id_users = auth()->user()->id;
            $kelompok->nama_kelompok = $request->get('nama_kelompok');
            $kelompok->created_at = now();
            $kelompok->save();
            $kelompokId = $kelompok->id;

            // create entry alur_magang
            $alur = new AlurMagang();
            $alur->id_kelompok = $kelompokId;
            $alur->created_at = now();
            $alur->updated_at = now();
            $alur->save();

            $anggotas = [];
            foreach ($request->get('anggota') as $key => $item) {
                array_push($anggotas, [
                    'nim' => $item['nim'],
                    'nama' => $item['nama'],
                    'id_prodi' => $item['id_prodi'],
                    'angkatan' => $item['angkatan'],
                    'golongan' => $item['golongan'],
                    'no_telp' => $item['no_telp'],
                    'tanggal_lahir' => $item['tanggal_lahir'],
                    'jenis_kelamin' => strtolower($item['gender']),
                    'email' => $item['email'],
                    'created_at' => now(),
                    'id_kelompok' => $kelompokId,
                ]);
            }
            Anggota::insert($anggotas);
            DB::commit();

            $responseCode = Response::HTTP_OK;
            $message = 'Berhasil menambahkan data';
        } catch (Exception $e) {
            DB::rollBack();
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            DB::rollBack();
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } finally {
            $response = [
                'status_code' => $responseCode,
                'message' => $message,
            ];

            return response()->json($response, $responseCode);
        }
    }

    public function updateKelompok(Request $request)
    {
        $data = null;
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        DB::beginTransaction();
        try {
            $kelompok = Kelompok::findOrFail($request->get('id'));
            $kelompok->nama_kelompok = $request->get('nama_kelompok');
            $kelompok->updated_at = now();
            $kelompok->save();

            // Delete existing anggotas related to the kelompok
            Anggota::where('id_kelompok', $request->get('id'))->delete();

            // Add updated anggotas
            $anggotas = [];
            foreach ($request->get('anggota') as $key => $item) {
                array_push($anggotas, [
                    'nim' => $item['nim'],
                    'nama' => $item['nama'],
                    'id_prodi' => $item['id_prodi'],
                    'angkatan' => $item['angkatan'],
                    'golongan' => $item['golongan'],
                    'no_telp' => $item['no_telp'],
                    'tanggal_lahir' => $item['tanggal_lahir'],
                    'jenis_kelamin' => strtolower($item['gender']),
                    'email' => $item['email'],
                    'updated_at' => now(),
                    'id_kelompok' => $kelompok->id,
                ]);
            }
            Anggota::insert($anggotas);
            DB::commit();

            $responseCode = Response::HTTP_OK;
            $message = 'Berhasil memperbarui data';
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            $message = 'Kelompok tidak ditemukan. ' . $e->getMessage();
            $responseCode = Response::HTTP_NOT_FOUND;
        } catch (Exception $e) {
            DB::rollBack();
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            DB::rollBack();
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } finally {
            $response = [
                'status_code' => $responseCode,
                'message' => $message,
            ];

            return response()->json($response, $responseCode);
        }
    }

    public function InsertTempatMagang($id, Request $request)
    {
        $data = null;
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        DB::beginTransaction();
        try {
            $alurMagang = AlurMagang::where('id_kelompok', $id)->first();
            $alurMagang->id_kelompok = $id;
            $alurMagang->tempat_magang = $request->get('tempat_magang');
            $alurMagang->nama_posisi = $request->get('nama_posisi');
            $alurMagang->status_proposal = "menunggu konfirmasi";
            $alurMagang->status = null;
            $alurMagang->updated_at = now();
            $alurMagang->save();

            DB::commit();
            $message = 'Berhasil menambahkan tempat magang.';
            $responseCode = Response::HTTP_OK;
        } catch (Exception $e) {
            DB::rollBack();
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            DB::rollBack();
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } finally {
            $response = [
                'message' => $message,
            ];

            return response()->json($response, $responseCode);
        }
    }

    public function uploadProposal($id, Request $request)
    {
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        DB::beginTransaction();
        try {
            // Cari kelompok dengan id
            $kelompok = Kelompok::find($id);
            if (!$kelompok) {
                return response()->json(['message' => 'Kelompok tidak ditemukan.'], Response::HTTP_NOT_FOUND);
            }

            // Cari alur magang yang berkaitan dengan id_kelompok (yang merujuk ke kelompok.id)
            $alurMagang = AlurMagang::where('id_kelompok', $kelompok->id)->first();
            if (!$alurMagang) {
                return response()->json(['message' => 'Data alur magang tidak ditemukan untuk kelompok ini.'], Response::HTTP_NOT_FOUND);
            }

            if (!$request->hasFile('proposal')) {
                return response()->json(['message' => 'File proposal tidak ditemukan di request.'], Response::HTTP_BAD_REQUEST);
            }

            $file = $request->file('proposal');
            $originalName = trim($file->getClientOriginalName());
            $originalName = str_replace(["\n", "\r"], '', $originalName);

            $safeName = time() . '-' . $originalName;

            $path = public_path('uploads/proposal/' . $kelompok->id);
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0755, true);
            }

            // upload revised proposal
            $file->move($path, $safeName);
            $filePath = '/uploads/proposal/' . $kelompok->id . '/' . $safeName;

            if ($alurMagang->status_proposal == 'revisi') {
                $alurMagang->revisi_proposal = $filePath;
            } else {
                $alurMagang->revisi_proposal = $filePath;
            }

            $alurMagang->status_proposal = 'menunggu konfirmasi';
            $alurMagang->updated_at = now();
            $alurMagang->save();

            DB::commit();
            $message = 'Berhasil upload proposal.';
            $responseCode = Response::HTTP_OK;
        } catch (QueryException $e) {
            DB::rollBack();
            $message = 'Terjadi kesalahan Query: ' . $e->getMessage();
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (Exception $e) {
            DB::rollBack();
            $message = 'Terjadi kesalahan: ' . $e->getMessage();
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response()->json(['message' => $message], $responseCode);
    }


    public function uploadSuratBalasan($id, Request $request)
{
    $message = '';
    $responseCode = Response::HTTP_BAD_REQUEST;

    DB::beginTransaction();
    try {
        // Validasi file
        $request->validate([
            'surat_balasan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Cari data alur magang berdasarkan id kelompok
        $alurMagang = AlurMagang::where('id_kelompok', $id)->first();

        if (!$alurMagang) {
            throw new \Exception("Data alur magang tidak ditemukan.");
        }

        // Proses upload file
        $file = $request->file('surat_balasan');
        $filename = time() . '_' . $file->getClientOriginalName();
        $filePath = public_path('upload/surat-balasan/' . $id);

        if (!File::isDirectory($filePath)) {
            File::makeDirectory($filePath, 493, true);
        }

        $file->move($filePath, $filename);

        // Update database
        $alurMagang->surat_balasan = '/upload/surat-balasan/' . $id . '/' . $filename;
        $alurMagang->status = null; // Set status ke NULL (menunggu konfirmasi)
        $alurMagang->updated_at = now();
        $alurMagang->save();

        DB::commit();

        $message = 'Berhasil upload surat balasan.';
        $responseCode = Response::HTTP_OK;
    } catch (\Exception $e) {
        DB::rollBack();
        $message = 'Terjadi kesalahan. ' . $e->getMessage();
        $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
    }

    return response()->json([
        'message' => $message
    ], $responseCode);
}

    public function getKelompokById(Request $request)
    {
        $data = null;
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        try {
            $kelompok = Kelompok::with('anggota')
                ->where('id_users', $request->get('id'))
                ->leftJoin('users as d', 'd.id', 'kelompoks.id_dospem')
                ->select(
                    'kelompoks.*',
                    'd.name as nama_dosen'
                )
                ->first();

            if ($kelompok != null) {
                $responseCode = Response::HTTP_OK;
                $message = 'Berhasil menampilkan kelompok.';
                $data = $kelompok;
            } else {
                $responseCode = Response::HTTP_NOT_FOUND;
                $data = null;
                $message = 'Data kelompok tidak ditemukan.';
            }
        } catch (Exception $e) {
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } finally {
            $response = [
                'message' => $message,
                'response' => $data
            ];

            return response()->json($response, $responseCode);
        }
    }

    public function insertDospem($id, Request $request)
    {
        $data = null;
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        DB::beginTransaction();
        try {
            $kelompok = Kelompok::find($id);
            $kelompok->id_dospem = $request->get('id_dospem');
            $kelompok->updated_at = now();
            $kelompok->save();
            DB::commit();

            $message = 'Berhasil menambahkan dospem.';
            $responseCode = Response::HTTP_OK;
        } catch (Exception $e) {
            DB::rollBack();
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            DB::rollBack();
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } finally {
            $response = [
                'message' => $message,
            ];

            return response()->json($response, $responseCode);
        }
    }

    public function cekStatus()
    {
        // return auth()->user();
        $data = null;
        $returnData = new stdClass;
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        try {
            $responseCode = Response::HTTP_OK;
            $userId = auth()->user()->id;
            $kelompok = Kelompok::where('id_users', $userId)->orderBy('id', 'desc')->first();
            if (!$kelompok) {
                $data = null;
                $message = 'Data kelompok tidak ditemukan.';
            } else {
                $alurMagang = AlurMagang::where('id_kelompok', $kelompok?->id)->orderBy('id', 'desc')->first();
                if (!$alurMagang) {
                    $returnData->message = 'Kelompok belum melakukan pemilihan tempat magang.';
                    $returnData->dataAlurMagang = $alurMagang;
                } else if ($alurMagang) {
                    if ($alurMagang?->status_proposal == 'menunggu konfirmasi') {
                        $returnData->message = 'Proposal menunggu konfirmasi dari admin atau dosen.';
                        $returnData->dataAlurMagang = $alurMagang;
                    } else if ($alurMagang->status_proposal == 'revisi') {
                        $returnData->message = 'Terdapat revisi proposal. ' . $alurMagang->revisi_proposal;
                        $returnData->dataAlurMagang = $alurMagang;
                    } else if ($alurMagang->status_proposal == 'ditolak') {
                        $returnData->message = 'Proposal ditolak. ' . $alurMagang->alasan_proposal_ditolak;
                        $returnData->dataAlurMagang = $alurMagang;
                    } else {
                        $returnData->message = 'Proposal diterima.';
                        $returnData->dataAlurMagang = $alurMagang;
                    }
                }
                $message = 'Berhasil menampilkan data alur magang.';
                $data = $returnData;
            }
        } catch (Exception $e) {
            DB::rollBack();
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            DB::rollBack();
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } finally {
            $response = [
                'message' => $message,
                'data' => $data,
            ];

            return response()->json($response, $responseCode);
        }
    }

    public function InsertTempatMagangById($id, Request $request)
    {
        $data = null;
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        DB::beginTransaction();
        try {
            $alurMagang = new AlurMagang();
            $alurMagang->id_kelompok = $id;
            $alurMagang->id_tempat_magang = $request->get('id_tempat_magang');
            $alurMagang->status = null;
            $alurMagang->created_at = now();
            $alurMagang->save();

            DB::commit();
            $message = 'Berhasil menambahkan tempat magang.';
            $responseCode = Response::HTTP_OK;
        } catch (Exception $e) {
            DB::rollBack();
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            DB::rollBack();
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } finally {
            $response = [
                'message' => $message,
            ];

            return response()->json($response, $responseCode);
        }
    }

    public function downloadSuratPengantar(Request $request)
    {
        $idKelompok = $request->get('id_kelompok');
        $alurMagang = AlurMagang::where('id_kelompok', $idKelompok)->first();
        if ($alurMagang->surat_pengantar != null) {
            $file = public_path() . $alurMagang->surat_pengantar;
            $headers = [
                'Content-Type' => 'application/pdf',
            ];
            return response()->download($file, 'surat-pengantar.pdf');
            // return FacadesResponse::download($file, 'surat-pengantar.pdf', $headers);
        } else {
            $response = [
                'message' => 'Surat pengantar belum diupload.',
            ];

            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
