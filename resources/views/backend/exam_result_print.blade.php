<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Exam Result</title>
    <style type="text/css">
    @page {
        size: 8.3in 11.7in;
    }
    @page {
        size: A4;
    }
    .margin-bottom {
        margin-bottom: 3px;
    }
    .table-bg {
        border-collapse: collapse;
        width: 100%;
        font-size: 15px;
        text-align: center;
    }
    .th {
        border: 1px solid #000;
        padding: 10px;
    }
    .td {
        border: 1px solid #000;
        padding: 3px;
    }
    .text-container {
        text-align: left;
        padding-left: 5px;
    }
    @media print{
        @page {
            margin: 0px;
            margin-left: 20px;
            margin-right: 20px;
            margin-top: 20px;
        }
    }
    </style>
</head>
<body>
    <div id="page">
        <table style="width: 100%; text-align: center;">
            <tr>
                <td width="5%"></td>
                <td width="15%"><img style="width: 110px;" src="{{ $getSetting->getLogo() }}" alt=""></td>
                <td>
                    <h1 style="text-align: left; text-transform:uppercase;">{!! $getSetting->school_name !!}</h1>
                </td>
            </tr>
        </table>

        <table style="width: 100%;">
            <tr>
                <td width="5%"></td>
                <td width="70%">
                    <table class="margin-bottom" style="width: 100%;">
                        <tbody>
                            <tr>
                                <td width="27%">Name Of Student : </td>
                                <td style="border-bottom: 1px solid; width: 100%; text-align: center;">
                                    {{ $getStudent->name }} {{ $getStudent->last_name }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="margin-bottom" style="width: 100%;">
                        <tbody>
                            <tr>
                                <td width="23%">Admission No : </td>
                                <td style="border-bottom: 1px solid; width: 100%; text-align: center;">
                                    {{ $getStudent->admission_number }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="margin-bottom" style="width: 100%;">
                        <tbody>
                            <tr>
                                <td width="23%">Class : </td>
                                <td style="border-bottom: 1px solid; width: 100%; text-align: center;">
                                    {{ $getClass->class_name }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="margin-bottom" style="width: 100%;">
                        <tbody>
                            <tr>
                                <td width="23%">Term : </td>
                                <td style="border-bottom: 1px solid; width: 100%; text-align: center;">{{ $getExam->name }}</td>
                            </tr>
                        </tbody>
                    </table>


                </td>
                <td width="5%"></td>
                <td width="20%" valign="top">
                    <img src="{{ $getStudent->getProfileDirect() }}" style="border-radius: 6px;" height="100px" width="100px">
                    <br>
                    Gender : {{ $getStudent->gender }}
                </td>
                
            </tr>
        </table>
        <br>
        <div class="">
            <table class="table-bg">
                <thead>
                   <tr>
                      <th class="th">Subject Name</th>
                      <th class="th">Class Work</th>
                      <th class="th">Home Work</th>
                      <th class="th">Test Work</th>
                      <th class="th">Exam</th>
                      <th class="th">Total Score</th>
                      <th class="th">Passing Marks</th>
                      <th class="th">Full Marks</th>
                      <th class="th">Result</th>
                   </tr>
                </thead>
                <tbody>
                    @php
                      $total_score = 0;
                      $full_marks = 0;
                      $result_validation = 0;
                    @endphp

                    @foreach ($getExamMark as $exam)
                    @php
                      $total_score = $total_score + $exam['total_score'];
                      $full_marks = $full_marks + $exam['full_marks'];
                    @endphp
                      <tr>
                        <td class="td text-container">{{ $exam['subject_name'] }}</td>
                        <td  class="td text-container">{{ $exam['class_work'] }}</td>
                        <td  class="td text-container">{{ $exam['home_work'] }}</td>
                        <td  class="td text-container">{{ $exam['test_work'] }}</td>
                        <td  class="td text-container">{{ $exam['exam'] }}</td>
                        <td  class="td text-container">{{ $exam['total_score'] }}</td>
                        <td  class="td text-container">{{ $exam['passing_marks'] }}</td>
                        <td  class="td text-container">{{ $exam['full_marks'] }}</td>
                        <td  class="td text-container">
                          @if ($exam['total_score'] >= $exam['passing_marks'])
                            <span style="color: green;">Pass</span>
                          @else
                            @php
                              $result_validation = 1;
                            @endphp
                            <span style="color: red;">Fail</span>
                          @endif
                        </td>
                      </tr>
                    @endforeach
                    <tr>
                      <td  class="td text-container" colspan="2"><b>Grand Total: {{ $total_score }}/{{ $full_marks }}</b></td>
                      @php
                        $percentage = ($total_score * 100) / $full_marks;
                        $getGrade = App\Models\MarksGradeModel::getGrade($percentage);
                      @endphp
                      <td  class="td text-container" colspan="2"><b>Percentage: {{ round($percentage, 2) }}%</b></td>
                      <td  class="td text-container" colspan="2"><b>Grade: {{ $getGrade }}</b></td>
                      <td  class="td text-container" colspan="3">
                        <b>
                          Result: @if ($result_validation == 0)
                                    <span style="color: green;">Pass</span>
                                  @else
                                    <span style="color: red;">Fail</span>
                          @endif
                        </b>
                      </td>
                    </tr>
                  </tbody>
             </table>
        </div>
        <div>
           <p>{{ $getSetting->exam_description }}</p>
        </div>
        <table class="margin-bottom" style="width: 100%;">
            <tbody>
                <tr>
                    <td width="15%">Signature : </td>
                    <td style="border-bottom: 1px solid; width: 100%;"></td>
                </tr>
            </tbody>
        </table>

    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>