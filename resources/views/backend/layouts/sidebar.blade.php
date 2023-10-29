  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      @if (!empty($getHeaderSetting->getLogo()))
        <img src="{{ $getHeaderSetting->getLogo() }}" alt="SMS" class="brand-image img-circle elevation-3" style="opacity: .8; width: 33px; height:33px;">
        <span class="brand-text font-weight-light">School_M_S</span>
      @else
        <span class="brand-text font-weight-light" style="margin-left: 20px;">School_M_S</span>
      @endif

    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img style="width: 40px; height: 40px;" src="{{ Auth::user()->getProfileDirect() }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          @if(Auth::user()->user_type == 1)

          <li class="nav-item">
            <a href="{{ url('backend/admin/dashboard') }}" class="nav-link @if (Request::segment(3) == 'dashboard') active @endif ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard 
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('backend/admin/list') }}" class="nav-link @if (Request::segment(3) == 'list') active @endif ">
              <i class='nav-icon fas fa-user-alt'></i>
              <p>
                Admin
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('backend/admin/teacher/list') }}" class="nav-link @if (Request::segment(3) == 'teacher') active @endif ">
              <i class='nav-icon fas fa-user-alt'></i>
              <p>
                Teacher
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('backend/admin/student/list') }}" class="nav-link @if (Request::segment(3) == 'student') active @endif ">
              <i class='nav-icon fas fa-user-alt'></i>
              <p>
                Student
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('backend/admin/parent/list') }}" class="nav-link @if (Request::segment(3) == 'parent') active @endif ">
              <i class='nav-icon fas fa-user-alt'></i>
              <p>
                Parent
              </p>
            </a>
          </li>

          <li class="nav-item @if (Request::segment(3) == 'class' || Request::segment(3) == 'subject' || Request::segment(3) == 'assign_subject' || Request::segment(3) == 'assign_class_teacher' || Request::segment(3) == 'class_timetable') menu-is-opening menu-open @endif ">
            <a href="#" class="nav-link @if (Request::segment(3) == 'class' || Request::segment(3) == 'subject' || Request::segment(3) == 'assign_subject' || Request::segment(3) == 'assign_class_teacher' || Request::segment(3) == 'class_timetable' ) active @endif ">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Academics
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('backend/admin/class/list') }}" class="nav-link @if (Request::segment(3) == 'class') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Class</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('backend/admin/subject/list') }}" class="nav-link @if (Request::segment(3) == 'subject') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subject</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('backend/admin/assign_subject/list') }}" class="nav-link @if (Request::segment(3) == 'assign_subject') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assign Subject</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('backend/admin/class_timetable/list') }}" class="nav-link @if (Request::segment(3) == 'class_timetable') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Class Timetable</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('backend/admin/assign_class_teacher/list') }}" class="nav-link @if (Request::segment(3) == 'assign_class_teacher') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assign Class Teacher</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- Fees Collection --}}
          <li class="nav-item @if (Request::segment(3) == 'fees_collection') menu-is-opening menu-open @endif ">
            <a href="#" class="nav-link @if (Request::segment(3) == 'fees_collection') active @endif ">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Fees Collection
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('backend/admin/fees_collection/collect_fees') }}" class="nav-link @if (Request::segment(4) == 'collect_fees') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Collect Fees</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('backend/admin/fees_collection/collect_fees_report') }}" class="nav-link @if (Request::segment(4) == 'collect_fees_report') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Collect Fees Report</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item @if (Request::segment(3) == 'examinations') menu-is-opening menu-open @endif ">
            <a href="#" class="nav-link @if (Request::segment(3) == 'examinations') active @endif ">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Examinations
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('backend/admin/examinations/exam/list') }}" class="nav-link @if (Request::segment(4) == 'exam') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Exam</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('backend/admin/examinations/exam_schedule') }}" class="nav-link @if (Request::segment(4) == 'exam_schedule') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Exam Schedule</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('backend/admin/examinations/marks_register') }}" class="nav-link @if (Request::segment(4) == 'marks_register') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Marks Register</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('backend/admin/examinations/marks_grade/list') }}" class="nav-link @if (Request::segment(4) == 'marks_grade') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Marks Grade</p>
                </a>
              </li>


            </ul>
          </li>

          <li class="nav-item @if (Request::segment(3) == 'attendance') menu-is-opening menu-open @endif ">
            <a href="#" class="nav-link @if (Request::segment(3) == 'attendance') active @endif ">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Attendance
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('backend/admin/attendance/student') }}" class="nav-link @if (Request::segment(4) == 'student') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Attendance</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('backend/admin/attendance/report') }}" class="nav-link @if (Request::segment(4) == 'report') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Attendance Report</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item @if (Request::segment(3) == 'communicate') menu-is-opening menu-open @endif ">
            <a href="#" class="nav-link @if (Request::segment(3) == 'communicate') active @endif ">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Communicate
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('backend/admin/communicate/notice_board') }}" class="nav-link @if (Request::segment(4) == 'notice_board') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Notice Board</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('backend/admin/communicate/send_email') }}" class="nav-link @if (Request::segment(4) == 'send_email') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Send Email </p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item @if (Request::segment(3) == 'homework') menu-is-opening menu-open @endif ">
            <a href="#" class="nav-link @if (Request::segment(3) == 'homework') active @endif ">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Homework
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('backend/admin/homework/homework/list') }}" class="nav-link @if (Request::segment(4) == 'homework') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Homework</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('backend/admin/homework/homework_report') }}" class="nav-link @if (Request::segment(4) == 'homework_report') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Homework Report</p>
                </a>
              </li>

            </ul>
          </li>
          
          <li class="nav-item">
            <a href="{{ url('backend/admin/account') }}" class="nav-link @if (Request::segment(3) == 'account') active @endif ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                My Account
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('backend/admin/setting') }}" class="nav-link @if (Request::segment(3) == 'setting') active @endif ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Setting
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('backend/admin/change_password') }}" class="nav-link @if (Request::segment(3) == 'change_password') active @endif ">
              <i class='nav-icon fas fa-school'></i>
              <p>
                Change Password
              </p>
            </a>
          </li>


          @elseif(Auth::user()->user_type == 2)

          <li class="nav-item menu-open">
            <a href="{{ url('backend/teacher/dashboard') }}" class="nav-link @if (Request::segment(3) == 'dashboard') active @endif ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('backend/teacher/my_student') }}" class="nav-link @if (Request::segment(3) == 'my_student') active @endif ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                My Student
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{ url('backend/teacher/my_class_subject') }}" class="nav-link @if (Request::segment(3) == 'my_class_subject') active @endif ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                My Class And Subject
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('backend/teacher/my_exam_timetable') }}" class="nav-link @if (Request::segment(3) == 'my_exam_timetable') active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>My Exam Timetable</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('backend/teacher/my_calendar') }}" class="nav-link @if (Request::segment(3) == 'my_calendar') active @endif ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                My Calendar
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('backend/teacher/marks_register') }}" class="nav-link @if (Request::segment(3) == 'marks_register') active @endif ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Marks Register
              </p>
            </a>
          </li>
          <li class="nav-item @if (Request::segment(3) == 'attendance') menu-is-opening menu-open @endif ">
            <a href="#" class="nav-link @if (Request::segment(3) == 'attendance') active @endif ">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Attendance
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('backend/teacher/attendance/student') }}" class="nav-link @if (Request::segment(4) == 'student') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Attendance</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('backend/teacher/attendance/report') }}" class="nav-link @if (Request::segment(4) == 'report') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Attendance Report</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ url('backend/teacher/my_notice_board') }}" class="nav-link @if (Request::segment(3) == 'my_notice_board') active @endif ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                My Notice Board
              </p>
            </a>
          </li>
          <li class="nav-item @if (Request::segment(3) == 'homework') menu-is-opening menu-open @endif ">
            <a href="#" class="nav-link @if (Request::segment(3) == 'homework') active @endif ">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Homework
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('backend/teacher/homework/homework/list') }}" class="nav-link @if (Request::segment(4) == 'homework') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Homework</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ url('backend/teacher/account') }}" class="nav-link @if (Request::segment(3) == 'account') active @endif ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                My Account
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('backend/teacher/change_password') }}" class="nav-link @if (Request::segment(3) == 'change_password') active @endif ">
              <i class='nav-icon fas fa-school'></i>
              <p>
                Change Password
              </p>
            </a>
          </li>

          @elseif(Auth::user()->user_type == 3)

          <li class="nav-item menu-open">
            <a href="{{ url('backend/student/dashboard') }}" class="nav-link @if (Request::segment(3) == 'dashboard') active @endif ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('backend/student/fees_collection') }}" class="nav-link @if (Request::segment(3) == 'fees_collection') active @endif ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Fees Collection
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('backend/student/my_calendar') }}" class="nav-link @if (Request::segment(3) == 'my_calendar') active @endif ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                My Calendar
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('backend/student/my_subject') }}" class="nav-link @if (Request::segment(3) == 'my_subject') active @endif ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                My Subject
              </p>
            </a>
          </li>
          <li class="nav-item">
                <a href="{{ url('backend/student/my_timetable') }}" class="nav-link @if (Request::segment(3) == 'my_timetable') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My Class Timetable</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('backend/student/my_exam_timetable') }}" class="nav-link @if (Request::segment(3) == 'my_exam_timetable') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My Exam Timetable</p>
                </a>
              </li>

          
              <li class="nav-item">
                <a href="{{ url('backend/student/my_exam_result') }}" class="nav-link @if (Request::segment(3) == 'my_exam_result') active @endif ">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    My Exam Result
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('backend/student/my_attendance') }}" class="nav-link @if (Request::segment(3) == 'my_attendance') active @endif ">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    My Attendance
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('backend/student/my_notice_board') }}" class="nav-link @if (Request::segment(3) == 'my_notice_board') active @endif ">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    My Notice Board
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('backend/student/my_homework') }}" class="nav-link @if (Request::segment(3) == 'my_homework') active @endif ">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    My Homework
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('backend/student/my_submitted_homework') }}" class="nav-link @if (Request::segment(3) == 'my_submitted_homework') active @endif ">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Submitted Homework
                  </p>
                </a>
              </li>


          <li class="nav-item">
            <a href="{{ url('backend/student/account') }}" class="nav-link @if (Request::segment(3) == 'account') active @endif ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                My Account
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('backend/student/change_password') }}" class="nav-link @if (Request::segment(3) == 'change_password') active @endif ">
              <i class='nav-icon fas fa-school'></i>
              <p>
                Change Password
              </p>
            </a>
          </li>

          @elseif(Auth::user()->user_type == 4)

          <li class="nav-item menu-open">
            <a href="{{ url('backend/parent/dashboard') }}" class="nav-link @if (Request::segment(3) == 'dashboard') active @endif ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('backend/parent/my_student') }}" class="nav-link @if (Request::segment(3) == 'my_student') active @endif ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                My Student
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('backend/parent/my_student_notice_board') }}" class="nav-link @if (Request::segment(3) == 'my_student_notice_board') active @endif ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                My Student Notice Board
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('backend/parent/my_notice_board') }}" class="nav-link @if (Request::segment(3) == 'my_notice_board') active @endif ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                My Notice Board
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('backend/parent/account') }}" class="nav-link @if (Request::segment(3) == 'account') active @endif ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                My Account
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('backend/parent/change_password') }}" class="nav-link @if (Request::segment(3) == 'change_password') active @endif ">
              <i class='nav-icon fas fa-school'></i>
              <p>
                Change Password
              </p>
            </a>
          </li>

          @endif

          <li class="nav-item">
            <a href="{{ url('logout') }}" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Logout</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
