<ul class="nav" id="side-menu">
    <li>
        <a href="#"><i class="fa fa-user fa-fw"></i>Engineer Skill<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a href="#">Skill Management<span class="fa arrow"></a>
                <ul class="nav nav-third-level">
                    <li>
                        <a href="{{URL::route('technical-skill-manager')}}">Technical Skill</a>
                    </li>
                    <li>
                        <a href="{{URL::route('soft-skill-manager')}}">Soft Skill</a>
                    </li>
                </ul>
            </li>
            <!--  2015/04/02 Update by My Vo start -->
            <li>
                <a href="{{ URL::to('engineer-skill/engineer/list')}}">List Engineers</a>
            </li>
            <!--  2015/04/02 Update by My Vo end -->
            <li>
                <!--  2015/04/06 Update by tttu start -->
                <a href="{{ URL::route('import-utilization') }}">Import Utilization</a>
                <!--  2015/04/06 Update by tttu end -->
            </li>
            <li>
                <a href="#">Report<span class="fa arrow"></a>
                <ul class="nav nav-third-level">
                    <li>
                        <a href="{{ URL::route('utilization-get'); }}">Utilization</a>
                    </li>
                    <li>
                        <a href="{{ URL::route('techtical-matrix-index') }}">Technical Matrix</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- /.nav-second-level -->
    </li>
    
    <li>
        <a href="#">
            <i class="fa fa-user fa-fw"></i>Training Database<span class="fa arrow"></span>
        </a>
        <ul class="nav nav-second-level">
            <li>
                <li> <a href="{{ URL::route('course-list'); }}">Course Management</a> </li>
                <li> <a href="{{ URL::route('list-class'); }}">Training Class Management</a> </li>
                <li> <a href="{{ URL::route('trainer-list'); }}">Trainer Management</a> </li>
            </li>
            <li>
                <a href="#">Report<span class="fa arrow"></a>
                <ul class="nav nav-third-level">
                    <li>
                        <a href="{{ URL::route('general-report'); }}">Generation Information</a>
                    </li>
                    <li>
                        <a href="#">Training Result</a>
                    </li>
                    <li>
                        <a href="{{ URL::route('trainer-report') }}">Trainer Report</a>
                    </li>
                    <li>
                        <a href="#">Attendance Report</a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
    <li>
        <a href="{{ URL::route('user-list') }}">
        <i class="fa fa-users fa-fw"></i>User Management<span class="fa arrow"></span>
        </a>
    </li>
</ul>