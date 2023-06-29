<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title></title>

        <style>
            body {
                margin: 0;
                padding: 0;
            }
            table {
                border-collapse: collapse;
            }

            #header td, #table th {
                border: none;
                padding: 4px 0px 4px 0px;
            }
            #table {
                font-size: 10px;
            }
            #table td, #table th {
                border: 1px solid black;
                padding: 8px;
            }
        </style>
    </head>
    <body>
        <main>
            <table id="header" style="font-size: 12px;">
                <tbody>
                    <tr>
                        <th style="text-align: left;">Mata Pelajaran</th>
                        <td style="width: 15px; text-align: center;">:</td>
                        <td>{{ $data['lesson_schedule']->subjects->name }}</td>
                    </tr>
                    <tr>
                        <th style="text-align: left;">Kelas</th>
                        <td style="width: 15px; text-align: center;">:</td>
                        <td>{{ $data['lesson_schedule']->class_room->name }}</td>
                    </tr>
                    <tr>
                        <th style="text-align: left;">Semester</th>
                        <td style="width: 15px; text-align: center;">:</td>
                        <td>{{ $data['lesson_schedule']->semester }}</td>
                    </tr>
                    <tr>
                        <th style="text-align: left;">Tahun Pelajaran</th>
                        <td style="width: 15px; text-align: center;">:</td>
                        <td>{{ $data['lesson_schedule']->school_year->name }}</td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <h3  style="font-size: 12px;">Nilai Pengetahuan</h3>
            <table id="table" style="width: 100%; font-size: 12px;">
                <thead>
                    <tr>
                        <th style="width: 10px">No</th>
                        <th>Nama</th>
                        <th>Nilai</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data['report']['pengetahuan'] as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->student->user->name }}</td>
                        <td>{{ $item->grade->value}}</td>
                        <td>{{ $item->grade->description}}</td>
                      </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Rekap Nilai Tidak Ditemukan!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <br>
            <h3  style="font-size: 12px;">Nilai Keterampilan</h3>
            <table id="table" style="width: 100%; font-size: 12px;">
                <thead>
                    <tr>
                        <th style="width: 10px">No</th>
                        <th>Nama</th>
                        <th>Nilai</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data['report']['keterampilan'] as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->student->user->name }}</td>
                        <td>{{ $item->grade->value}}</td>
                        <td>{{ $item->grade->description}}</td>
                      </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Rekap Nilai Tidak Ditemukan!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </main>
    </body>
</html>
