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
            // Table Kelompok
            $kelompok = new Kelompok();
            $kelompok->id_users = auth()->user()->id;
            $kelompok->nama_kelompok = $request->get('nama_kelompok');
            $kelompok->created_at = now();
            $kelompok->save();

            // Table Alur Magang
            $alur_magang = new AlurMagang();
            $alur_magang->id_kelompok = $kelompok->id;
            $alur_magang->created_at = now();
            $alur_magang->save();

            $kelompokId = $kelompok->id;

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
            // Table Kelompok
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
        $data = null;
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        DB::beginTransaction();
        try {
            $alurMagang = AlurMagang::where('id_kelompok', $id)->first();

            $file = $request->file('proposal');
            $filename = $file->getClientOriginalName();
            $filePath = public_path() . '/upload/proposal/' . $id;
            if (!File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 493, true);
            }
            $file->move($filePath, $filename);

            $alurMagang->proposal = '/upload/proposal/' . $id . '/' . $filename;
            $alurMagang->status_proposal = "menunggu konfirmasi";
            $alurMagang->updated_at = now();
            $alurMagang->save();

            DB::commit();
            $message = 'Berhasil upload proposal.';
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
                'message' => $message
            ];

            return response()->json($response, $responseCode);
        }
    }

    public function uploadSuratBalasan($id, Request $request)
    {
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        DB::beginTransaction();
        try {
            $alurMagang = AlurMagang::where('id_kelompok', $id)->first();

            $file = $request->file('surat_balasan');
            $filename = $file->getClientOriginalName();
            $filePath = public_path() . '/upload/surat-balasan/' . $id;
            if (!File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 493, true);
            }
            $file->move($filePath, $filename);

            $alurMagang->surat_balasan = '/upload/surat-balasan/' . $id . '/' . $filename;
            $alurMagang->updated_at = now();
            $alurMagang->save();

            DB::commit();
            $message = 'Berhasil upload surat balasan.';
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
                'message' => $message
            ];

            return response()->json($response, $responseCode);
        }
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
                    $returnData->message = 'Not Yet Selected an Internship.';
                    $returnData->dataAlurMagang = $alurMagang;
                } else if ($alurMagang) {
                    if ($alurMagang?->status_proposal == 'menunggu konfirmasi') {
                        $returnData->message = 'Proposal awaiting confirmation from the admin or lecturer.';
                        $returnData->dataAlurMagang = $alurMagang;
                    } else if ($alurMagang->status_proposal == 'revisi') {
                        $returnData->message = 'There are revisions to the proposal. ' . $alurMagang->revisi_proposal;
                        $returnData->dataAlurMagang = $alurMagang;
                    } else if ($alurMagang->status_proposal == 'ditolak') {
                        $returnData->message = 'Proposal rejected. ' . $alurMagang->alasan_proposal_ditolak;
                        $returnData->dataAlurMagang = $alurMagang;
                    } else if ($alurMagang->status_proposal == 'belum ada') {
                        $returnData->message = 'No internship proposal uploaded yet.';
                        $returnData->dataAlurMagang = $alurMagang;
                    } else {
                        $returnData->message = 'Proposal Accepted.';
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
                'Content-Disposition' => 'attachment; filename="surat-pengantar.pdf"',
            ];
            return response()->download($file, 'surat-pengantar.pdf', $headers);
            // return FacadesResponse::download($file, 'surat-pengantar.pdf', $headers);
        } else {
            $response = [
                'message' => 'Surat pengantar belum diupload.',
            ];

            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
